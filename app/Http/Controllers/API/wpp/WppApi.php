<?php

namespace App\Http\Controllers\API\wpp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WppApi extends Controller
{
    /**
     * Sends a message via WhatsApp API.
     *
     * @param string $number The phone number to send the message to.
     * @param string $message The content of the message.
     * @param string $key The API key for authentication.
     * @return array An array containing the status code and response from the API.
     */
    public function sendMessage(string $number, string $message, string $key): array{
        $url = 'http://localhost:3000/wppconnect/sendMessage';
        $data = array('phone' => $number, 'text' => $message, 'key' => $key);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return array('status_code' => $statusCode, 'response' => json_decode($response, true));
    }
}
