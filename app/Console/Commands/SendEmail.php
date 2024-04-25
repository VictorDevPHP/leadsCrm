<?php

namespace App\Console\Commands;

use App\Mail\RelatorioEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use FacebookAds\Api;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdsInsightsFields;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(){
        $insights = $this->getAdsInsights();
        $conversions = $insights['data'][0]['actions'][2]['value'] ?? null;
        $spend = $insights['data'][0]['spend'];
        $impressoes = $insights['data'][0]['impressions'] ?? 0;
        $acoes = $insights['data'][0]['actions'] ?? 0;
        $data_inicio = $insights['data'][0]['date_start'] ?? null;
        $data_fim = $insights['data'][0]['date_stop'] ?? null;
        Mail::to('victorsomulex@gmail.com')->send(new RelatorioEmail($conversions, $spend, $impressoes, $acoes, $data_inicio, $data_fim));

    }
    public function getAdsInsights(){
        $ad_account_id = env('ACT_META'); #pegar do foreach custumers
        Api::init(null, null, env('META_ADS_TOKEN'));
        $fields = [
            AdsInsightsFields::IMPRESSIONS,
            AdsInsightsFields::SPEND,
            AdsInsightsFields::ACTIONS,
            AdsInsightsFields::DATE_START,
            AdsInsightsFields::DATE_STOP
        ];
        $params = [
            'date_preset' => 'yesterday',
            'level' => 'account'
        ];
        $insights = (new AdAccount($ad_account_id))->getInsights($fields, $params)->getResponse()->getContent();
        return $insights;
    }

    public function sendWpp($impressoes){
        $url = 'https://graph.facebook.com/v19.0/123625884005199/messages';
        $accessToken = env('META_WPP_TOKEN');
        $data = array(
            'messaging_product' => 'whatsapp',
            'to' => '99999999',
            'type' => 'template',
            'template' => array(
                'name' => "Suas Impressoões foram: $impressoes na data de ontem",
                'language' => array(
                    'code' => 'pt-br'
                )
            )
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Erro ao enviar a requisição cURL: ' . curl_error($ch);
        }
        curl_close($ch);
        \Log::info($response);
    }
}
