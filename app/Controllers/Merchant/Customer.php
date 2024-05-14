<?php

namespace App\Controllers\Merchant;

use App\Controllers\BaseController;
use Exception;
use App\Models\MerchantCustomerModel;

class Customer extends BaseController
{

    protected $helpers = ['form', 'custom'];
    protected $developers_url = 'https://api.cardknox.com/v2/';

    function __construct()
    {
    }
    // customer list base on merchant
    public function index()
    {
        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');

        $apiEndpoint = $this->developers_url . 'ListCustomers';
        $postData = ['SoftwareName' => "paymelimo", "SoftwareVersion" => "1.0"];
        $response = $this->_post_api($postData, $apiEndpoint);
        $customerData = json_decode($response, true);

        if ($customerData['Result'] == 'E') {
            $data['customers'] = array();
        } else {
            $data['customers'] = $customerData['Customers'];
        }

        $data['xKey'] = getkey();

        return view('merchant/customer/lists', $data);
    }

    // customer details list
    public function details($CustomerId = null)
    {
        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');

        $apiEndpoint = $this->developers_url . 'GetCustomer';
        $postData = ['SoftwareName' => "paymelimo", "SoftwareVersion" => "1.0", "CustomerId" => $CustomerId];
        $response = $this->_post_api($postData, $apiEndpoint);
        $customerData = json_decode($response, true);
        $data['customers'] = $customerData;
        return view('merchant/customer/details', $data);
    }

    // Add customer
    public function addcustomer()
    {
        if (!$this->request->is('post')) {
            return redirect('client-lists');
        }
        $customerData = $this->request->getPost();
        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');

        $apiEndpoint = $this->developers_url . 'CreateCustomer';
        $postData = [
            'SoftwareName' => "paymelimo",
            "SoftwareVersion" => "1.0",
            'CustomerNumber' => '',
            "CustomerNotes" => $customerData['note'],
            'email' => $customerData['email'],
            "BillFirstName" => $customerData['firstName'],
            'BillLastName' => $customerData['lastName'],
            "BillCompany" => $customerData['company'],
            'BillStreet' => $customerData['address1'],
            "BillStreet2" => $customerData['address2'],
            'BillCity' => $customerData['city'],
            "BillState" => $customerData['state'],
            'BillZip' => $customerData['zip'],
            "BillPhone" => $customerData['phone'],
            "CustomerCustom01" => $customerData['referral_source']
        ];
        $response = $this->_post_api($postData, $apiEndpoint);
        $customerApiData = json_decode($response, true);
        $saveData = [
            'customer_id' => $customerApiData['CustomerId'],
            'merchant_user_id' => auth()->user()->id
        ];
        $merchantCustomerModel = new MerchantCustomerModel();
        $result = $merchantCustomerModel->insert($saveData);

        if (isset($result) && !empty($result)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Client created successfully.']);
            exit;
        } else {
            return $this->response->setJSON(['error' => true, 'message' => 'Client not created.']);
            exit;
        }
    }

    // edit customer
    public function editcustomer($CustomerId = null)
    {

        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');
        if (!$this->request->is('post')) {
            $apiEndpoint = $this->developers_url . 'GetCustomer';
            $postData = ['SoftwareName' => "paymelimo", "SoftwareVersion" => "1.0", "CustomerId" => $CustomerId];
            $response = $this->_post_api($postData, $apiEndpoint);
            $customerData = json_decode($response, true);

            $data['customers'] = $customerData;
            return view('merchant/customer/edit', $data);
        } else {
            $customerData = $this->request->getPost();
            $apiEndpoint = $this->developers_url . 'UpdateCustomer';
            $postData = [
                'SoftwareName' => "paymelimo",
                "SoftwareVersion" => "2.0",
                "Revision" => $customerData['revision'],
                "CustomerId" => $CustomerId,
                'Email' => $customerData['email'],
                "BillFirstName" => $customerData['firstName'],
                'BillLastName' => $customerData['lastName'] ?? '',
                "BillCompany" => $customerData['company'] ?? '',
                'CustomerNumber' => $customerData['number'] ?? '',
                "CustomerNotes" => $customerData['note'] ?? '',
                'BillStreet' => $customerData['address1'] ?? '',
                "BillStreet2" => $customerData['address2'] ?? '',
                'BillCity' => $customerData['city'] ?? '',
                "BillState" => $customerData['state'] ?? '',
                'BillZip' => $customerData['zip'] ?? '',
                "BillPhone" => $customerData['phone'] ?? '',
                "DefaultPaymentMethodId" => $customerData['payment_method_id'],
                "CustomerCustom01" => $customerData['referral_source']
            ];

            $response = $this->_post_api($postData, $apiEndpoint);
            $customerDataList = json_decode($response, true);

            if ($customerDataList['Result'] == 'S') {
                return $this->response->setJSON(['success' => true, 'message' => 'Client updated successfully.']);
                exit;
            } else {
                return $this->response->setJSON(['error' => true, 'message' => $customerDataList['Error']]);
                exit;
            }
        }
    }

    // Delete customer
    public function deletecustomer($CustomerId = null)
    {

        if (!$CustomerId) {
            return redirect('client-lists');
        }
        $customerData = $this->request->getPost();
        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');

        $apiEndpoint = $this->developers_url . 'DeleteCustomer';
        $postData = ['SoftwareName' => "paymelimo", "SoftwareVersion" => "1.0", "CustomerId" => $CustomerId];
        $response = $this->_post_api($postData, $apiEndpoint);
        $customerData = json_decode($response, true);

        if ($customerData['Result'] == 'S') {
            return $this->response->setJSON(['success' => true, 'message' => 'Client deleted successfully.']);
            exit;
        } else {
            return $this->response->setJSON(['error' => true, 'message' => $customerData['Error']]);
            exit;
        }

        //return redirect('client-lists');
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

    private function _post_api1($fields, $url, $key)
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
                'Authorization:' . $key, // Add your API key
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

    // Transaction list base on customer
    public function transaction($CustomerId = null)
    {
        $db = \Config\Database::connect();
        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');

        $custTransction = $db->table('customer_transaction');
        $allTransaction = $custTransction->select('*')->where('customer_id', $CustomerId)->orderBy('id', 'desc')->get()->getResult();

        // Get customer list
        $apiEndpoint = $this->developers_url . 'GetCustomer';
        $postData = ['SoftwareName' => "paymelimo", "SoftwareVersion" => "1.0", "CustomerId" => $CustomerId];
        $response = $this->_post_api($postData, $apiEndpoint);
        $customerData = json_decode($response, true);
        $data['customers'] = $customerData;

        $result = array();
        foreach ($allTransaction as $key => $value) {

            $result[$key]['id'] = $value->GatewayRefNum;
            $result[$key]['invoiceno'] = $value->order_invoice_number;
            $result[$key]['amount'] = $value->amount;
            $result[$key]['remaining_amount'] = $value->remaining_amount;
            $result[$key]['type'] = $value->transaction_type;
            $result[$key]['invoice_file'] = $value->innvoice_file;
            $result[$key]['status'] = $value->status;
        }
        $data['transactionList'] = $result;
        $data['xKey'] = getkey();
        return view('merchant/customer/transaction', $data);
    }

    public function transaction_json($referenceNo = null)
    {

        // Get Transaction By reference Number
        $transactionApiEndpoint = 'https://x1.cardknox.com/reportjson';
        $responseData_related['xReportData'] = array();

        $transactionData = [
            "xKey" => getkey(),
            "xCommand" => "Report:Related",
            "xVersion" => xVersion,
            "xSoftwareName" => xSoftwareName,
            "xSoftwareVersion" => xSoftwareVersion,
            "xRefnum" => $referenceNo,
            "xgetnewest" => true,
            //"xFields"=>'xResponseError'
        ];
        $response = $this->_post_api($transactionData, $transactionApiEndpoint);
        $responseData_related = json_decode($response, true);


        // if(empty($responseData_related['xReportData'])){
        $transactionData_main = [
            "xKey" => getkey(),
            "xCommand" => "Report:Transaction",
            "xVersion" => xVersion,
            "xSoftwareName" => xSoftwareName,
            "xSoftwareVersion" => xSoftwareVersion,
            "xRefnum" => $referenceNo,
            "xgetnewest" => true,
            // "xFields"=>'xResponseError'
        ];
        $response_main = $this->_post_api($transactionData_main, $transactionApiEndpoint);
        $responseData = json_decode($response_main, true);
        //}

        $merge_transaction = array_merge($responseData['xReportData'], $responseData_related['xReportData']);
        //print_r($merge_transaction);exit;

        $table = '';
        if ($responseData['xReportData']) {
            $table = '<table class="table child-table">';
            $table .= '<thead><tr>';
            $table .= '<th> RefNo </th>';
            $table .= '<th> Amount </th>';
            $table .= '<th> Card No </th>';
            $table .= '<th> Date </th>';
            $table .= '<th> Status </th>';
            $table .= '<th> Transaction Type </th></thead>';
            //$table .= '<th> Action </th>';
            $table .= '</tr>';
            foreach ($merge_transaction as $value) {

                $xCommand = str_replace("CC:", "", $value['xCommand']);

                $table .= '<tr>';
                $table .= '<td class="mtdcol-6" data-name="RefNo"> ' . $value['xRefNum'] . ' </td>';
                $table .= '<td class="mtdcol-6" data-name="Amount" ' . (($value['xResponseResult'] == 'Approved' && $value['xAmount'] < 0) ? 'negative-value' : '') . '""> ' . $value['xAmount'] . ' </td>';
                $table .= '<td class="mtdcol-6" data-name="Card No" > ' . substr($value['xMaskedCardNumber'], -4) . ' </td>';
                $table .= '<td class="mtdcol-6" data-name="Date" > ' . $value['xEnteredDate'] . ' </td>';
                $table .= '<td class="mtdcol-6" data-name="Status" > ' . ($value['xResponseResult'] == 'Approved' ? '<span class="badge badge-success">Approved</span>' : '<span class="badge badge-warning">Error</span>') . ' </td>';
                $table .= '<td class="mtdcol-6" data-name="Transaction Type" > ' . ($xCommand == 'Sale' ? 'Direct sale' : ($xCommand == 'AuthOnly' ? 'Pre Authorization' : $xCommand)) . ' </td>';
                //$table .= '<td> - </td>';
                $table .= '</tr>';
            }
            $table .= '</table>';
        }

        print_r($table);
        exit;
    }



    // Add transaction
    public function addtransactionOld()
    {

        if (!$this->request->is('post')) {
            return redirect('client-lists');
        }
        $transactionData = $this->request->getPost();



        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');
        $CustomerId = $transactionData['CustomerId'] ?? '';


        $paymentMethodEndpoint = $this->developers_url . 'ListPaymentMethods';
        $paymentMethodData = [
            'SoftwareName' => "paymelimo",
            "SoftwareVersion" => "1.0",
            "Filters" => ["CustomerId" => $CustomerId]
        ];
        $response = $this->_post_api($paymentMethodData, $paymentMethodEndpoint);
        $paymentListData = json_decode($response, true);

        if (isset($paymentListData) && !empty($paymentListData)) {
            $apiEndpoint = $this->developers_url . 'ProcessTransaction';
            $postData = [
                'SoftwareName' => "paymelimo",
                "SoftwareVersion" => "2.0",
                "Cvv" => $transactionData['cvv'] ?? '',
                'amount' => $transactionData['amount'],
                "BillFirstName" => $transactionData['firstName'],
                'BillLastName' => $transactionData['lastName'] ?? '',
                "BillCompany" => $transactionData['company'] ?? '',
                'BillStreet' => $transactionData['address1'],
                "BillStreet2" => $transactionData['address2'] ?? '',
                'BillCity' => $transactionData['city'],
                "BillState" => $transactionData['state'],
                'BillZip' => $transactionData['zip'],
                "BillPhone" => $transactionData['phone'] ?? '',
                "Description" => "Sample One Time Transaction",
                "PaymentMethodId" => $paymentListData['PaymentMethods'][0]['PaymentMethodId'],
            ];
            $response = $this->_post_api($postData, $apiEndpoint);
            $responseData = json_decode($response, true);
            if ($responseData['Result'] == 'S') {
                return $this->response->setJSON(['success' => true, 'message' => 'Transaction successful.']);
                exit;
            } else {
                return $this->response->setJSON(['error' => true, 'message' => $responseData['Error']]);
                exit;
            }
        } else {
            return $paymentListData;
        }
    }

    public function addtransaction()
    {
        $db = \Config\Database::connect();
        helper(['form', 'url']);

        if (!$this->request->is('post')) {
            return redirect('client-lists');
        }

        $transactionData = $this->request->getPost();


        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');
        $CustomerId = $transactionData['CustomerId'] ?? '';

        // Get token api
        $getTokenApiEndpoint = 'https://cdn.cardknox.com/api/ifields/gettoken';
        $tokenApiPostData_get = [
            'xKey' => getkey(),
            "xVersion" => xVersion,
            'xSoftwareName' => xSoftwareName,
            "xSoftwareVersion" => xSoftwareVersion,
            'xTokenType' => $transactionData['type'] ?? 'card',
            'xData' => $transactionData['cardnumber'],
        ];

        $response1 = $this->_post_api($tokenApiPostData_get, $getTokenApiEndpoint);
        $tokenData = json_decode($response1, true);


        $tokenApiPostData = [
            'xKey' => getkey(),
            'xCommand' => 'cc:' . $transactionData['transactionType'],
            "xVersion" => xVersion,
            "xSoftwareName" => xSoftwareName,
            "xSoftwareVersion" => xSoftwareVersion,
            "xCardNum" => $transactionData['cardnumber'],
            "xExp" => $transactionData['ccExpMonth'] . $transactionData['ccExpYear'],
            "xAmount" => $transactionData['amount'],
            "xCVV" => $transactionData['xCVV'],
            "xCustom01" => $transactionData['CustomerId'],
            "xInvoice" => ($transactionData['order_invoice_number'] ? $transactionData['order_invoice_number'] : '')
        ];
        $file = $this->request->getFile('innvoice_file');
        $newName = '';
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = ($file ? $file->getRandomName() : ''); // Correct usage
        }



        if (isset($tokenApiPostData) && $tokenApiPostData['xAmount'] > 0) {

            $apiEndpoint = 'https://x1.cardknox.com/gatewayjson';

            $response = $this->_post_api($tokenApiPostData, $apiEndpoint);
            $responseData = json_decode($response, true);

            if ($responseData['xResult'] == 'A') {

                if ($newName) {
                    $file->move(WRITEPATH . 'uploads', $newName);
                }


                $table = $db->table('customer_transaction');
                $insertData = [
                    'customer_id' => $transactionData['CustomerId'],
                    'order_invoice_number' => ($transactionData['order_invoice_number'] ? $transactionData['order_invoice_number'] : ''),
                    'GatewayRefNum' => $responseData['xRefNum'],
                    'amount' => $transactionData['amount'],
                    'remaining_amount' => $transactionData['amount'],
                    'innvoice_file' => $newName,
                    'transaction_type' => $transactionData['transactionType'],
                    'status' => $responseData['xStatus'],
                    'command' => 'cc:' . $transactionData['transactionType'],
                    'description' => $transactionData['description'] ?? '',
                    'reference' => $transactionData['reference'] ?? '',
                    'active' => 1
                ];
                $table->insert($insertData);

                if ($transactionData['transactionType'] == 'authonly') {
                    // get customer list
                    $apiEndpoint = $this->developers_url . 'GetCustomer';
                    $postData = ['SoftwareName' => "paymelimo", "SoftwareVersion" => "1.0", "CustomerId" => $transactionData['CustomerId']];
                    $response = $this->_post_api($postData, $apiEndpoint);
                    $customerData = json_decode($response, true);
                    $billFirstName = $customerData['BillFirstName'];
                    $to_email = $customerData['Email'];

                    // email send on refund customer amount
                    $subject = 'Your PayMe.Limo pre-authorized transaction has been approved for ' . $transactionData['CustomerId'];
                    $email = \Config\Services::email();
                    $email->setTo($to_email);
                    $email->setFrom('noreply@payme.limo', 'PayMe.Limo');

                    $email->setSubject($subject);
                    $email->setMailType('html');
                    $email->setMessage(view('email_templates/pre_auth_transaction.php', [
                        'customer_id' => $transactionData['CustomerId'],
                        'name' => $billFirstName
                    ]));
                    $email->send();
                }

                return $this->response->setJSON(['success' => true, 'message' => 'Transaction successful.']);
                exit;
            } else {
                return $this->response->setJSON(['error' => true, 'message' => $responseData['xError']]);
                exit;
            }
        } else {
            return $this->response->setJSON(['error' => true, 'message' => 'Transaction failed.']);
            exit;
        }
    }


    // Payment Request
    public function paymentRequest($CustomerId = null)
    {
        if (!$CustomerId) {
            return redirect('client-lists');
        }

        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');

        $apiEndpoint = $this->developers_url . 'GetCustomer';
        $postData = ['SoftwareName' => "paymelimo", "SoftwareVersion" => "1.0", "CustomerId" => $CustomerId];
        $response = $this->_post_api($postData, $apiEndpoint);
        $customerData = json_decode($response, true);

        $data['customers'] = $customerData;
        $data['xKey'] = getkey();

        return view('merchant/customer/payment_request', $data);
    }

    // send payment list show
    public function sendPaymentRequest($details = null)
    {


        $db = \Config\Database::connect();
        $builder = $db->table('customer_transaction');
        $checkUrl = $builder->select('*')->where('payment_url', $details)->get()->getRow();
        if (empty($checkUrl)) {
            $requestData = base64_decode($details, true);
            $linkData = explode('&', $requestData);


            if (isset($linkData[0]) && !empty($linkData[0])) {
                $CustomerId = $linkData[0];
                $xKey = $linkData[1];
                $name = $linkData[2];
                $amount = $linkData[3];

                $data['order_invoice_number'] = '';
                if (isset($linkData[4])) {
                    $order_invoice_number = $linkData[4];
                    $data['order_invoice_number'] = $order_invoice_number;
                }


                if (!$requestData) {
                    return redirect('client-lists');
                }
                $url = new \codeigniter\http\URI(current_url());
                $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');

                $apiEndpoint = $this->developers_url . 'GetCustomer';
                $postData = ['SoftwareName' => "paymelimo", "SoftwareVersion" => "2.0", "CustomerId" => $CustomerId];
                $response = $this->_post_api1($postData, $apiEndpoint, $xKey);
                $customerData = json_decode($response, true);

                $data['amount'] = $amount;
                $data['xKey'] = $xKey;
                $data['CustomerId'] = $CustomerId;
                $data['customers'] = $customerData;
                $data['merchantName'] = $customerData;
                $data['url'] = $details;

                return view('merchant/send_payment_request/payment_form', $data);
            } else {
                return view('email_templates/no_data_found');
            }
            exit;
        } else {
            return view('email_templates/no_data_found');
        }
    }


    public function send_payment_form_to_customer()
    {
        if ($this->request->getPost()) {


            $payment_url = $this->request->getPost('payment_url');
            $to_email = $this->request->getPost('email');
            $customer_id = $this->request->getPost('id');

            $apiEndpoint = $this->developers_url . 'GetCustomer';
            $postData = ['SoftwareName' => "paymelimo", "SoftwareVersion" => "1.0", "CustomerId" => $customer_id];
            $response = $this->_post_api($postData, $apiEndpoint);
            $customerData = json_decode($response, true);


            $subject = 'Payment Authorization Link from PayMe.Limo ' . $customer_id;
            $url = $payment_url;

            $email = \Config\Services::email();
            $email->setTo($to_email);
            $email->setFrom('noreply@payme.limo', 'PayMe.Limo');

            $email->setSubject($subject);
            $email->setMailType('html');
            $email->setMessage(view('email_templates/customer_payment_request_form.php', [
                'customer_id' => $customer_id,
                'firstname' => ($customerData['BillFirstName'] ? $customerData['BillFirstName'] : ''),
                'lastname' => ($customerData['BillLastName'] ? $customerData['BillLastName'] : ''),
                'url' => $url
            ]));

            if ($email->send()) {
                return $this->response->setJSON(['success' => true, 'message' => 'Payment form sent successfully.']);
                exit;
            } else {
                return $this->response->setJSON(['error' => true, 'message' => 'Email not sent.']);
                exit;
            }
        }
    }


    // Add transaction
    public function addTransactionWithLink()
    {
        $transactionData = $this->request->getPost();

        $requestData = base64_decode($transactionData['url'], true);
        $linkData = explode('&', $requestData);
        $transactionData['amount'] = $linkData[3];
        $transactionData['order_invoice_number'] = $linkData[4];



        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');

        $CustomerId = $transactionData['CustomerId'] ?? '';
        $xKey = $transactionData['xKey'];
        $to_email = $transactionData['email'];

        $db = \Config\Database::connect();

        // Get token api
        $getTokenApiEndpoint = 'https://cdn.cardknox.com/api/ifields/gettoken';
        $tokenApiPostData = [
            'xKey' => $xKey,
            "xVersion" => "2.8",
            'xSoftwareName' => "paymelimo",
            "xSoftwareVersion" => "2.0",
            'xTokenType' => "card",
            'xData' => $transactionData['xCardNum'],
        ];
        $response1 = $this->_post_api1($tokenApiPostData, $getTokenApiEndpoint, $xKey);
        $tokenData = json_decode($response1, true);

        // Create Payment Method api
        $getPaymentEndpoint = $this->developers_url . 'CreatePaymentMethod';
        $paymentPostData = [
            'CustomerId' => $CustomerId,
            "token" => $tokenData['xResultData']['xToken'],
            'SoftwareName' => "paymelimo",
            "SoftwareVersion" => "2.0",
            'TokenType' => $transactionData['pt'],
            'Exp' => $transactionData['ccExpMonth'] . $transactionData['ccExpYear']
        ];
        $response2 = $this->_post_api1($paymentPostData, $getPaymentEndpoint, $xKey);
        $paymentListData = json_decode($response2, true);

        if (isset($paymentListData['PaymentMethodId']) && !empty($paymentListData['PaymentMethodId'])) {

            // Process Transaction api
            $apiEndpoint = $this->developers_url . 'ProcessTransaction';
            $postData = [
                'SoftwareName' => "paymelimo",
                "SoftwareVersion" => "2.0",
                "Cvv" => $transactionData['xCVV'] ?? '',
                'amount' => $transactionData['amount'],
                "BillFirstName" => $transactionData['firstName'],
                'BillLastName' => $transactionData['lastName'] ?? '',
                "BillCompany" => $transactionData['company'] ?? '',
                'BillStreet' => $transactionData['address1'],
                "BillStreet2" => $transactionData['address2'] ?? '',
                'BillCity' => $transactionData['city'],
                "BillState" => $transactionData['state'],
                'BillZip' => $transactionData['zip'],
                "BillPhone" => $transactionData['phone'] ?? '',
                // "Description" => "Sample One Time Transaction",
                "PaymentMethodId" => $paymentListData['PaymentMethodId'],
            ];
            $response = $this->_post_api1($postData, $apiEndpoint, $xKey);
            $responseData = json_decode($response, true);
            if ($responseData['Result'] == 'S' && $responseData['GatewayStatus'] == 'Approved') {

                $subject = 'PayMe.Limo Card Transaction Approved for ' . $CustomerId;
                $email = \Config\Services::email();
                $email->setTo($to_email);
                $email->setFrom('noreply@payme.limo', 'PayMe.Limo');

                $email->setSubject($subject);
                $email->setMailType('html');
                $email->setMessage(view('email_templates/customer_transaction_successfully.php', [
                    'customer_id' => $CustomerId,
                    'name' => $transactionData['firstName'],
                    'GatewayRefNum' => $responseData['GatewayRefNum'],
                    'amount' => $transactionData['amount'],
                ]));
                $email->send();

                $builder = $db->table('customer_transaction');
                $userData = [
                    'customer_id' => $CustomerId,
                    'payment_url' => $transactionData['url'],
                    'order_invoice_number' => $transactionData['order_invoice_number'],
                    'GatewayRefNum' => $responseData['GatewayRefNum'],
                    'amount' => $transactionData['amount'],
                    'remaining_amount' => $transactionData['amount'],
                    'transaction_type' => 'sale',
                    'status' => $responseData['GatewayStatus'],
                    'command' => 'cc:sale',
                    'active' => 1
                ];
                $builder->insert($userData);

                return $this->response->setJSON(['success' => true, 'message' => 'Transaction successful.']);
                exit;
            } else if ($responseData['GatewayStatus'] == 'Error') {
                return $this->response->setJSON(['error' => true, 'message' => $responseData['GatewayErrorMessage']]);
                exit;
            } else {
                return $this->response->setJSON(['error' => true, 'message' => $responseData['Error']]);
                exit;
            }
        } else {
            return $this->response->setJSON(['error' => true, 'message' => $paymentListData['Error']]);
            exit;
        }
    }

    // Thank you
    public function thank_you()
    {
        return view('email_templates/thank_you.php');
    }

    public function downloadFile($filename)
    {
        // Assuming $filename is the name of the file
        $file_path = WRITEPATH . 'uploads/' . $filename;
        // Check if the file exists
        if (file_exists($file_path)) {
            // Provide the file for download
            return $this->response->download($file_path, null);
        } else {
            // Handle file not found
            return redirect()->to(base_url('error/not_found'));
        }
    }
}
