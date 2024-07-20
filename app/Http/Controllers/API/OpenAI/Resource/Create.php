<?php 

namespace App\Http\Controllers\API\OpenAI\Resource;

use App\Http\Controllers\API\OpenAI\Services\GetKeyFunction;
use OpenAI;

class Create 
{
    public $client;
    public function __construct(){
        $this->client = OpenAI::client(env('GPT_KEY'));
    }

    public function createAssistant($data): object
    {
        if(!empty($data['functions'])){
            $response = $this->client->assistants()->create([
                'instructions' => $data['instruct'],
                'name' => $data['name'],
                'model' => $data['model'],
                'tools' => [
                    [
                        'type' => 'function',
                        'function' => GetKeyFunction::getKeyByFunctionName($data['functions'])
                    ],
                ],
            ]);
        }else{
            $response = $this->client->assistants()->create([
                'instructions' => $data['instruct'],
                'name' => $data['name'],
                'model' => $data['model'],
                'tools' => [],
            ]);            
        }

        return $response;
    }
}
