<?php

namespace App\Http\Controllers\API\OpenAI\Services;

class GetKeyFunction
{
    public static function getKeyByFunctionName(string $name)
    {
        $functions = config('functions');
        foreach ($functions as $key => $function) {
            if (isset($function['name']) && $function['name'] === $name) {
                return config('functions.'.$key);
            }
        }
    }
}