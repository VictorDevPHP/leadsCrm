<?php

namespace App\Http\Controllers\API\fads;

use App\Http\Controllers\Controller;
use FacebookAds\Api;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdsInsightsFields;

class GetInsights extends Controller
{
    /**
     * Get insights for ads.
     *
     * @param int $id_meta The ID of the meta.
     * @return string The insights data in JSON format.
     */
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
}
