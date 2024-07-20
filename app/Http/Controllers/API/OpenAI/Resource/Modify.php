<?php

namespace App\Http\Controllers\API\OpenAI\Resource;

use App\Http\Controllers\API\OpenAI\Services\GetKeyFunction;
use OpenAI;

class Modify
{
    public $client;
    public function __construct()
    {
        $this->client = OpenAI::client(env('GPT_KEY'));
    }

    public function modifyAssistant(array $data, string $id_assistant, string $functions): object
    {
        if(!empty($functions)){
            $response = $this->client->assistants()->modify($id_assistant, [
                'instructions' => $data['instruct'],
                'name' => $data['name'],
                'model' => $data['model'],
                'tools' => [
                    [
                        'type' => 'function',
                        'function' => GetKeyFunction::getKeyByFunctionName($functions)
                    ],
                ],
            ]);
        }else{
            $response = $this->client->assistants()->modify($id_assistant, [
                'instructions' => $data['instruct'],
                'name' => $data['name'],
                'model' => $data['model'],
                'tools' => [],
            ]);
        }
        return $response;
    }
}