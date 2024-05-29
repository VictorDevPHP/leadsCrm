<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Anuncio;
use App\Models\Customer;
use Illuminate\Console\Command;
use FacebookAds\Api;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdsInsightsFields;
use Illuminate\Support\Facades\Log;

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
    public function handle()
    {
        $customers = Customer::all()->toArray();
        foreach ($customers as $customer) {
            $ids_meta = Account::where('id_cliente', $customer['id'])->where('status', 'Ativo')->get()->toArray();
            $texto_whatsapp = '';
            $saudacao = '';
            $flag = 0;
            foreach ($ids_meta as $id_meta) {
                if ($id_meta['status'] == 'Ativo') {
                    if ($flag == 0) {
                        $hora_atual = date('H');
                        if ($hora_atual >= 6 && $hora_atual < 12) {
                            $saudacao = "Bom dia!";
                        } elseif ($hora_atual >= 12 && $hora_atual < 18) {
                            $saudacao = "Boa tarde!";
                        } else {
                            $saudacao = "Boa noite!";
                        }
                        $texto_whatsapp .= $saudacao . ' ' . $customer['name'] . "! 🌟 Que incrível ver os resultados dos seus anúncios Meta Ads!" . PHP_EOL;
                    }
                    $insights = $this->getAdsInsights($id_meta['id_meta']);
                    if (!empty($insights['data'])) {
                        $spend = $insights['data'][0]['spend'];
                        $impressoes = $insights['data'][0]['impressions'] ?? 0;
                        $acoes = $insights['data'][0]['actions'] ?? 0;
                        foreach ($acoes as $action) {
                            if ($action['action_type'] === 'onsite_conversion.messaging_conversation_started_7d') {
                                $conversations_started = $action['value'];
                                break;
                            } else {
                                $conversations_started = 0;
                            }
                        }
                        foreach ($acoes as $action) {
                            if ($action['action_type'] === 'post_reaction') {
                                $actions = $action['value'];
                                break;
                            } else {
                                $actions = 0;
                            }
                        }
                        $data_inicio = $insights['data'][0]['date_start'] ?? null;
                        $data_fim = $insights['data'][0]['date_stop'] ?? null;

                        $texto_whatsapp .= "\nConta: *" . $insights['data'][0]['account_name'] . "*";
                        $texto_whatsapp .= "\nCom um investimento de *R$" . number_format($spend, 2, ',', '.') . "*" . ' seus anúncios tiveram ' . 'um total de ' . "*" . $impressoes . "*" . ' vizualizações.';
                        if ($actions || ($conversations_started !== null && $conversations_started > 0)) {
                            $texto_adicional = "\nE o melhor de tudo, ";
                            if ($actions) {
                                if ($actions > 1) {
                                    $textR = 'reações';
                                } else {
                                    $textR = 'reação';
                                }
                                $texto_adicional .= "isso gerou *" . $actions . "*" . " $textR ";
                            }
                            if ($actions != 0 && $conversations_started != 0) {
                                $e = 'e ';
                            } else {
                                $e = '';
                            }
                            if ($conversations_started !== null && $conversations_started > 0) {
                                $texto_adicional .= $e . $conversations_started . ' mensagens de WhatsApp';
                            }
                            $texto_adicional .= "! 🚀✨" . "\n\n";
                            $texto_whatsapp .= $texto_adicional;
                        }
                        
                    } else {
                        Log::channel('log-whatsapp')->info('Data[] para o cliente' . $customer['name'] . ' ID:' . $id_meta['id_meta']);
                    }
                    $newInsights = [
                        'custo' => $spend ?? 0,
                        'impressoes' => $impressoes ?? 0,
                        'conversion' => $conversations_started ?? 0,
                        'post_reaction' => $actions ?? 0,
                        'data_inicio' => $data_inicio ?? 0,
                        'data_fim' => $data_fim ?? 'sem data',
                    ];
                    $insightsDB = Anuncio::where('id_meta', $id_meta['id_meta'])->value('insights');
                    $insightsDB[now()->format('Y/m/d')] = $newInsights;
                    $anuncio = Anuncio::updateOrCreate(
                        [
                            'id_meta' => $id_meta['id_meta'],
                            'id_customer' => $customer['id'],
                        ],
                        [
                            'insights' => $insightsDB
                        ]

                    );
                    $flag++;
                }
            }
            if (!empty($ids_meta)) {
                sleep(3);
                $this->sendWpp($customer['whatsapp'], $texto_whatsapp, 'XlWw2iQiOVic7DIeu3k4cKkvxtCyCU8eG7dSm665685ea4169b');
                echo $texto_whatsapp . PHP_EOL;
                echo PHP_EOL;
                echo '---------------------------------------------------------------------------------------------------------------------------------------------------';
                echo PHP_EOL;
            }
            if (!empty($texto_whatsapp)) {
                $log_message = 'Mensagem enviada via WhatsApp para ' . $customer['name'] . ' em ' . now()->format('Y-m-d H:i:s') . PHP_EOL;
                Log::channel('log-whatsapp')->info($log_message);
            } else {
                Log::channel('log-whatsapp')->info('Sem dados para o cliente ' . $customer['name']);
            }
        }
    }
    public function getAdsInsights($id_meta)
    {
        $ad_account_id = $id_meta;
        Api::init(null, null, env('META_ADS_TOKEN'));
        $fields = [
            AdsInsightsFields::ACCOUNT_NAME,
            AdsInsightsFields::IMPRESSIONS,
            AdsInsightsFields::SPEND,
            AdsInsightsFields::ACTIONS,
            AdsInsightsFields::DATE_START,
            AdsInsightsFields::DATE_STOP,
        ];
        $params = [
            'date_preset' => 'yesterday',
            'level' => 'account'
        ];
        $insights = (new AdAccount($ad_account_id))->getInsights($fields, $params)->getResponse()->getContent();
        return $insights;
    }
    function sendWpp($wpp, $message, $key){
        $url = 'http://localhost:3000/wppconnect/sendMessage';
        $data = array('phone' => $wpp, 'text' => $message, 'key' => $key);
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
