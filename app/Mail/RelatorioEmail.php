<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;
use League\CommonMark\CommonMarkConverter;

class RelatorioEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $impressoes;
    public $acoes;
    public $data_inicio;
    public $data_fim;
    public $client;
    public $data;

    public function __construct($conversions, $spend, $impressoes, $acoes, $data_inicio, $data_fim)
    {
        $this->conversions = $conversions;
        $this->impressoes = $impressoes;
        $this->acoes = $acoes;
        $this->data_inicio = $data_inicio;
        $this->data_fim = $data_fim;
        $this->spend = $spend;
        $this->data = [
            'impressoes' => $impressoes,
            'conversions' => $conversions,
            'data_inicio' => $data_inicio,
            'data_fim' => $data_fim,
            'spend' => $spend,
        ];
    }

    public function build()
    {
        // $resumoMarkdown = $this->AiFast($this->data);
        // $converter = new CommonMarkConverter();
        // $resumoHtml = $converter->convertToHtml($resumoMarkdown);
        return $this->view('livewire.emails.sendemail')->with([
            'conversions' => $this->conversions,
            'impressoes' => $this->impressoes,
            'spend' => $this->spend,
            'acoes' => $this->acoes, 
            'data_inicio' => $this->data_inicio,
            'data_fim' => $this->data_fim,
            // 'resumo' =>  $resumoHtml->getContent(),
        ]);
    }
    public function AiFast($dados){
        $this->client = new Client();
        $url = 'http://localhost:11434/api/chat';
        $data = [
            "model" => 'llama3:8b',
            "messages" => [
                [
                    "role" => "user",
                    "content" => 'Faça a analise dos seguintes dados usando até 500 caracteres obs(use os valores das chaves em json em português para melhor compeensão do usuário): ' . json_encode($dados),
                ]
            ],
            "stream" => false
        ];
        $response = $this->client->post($url, 
        [
            'json' => $data
        ]);
        $responseArray = json_decode($response->getBody()->getContents(), true);
        return $responseArray['message']['content'];
    }
}
