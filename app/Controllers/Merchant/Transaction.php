<?php

namespace App\Controllers\Merchant;

use App\Controllers\BaseController;
use Exception;

class Transaction extends BaseController
{
    protected $developers_url = 'https://api.cardknox.com/v2/';

    function __construct()
    {
    }

    public function index()
    {

        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');
        $transactionApiEndpoint = 'https://x1.cardknox.com/reportjson';
        $transactionData = [
            'xSoftwareName' => "paymelimo",
            "xSoftwareVersion" => "2.0",
            "xCommand" => "Report:All",
            "xKey" => getkey(),
            "xVersion" => "4.5.8",
            "xBeginDate" => "2024-04-26 00:00:00.000",
            "xEndDate" => date("Y-m-d h:i:s", strtotime("+10 hours")), //"2024-02-12 23:59:59.999"/,
            "xGetNewest" => true
        ];
        $response = $this->_post_api($transactionData, $transactionApiEndpoint);
        $transactionData = json_decode($response, true);
        if ($transactionData['xResult'] == 'E') {
            $data['transactions'] = array();
        } else {
            $data['transactions'] = $transactionData['xReportData'];
        }
        return view('merchant/transaction/list', $data);
    }

    private function _post_api($fields, $url)
    {
        try {
            $ch = curl_init();
            // Set the URL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            // Set the headers for the request
            $headers = [
                'Content-Type: application/json', // Correct Content-Type header
                'Authorization:' . getkey(), // Add your API key
                'X-Recurring-Api-Version: 2.1',
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Curl error: ' . curl_error($ch);
            }
            curl_close($ch);
            if ($result)
                return $result;
            else
                return false;
        } catch (Exception $e) {
            return false;
        }
    }

    // Add transaction
    public function addtransaction()
    {

        if (!$this->request->is('post')) {
            return redirect('transaction-lists');
        }
        $transactionData = $this->request->getPost();
        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');

        // Get token api
        $getTokenApiEndpoint = 'https://cdn.cardknox.com/api/ifields/gettoken';
        $tokenApiPostData = [
            'xKey' => getkey(),
            "xVersion" => "2.8",
            'xSoftwareName' => "paymelimo",
            "xSoftwareVersion" => "2.0",
            'xTokenType' => "card",
            'xData' => $transactionData['cardnumber'] ?? '',
        ];
        $response1 = $this->_post_api($tokenApiPostData, $getTokenApiEndpoint);
        $tokenData = json_decode($response1, true);

        $apiEndpoint = $this->developers_url . 'ProcessTransaction';
        $postData = [
            'SoftwareName' => "paymelimo",
            "SoftwareVersion" => "2.0",
            "Cvv" => $transactionData['cvv'] ?? '',
            'amount' => $transactionData['amount'],
            "BillFirstName" => $transactionData['firstName'] ?? '',
            'BillLastName' => $transactionData['lastName'] ?? '',
            "BillCompany" => $transactionData['company'] ?? '',
            'BillStreet' => $transactionData['address1'] ?? '',
            "BillStreet2" => $transactionData['address2'] ?? '',
            'BillCity' => $transactionData['city'] ?? '',
            "BillState" => $transactionData['state'] ?? '',
            'BillZip' => $transactionData['zip'] ?? '',
            "BillPhone" => $transactionData['phone'] ?? '',
            "Description" => "Sample One Time Transaction",
        ];
        $response = $this->_post_api($postData, $apiEndpoint);
        $responseData = json_decode($response, true);

        return $response;
    }
}
