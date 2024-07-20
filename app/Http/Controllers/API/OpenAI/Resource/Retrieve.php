<?php

namespace App\Http\Controllers\API\OpenAI\Resource;

use OpenAi;

class Retrieve
{
    public $client;
    public function __construct()
    {
        $this->client = OpenAI::client(env('GPT_KEY'));
    }

    public function retrieveAssistant($id_assistant): object
    {
        $response = $this->client->assistants()->retrieve($id_assistant);
        
        return $response;
    }

}