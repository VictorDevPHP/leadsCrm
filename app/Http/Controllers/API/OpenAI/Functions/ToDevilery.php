<?php

namespace App\Http\Controllers\API\OpenAI\Functions;
use App\Models\KanbanTask;
use Exception;
use Illuminate\Support\Facades\Log;

class ToDevilery
{
    public static function pushDelivery($arguments, $cache): bool
    {
        Log::info($arguments);
        try {
            $arguments = json_decode($arguments, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return false;
            }
            KanbanTask::create([
                'name_client' => $cache['name'],
                'description' => $arguments['products'],
                'session_name' => $cache['session'],
                'status_kanban' => 'recebido',
                'endereco' => $arguments['address'],
                'metodo_pagamento' => $arguments['payment_method'],
                'whatsapp' => $cache['number'],
            ]);
            return true;

        } catch (Exception $e) {
            Log::error($e);
            return false;

        }
    }
}
