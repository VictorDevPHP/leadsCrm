<?php

return [
    'Agendamento de Horarios' => [
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
    
    'Previsão do tempo' => [
        "name" => "get_weather",
        "description" => "Determine weather in my location",
        "parameters" => [
            "type" => "object",
            "properties" => [
                "location" => [
                    "type" => "string",
                    "description" => "The city and state e.g. San Francisco, CA"
                ],
                "unit" => [
                    "type" => "string",
                    "enum" => ["c", "f"]
                ]
            ],
            "required" => ["location"]
        ]
    ]
];