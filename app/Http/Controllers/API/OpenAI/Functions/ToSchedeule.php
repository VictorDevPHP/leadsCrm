<?php

namespace App\Http\Controllers\API\OpenAI\Functions;
use Illuminate\Support\Facades\Log;

class ToSchedeule
{
    public static function toSchedeule($arguments)
    {
        $argumentsArray = (array) json_decode(json_encode($arguments), true);
        Log::info("Criando agendamento: ", $argumentsArray);
        return true;
    }
}