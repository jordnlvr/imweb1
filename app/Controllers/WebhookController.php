<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\MerchantModel;
use App\Models\WebhookModel;


class WebhookController extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = db_connect();
        $this->merchantModel = model('MerchantModel');
        $this->webhookModel = model('WebhookModel');
    }

    public function handleWebhook()
    {
        $payload = json_decode(file_get_contents("php://input"), true);
        $payload_encode = file_get_contents("php://input");

        //save webhook resonse
        $webhookModel = new WebhookModel();
        $insert_webhook = ['response' => $payload_encode];
        $result = $webhookModel->insert($insert_webhook);

        if ($payload && $payload['AppId']) {

            $merchantModel = $this->db->table("mechants")->where('appId', $payload['AppId'])->get()->getRow();

            $merchant_id = $merchantModel->id;

            $update_merchant_data = array();
            $update_merchant_data['ApplicationStatus'] = ($payload['ApplicationStatus'] ? $payload['ApplicationStatus'] : '');
            $update_merchant_data['ProcessorMid'] = ($payload['ProcessorMid'] ? $payload['ProcessorMid'] : '');
            $update_merchant_data['TierName'] = ($payload['TierName'] ? $payload['TierName'] : '');
            $update_merchant_data['GatewayDeployed'] = ($payload['GatewayDeployed'] ? $payload['GatewayDeployed'] : '');
            $update_merchant_data['FundingHold'] = ($payload['FundingHold'] ? $payload['FundingHold'] : '');
            $update_merchant_data['CardknoxMid'] = ($payload['CardknoxMid'] ? $payload['CardknoxMid'] : '');
            $update_merchant_data['CardknoxKey'] = ($payload['CardknoxKey'] ? $payload['CardknoxKey'] : '');
            $update_merchant_data['DbaName'] = ($payload['DbaName'] ? $payload['DbaName'] : '');
            $update_merchant_data['CorporationName'] = ($payload['CorporationName'] ? $payload['CorporationName'] : '');
            $update_merchant_data['NotificationType'] = ($payload['NotificationType'] ? $payload['NotificationType'] : '');

            $merchantModel = (new MerchantModel())->find($merchant_id);
            (new MerchantModel())->update($merchant_id, $update_merchant_data);
        }
        return $this->response->setStatusCode(200)->setJSON(['status' => 'success']);
    }
}
