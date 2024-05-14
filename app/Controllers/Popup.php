<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\MerchantModel;
use Exception;


class Popup extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = db_connect();
        $this->merchantModel = model('MerchantModel');
    }

    public function refund_amount($refnumber = null)
    {

        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');
        $transactionApiEndpoint = 'https://x1.cardknox.com/reportjson';
        $transactionData = [
            'xSoftwareName' => "paymelimo",
            "xSoftwareVersion" => "2.0",
            "xCommand" => "Report:transaction",
            "xKey" => getkey(),
            "xVersion" => "4.5.8",
            "xRefnum" => $refnumber
        ];

        $response = $this->_post_api($transactionData, $transactionApiEndpoint);
        $transactionData = json_decode($response, true);

        // $data['transaction_detaild'] = (object) $transactionData['xReportData'][0];

        $transaction_detaild = $transactionData['xReportData'][0];

        $data['transaction_detaild']['xRefNum'] = $transaction_detaild['xRefNum'];
        $data['transaction_detaild']['xCustom01'] = $transaction_detaild['xCustom01'];
        $data['transaction_detaild']['xEnteredDate'] = $transaction_detaild['xEnteredDate'];
        $data['transaction_detaild']['xCommand'] = $transaction_detaild['xCommand'];
        $totalAmount = $transaction_detaild['xAmount'];


        $transactionRelatedData = [
            'xSoftwareName' => "paymelimo",
            "xSoftwareVersion" => "2.0",
            "xCommand" => "Report:Related",
            "xKey" => getkey(),
            "xVersion" => "4.5.8",
            "xRefnum" => $refnumber
        ];

        $relatedResponse = $this->_post_api($transactionRelatedData, $transactionApiEndpoint);
        $transactionRelatedData = json_decode($relatedResponse, true);

        $amount = 0;
        if (isset($transactionRelatedData['xReportData']) && !empty($transactionRelatedData['xReportData'])) {
            foreach ($transactionRelatedData['xReportData'] as $val) {
                if ($val['xResponseResult'] == 'Approved') {
                    $amount += $val['xRequestAmount'];
                }
            }
        }
        $data['transaction_detaild']['xAmount'] = $totalAmount - $amount;
        $data['transaction_detaild']['original'] = $totalAmount;

        if ($transactionData['xResult'] == 'E') {
            $data['customers'] = array();
        } else {
            $html = view('popup/refund_amount', $data);
            return $this->response->setJSON(['html' => $html]);
        }
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

    function capture_amount($refnumber = null)
    {
        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');
        $transactionApiEndpoint = 'https://x1.cardknox.com/reportjson';
        $transactionData = [
            'xSoftwareName' => "paymelimo",
            "xSoftwareVersion" => "2.0",
            "xCommand" => "Report:transaction",
            "xKey" => getkey(),
            "xVersion" => "4.5.8",
            "xRefnum" => $refnumber
        ];

        $response = $this->_post_api($transactionData, $transactionApiEndpoint);
        $transactionData = json_decode($response, true);

        // $data['transaction_detaild'] = (object) $transactionData['xReportData'][0];

        $transaction_detaild = $transactionData['xReportData'][0];

        $data['transaction_detaild']['xRefNum'] = $transaction_detaild['xRefNum'];
        $data['transaction_detaild']['xCustom01'] = $transaction_detaild['xCustom01'];
        $data['transaction_detaild']['xEnteredDate'] = $transaction_detaild['xEnteredDate'];
        $data['transaction_detaild']['xCommand'] = $transaction_detaild['xCommand'];
        $totalAmount = $transaction_detaild['xAmount'];


        $transactionRelatedData = [
            'xSoftwareName' => "paymelimo",
            "xSoftwareVersion" => "2.0",
            "xCommand" => "Report:Related",
            "xKey" => getkey(),
            "xVersion" => "4.5.8",
            "xRefnum" => $refnumber
        ];

        $relatedResponse = $this->_post_api($transactionRelatedData, $transactionApiEndpoint);
        $transactionRelatedData = json_decode($relatedResponse, true);

        $amount = 0;
        if (isset($transactionRelatedData['xReportData']) && !empty($transactionRelatedData['xReportData'])) {
            foreach ($transactionRelatedData['xReportData'] as $val) {
                if ($val['xResponseResult'] == 'Approved') {
                    $amount += $val['xRequestAmount'];
                }
            }
        }
        $data['transaction_detaild']['xAmount'] = $totalAmount - $amount;
        $data['transaction_detaild']['original'] = $totalAmount;

        if ($transactionData['xResult'] == 'E') {
            $data['customers'] = array();
        } else {
            $html = view('popup/capture_amount', $data);
            return $this->response->setJSON(['html' => $html]);
        }
    }

    function new_transaction($customerid = null){

         // Get customer list
         $apiEndpoint = 'https://api.cardknox.com/v2/GetCustomer';

         $postData = ['SoftwareName' => "paymelimo", "SoftwareVersion" => "1.0", "CustomerId" => $customerid];
         $response = $this->_post_api($postData, $apiEndpoint);
         $customerData = json_decode($response, true);
         $data['customers'] = $customerData;
        
        $data['customer_id']=$customerid;
        $html = view('popup/create_new_transaction', $data);
        return $this->response->setJSON(['html' => $html]);
    }
}
