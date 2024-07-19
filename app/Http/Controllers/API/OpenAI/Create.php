<?php 

namespace App\Http\Controllers\API\OpenAI;

use OpenAi;

class Create 
{
    public $client;
    public function __construct(){
        $this->client = OpenAI::client(env('GPT_KEY'));
    }

    public  function createAssistant($data): object
    {
        $response = $this->client->assistants()->create([
            'instructions' => $data['instruct'],
            'name' => $data['name'],
            'model' => $data['model'],
        ]);
        return $response;
    }
}
