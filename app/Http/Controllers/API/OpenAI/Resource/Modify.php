<?php

namespace App\Http\Controllers\API\OpenAI\Resource;

use OpenAI;

class Modify
{
    public $client;
    public function __construct()
    {
        $this->client = OpenAI::client(env('GPT_KEY'));
    }

    public function modifyAssistant(array $data, string $id_assistant, array $functions): object
    {
        $response = $this->client->assistants()->modify($id_assistant, [
            'instructions' => $data['instruct'],
            'name' => $data['name'],
            'model' => $data['model'],
            'tools' => $functions,
        ]);
        
        return $response;
    }
}