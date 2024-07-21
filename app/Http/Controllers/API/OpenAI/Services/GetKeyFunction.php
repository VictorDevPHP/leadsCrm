<?php

namespace App\Http\Controllers\API\OpenAI\Services;

class GetKeyFunction
{
    public static function getKeyByFunctionName(array $selectedFunctions)
    {
        $functions = config('functions');
        $result = [];

        foreach ($selectedFunctions as $functionName) {
            foreach ($functions as $key => $function) {
                if (isset($function['name']) && $function['name'] === $functionName) {
                    $result[] = [
                        'type' => 'function',
                        'function' => [
                            'name' => $function['name'],
                            'description' => $function['description'],
                            'parameters' => $function['parameters'],
                        ],
                    ];
                }
            }
        }

        return $result;
    }
}