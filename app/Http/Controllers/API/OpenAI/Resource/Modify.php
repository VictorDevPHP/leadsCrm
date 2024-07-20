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

    public function modifyAssistant(array $data, string $id_assistant): object
    {
        $response = $this->client->assistants()->modify($id_assistant, [
            'instructions' => $data['instruct'],
            'name' => $data['name'],
            'model' => $data['model'],
            'tools' => [
                [
                    'type' => 'function',
                    'function' => [
                        'name' => 'schedule_appointment',
                        'description' => 'Function to schedule appointments in Google Calendar',
                        'parameters' => [
                            'type' => 'object',
                            'properties' => [
                                'email' => [
                                    'type' => 'string',
                                    'description' => 'Client email address',
                                ],
                                'time_interval' => [
                                    'type' => 'string',
                                    'description' => 'Time interval: e.g., 14:00-15:00',
                                ],
                                'date' => [
                                    'type' => 'string',
                                    'format' => 'date',
                                    'description' => 'Appointment date in YYYY-MM-DD format: e.g., 2024-05-15',
                                ],
                            ],
                            'required' => ['time_interval', 'date'],
                        ],
                    ],
                ],
            ],
        ]);
        return $response;
    }
}