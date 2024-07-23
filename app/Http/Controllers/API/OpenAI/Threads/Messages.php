<?php

namespace App\Http\Controllers\API\OpenAI\Threads;

use App\Http\Controllers\API\OpenAI\Functions\ToDevilery;
use App\Http\Controllers\API\OpenAI\Functions\ToSchedeule;
use App\Models\CustomerAssistant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use OpenAI;

class Messages
{
    public $client;

    public function __construct()
    {
        $this->client = OpenAI::client(env('GPT_KEY'));
    }

    public function createChat(Request $request): array
    {
        $cacheGet = Cache::get($request->number);
        if (isset($cacheGet)) {
            return Cache::get($request->number);
        } else {
            $response = $this->client->threads()->create([]);
            Cache::put($request->number, [
                'thread_id' => $response->id,
                'session' => $request->session_name,
                'number' => $request->number,
                'name' => $request->name,
            ], 7 * 1440);
        }
        return Cache::get($request->number);
    }

    public function sendMessage(Request $request)
    {
        $cache = Cache::get($request->number);

        if (!$cache) {
            return response()->json(['error' => 'Cache not found.'], 404);
        }

        $messageResponse = $this->client->threads()->messages()->create(
            $cache['thread_id'],
            [
                'role' => 'user',
                'content' => $request->message,
            ]
        );

        $id_assistant = CustomerAssistant::where('session_name', $cache['session'])->value('id_assistant');

        if (!$id_assistant) {
            return response()->json(['error' => 'Assistant not found.'], 404);
        }

        $runResponse = $this->client->threads()->runs()->create(
            $cache['thread_id'],
            [
                'assistant_id' => $id_assistant,
            ]
        );
        $runId = $runResponse->id;

        do {
            sleep(2);

            $runStatusResponse = $this->client->threads()->runs()->retrieve(
                $cache['thread_id'],
                $runId
            );

            $status = $runStatusResponse->status;

            if ($status === 'requires_action') {
                $call_function = $runStatusResponse->requiredAction->submitToolOutputs->toolCalls[0]['id'];
                $name_function = $runStatusResponse->requiredAction->submitToolOutputs->toolCalls[0]['function']['name'];
                $arguments = $runStatusResponse->requiredAction->submitToolOutputs->toolCalls[0]['function']['arguments'];
                $this->requireActions($call_function, $runId, $cache['thread_id'], $arguments, $name_function, $cache);
                
            }

        } while ($status !== 'completed' && $status !== 'failed');

        if ($status === 'failed') {
            return response()->json(['error' => 'Run failed.'], 500);
        }

        $stepsResponse = $this->client->threads()->runs()->steps()->list(
            $cache['thread_id'],
            $runId
        );

        $messageId = null;
        foreach ($stepsResponse->data as $step) {
            if ($step->type === 'message_creation') {
                $messageId = $step->stepDetails->messageCreation->messageId;
                break;
            }
        }
        if (!$messageId) {
            return response()->json(['error' => 'No message ID found.'], 500);
        }

        $messageDetailsResponse = $this->client->threads()->messages()->retrieve(
            $cache['thread_id'],
            $messageId
        );
        $messageContent = $messageDetailsResponse->content[0]->text->value;

        return response()->json(['message' => $messageContent]);
    }

    public function requireActions($call_function, $runId, $thread_id, $arguments, $name_function, $cache)
    {
        if($name_function == 'schedule_appointment'){
            Log::info('init schedule_appointment');
            $response = ToSchedeule::toSchedeule($arguments);
        }elseif($name_function == 'get_delivery'){
            Log::info("init get_delivery");
            $response = ToDevilery::pushDelivery($arguments, $cache);
        }

        $stream = $this->client->threads()->runs()->submitToolOutputsStreamed(
            threadId: $thread_id,
            runId: $runId,
            parameters: [
                'tool_outputs' => [
                    [
                        'tool_call_id' => $call_function,
                        'output' => strval($response),
                    ]
                ],
            ]
        );
    }

}
