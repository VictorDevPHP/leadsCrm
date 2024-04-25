<?php

namespace App\Livewire\Emails;

use League\CommonMark\CommonMarkConverter;
use Livewire\Component;
use GuzzleHttp\Client;

class Sendemail extends Component{

    public $data;
    public $impressoes;
    public $acoes;
    public $data_inicio;
    public $data_fim;
    public $resumo;
    public function mount()
    {
        $this->data = '{"insights":{"data":[{"impressions":"32951","actions":[{"action_type":"onsite_conversion.messaging_first_reply","value":"4"},{"action_type":"onsite_conversion.post_save","value":"1"},{"action_type":"page_engagement","value":"200"},{"action_type":"post_engagement","value":"200"},{"action_type":"post","value":"1"},{"action_type":"onsite_conversion.messaging_conversation_started_7d","value":"30"},{"action_type":"post_reaction","value":"53"},{"action_type":"link_click","value":"145"}],"date_start":"2024-03-25","date_stop":"2024-04-23"}],"paging":{"cursors":{"before":"MAZDZD","after":"MAZDZD"}}},"id":"act_588071529424076"}';
        $resumoMarkdown = $this->AiFast($this->data);
        $converter = new CommonMarkConverter();
        $this->resumo = $converter->convertToHtml($resumoMarkdown);
        $this->resumo = $this->resumo->getContent();
        $this->data = json_decode($this->data);
        $this->generateData($this->data);
    }

    public function render()
    {
        return view('livewire.emails.sendemail');
    }

    public function generateData($data): void{
        if ($data && isset($data->insights->data[0])) {
            $this->impressoes = $data->insights->data[0]->impressions ?? null;
            $this->acoes = $data->insights->data[0]->actions ?? null;
            $this->data_inicio = $data->insights->data[0]->date_start ?? null;
            $this->data_fim = $data->insights->data[0]->date_stop ?? null;
        } else {
            $this->impressoes = null;
            $this->acoes = null;
            $this->data_inicio = null;
            $this->data_fim = null;
        }
    }
    public function AiFast($data){
        $this->client = new Client();
        $url = 'http://localhost:11434/api/chat';
        $data = [
            "model" => 'llama3:8b',
            "messages" => [
                [
                    "role" => "user",
                    "content" => 'Faça a analise dos seguintes dados:' . $data,
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

