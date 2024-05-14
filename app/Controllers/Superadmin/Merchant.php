<?php

namespace App\Controllers\Superadmin;

//use App\Models\UserModel;
use App\Controllers\BaseController;
use App\Models\MerchantModel;
use App\Models\ApplicationModel;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Validation\ValidationRules;
use CodeIgniter\Shield\Exceptions\ValidationException;
use CodeIgniter\Events\Events;
use CodeIgniter\Config\Services;
use CodeIgniter\Email\Email;
use CodeIgniter\HTTP\Header;
use Exception;
use \Firebase\JWT\JWT;

class Merchant extends BaseController
{

    private $db;
    protected $developers_url = 'https://api.cardknox.com/v2/';
    public function __construct()
    {
        $this->db = db_connect();
        $this->merchantModel = model('MerchantModel');
        $this->applicationModel = model('ApplicationModel');
    }

    protected $helpers = ['form', 'custom', 'security'];

    public function index()
    {

        $url = new \codeigniter\http\URI(current_url());

        $merchantModel = new MerchantModel();
        $data['metchant'] = $merchantModel->orderBy('id', 'desc')->where('status !=', 0)->findAll();

        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');

        return view('superadmin/merchant-lists', $data);
    }

    public function leads()
    {

        $url = new \codeigniter\http\URI(current_url());

        $merchantModel = new MerchantModel();
        $data['leads'] = $merchantModel->orderBy('id', 'desc')->where('status', 0)->findAll();
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');

        return view('superadmin/leads-lists', $data);
    }

    public function getLeadById($id)
    {

        $url = new \codeigniter\http\URI(current_url());

        $merchantModel = new MerchantModel();
        $data = $merchantModel->find($id);
        return $this->response->setJSON($data);
    }

    public function merchant_boarding($user_id)
    {

        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');

        return view('superadmin/merchant-boarding-form', $data);
    }


    public function addmerchant()
    {
        if ($this->request->getPost()) {
            $merchant_id = $this->request->getPost('merchant_id');
            $first_name = $this->request->getPost('firstName');
            $last_name  = $this->request->getPost('lastName');
            $title  = $this->request->getPost('title');
            $dba      = $this->request->getPost('dbaName');
            $phone_number      = $this->request->getPost('ownerCellPhone');
            $email      = $this->request->getPost('agentEmail');
            $corporate_name      = $this->request->getPost('corporateName');
            $website      = $this->request->getPost('website');
            $street_address      = $this->request->getPost('streetAddress');
            $city      = $this->request->getPost('city');
            $state      = $this->request->getPost('state');
            $zip      = $this->request->getPost('zip');
            $country      = $this->request->getPost('country');
            $fax      = $this->request->getPost('fax');
            $add_contact_name      = $this->request->getPost('add_name');
            $add_contact_title      = $this->request->getPost('add_title');
            $add_contact_phonenumber      = $this->request->getPost('add_phonenumber');

            $data = [
                'firstname' => ($first_name ? $first_name : ''),
                'lastname'    => ($last_name ? $last_name : ''),
                'title'    => ($title ? $title : ''),
                'dba'    => ($dba ? $dba : ''),
                'phone_number'    => ($phone_number ? $phone_number : ''),
                'email'    => ($email ? $email : ''),
                'corporate_name'    => ($corporate_name ? $corporate_name : ''),
                'website'    => ($website ? $website : ''),
                'street_address'    => ($street_address ? $street_address : ''),
                'city'    => ($city ? $city : ''),
                'state'    => ($state ? $state : ''),
                'zip'    => ($zip ? $zip : ''),
                'country'    => ($country ? $country : ''),
                'fax'    => ($fax ? $fax : ''),
                'add_contact_name'    => ($add_contact_name ? $add_contact_name : ''),
                'add_contact_title'    => ($add_contact_title ? $add_contact_title : ''),
                'add_contact_phonenumber'    => ($add_contact_phonenumber ? $add_contact_phonenumber : ''),
                'status'    => 0
            ];

            $merchantModel = new MerchantModel();
            if ($merchant_id && $merchant_id != 0) {
                $result = $merchantModel->update($merchant_id, $data);
            } else {
                $result = $merchantModel->insert($data);
            }


            if ($result) {
                if ($merchant_id && $merchant_id != 0) {
                    return $this->response->setJSON(['success' => true, 'message' => 'Lead updated successfully.']);
                } else {
                    return $this->response->setJSON(['success' => true, 'message' => 'Lead created successfully.']);
                }
                exit;
            } else {
                return $this->response->setJSON(['error' => true, 'message' => 'Lead not created.']);
                exit;
            }
        }
    }

    public function send_form_to_merchant()
    {

        if ($this->request->getPost()) {

            $dba_name = $this->request->getPost('dba_name');
            $to_email = $this->request->getPost('email');
            $merchant_id = $this->request->getPost('id');

            $numberAsString = strval($merchant_id);

            $base64Encoded = base64_encode($numberAsString);
            $hashedId = 'nd74mokCFlu59dG3Ao1mas3VuQ2Ft2ui' . $base64Encoded;
            $redirectUrl = site_url("merchant/mpa/{$hashedId}");

            $subject = $dba_name . " Merchant Application link to register with PayMe.Limo";

            $email = \Config\Services::email();
            $email->setTo($to_email);
            $email->setFrom('noreply@payme.limo', 'PayMe.Limo');

            $email->setSubject($subject);
            $email->setMailType('html');
            $email->setMessage(view('email_templates/merchant_application_form.php', [
                'dba_name' => $dba_name,
                'applicationlink' => $redirectUrl
            ]));

            //$email->setMessage($message);
            //$email->send();

            if ($email->send()) {

                $merchantModel = (new MerchantModel())->find($merchant_id);
                $merchantModel['mpa_form_email'] = 1;
                (new MerchantModel())->update($merchant_id, $merchantModel);

                return $this->response->setJSON(['success' => true, 'message' => 'Merchant form sent successfully.']);
                exit;
            } else {
                return $this->response->setJSON(['error' => true, 'message' => 'Email not sent.']);
                exit;
            }
        }
    }

    public function update_form_to_merchant()
    {

        if ($this->request->getPost()) {

            $to_email = $this->request->getPost('email');
            $lead_id = $this->request->getPost('id');

            if ($to_email && $lead_id) {

                $merchantModel = (new MerchantModel())->find($lead_id);
                $merchantModel['email'] = $to_email;
                (new MerchantModel())->update($lead_id, $merchantModel);

                return $this->response->setJSON(['success' => true, 'message' => 'Lead email update successful.']);
                exit;
            } else {
                return $this->response->setJSON(['error' => true, 'message' => 'Email not updated.']);
                exit;
            }
        }
    }

    public function method($hashedId)
    {
        $hash = \Config\Services::hash();

        // Verify and get the original ID
        $originalId = $hash->check($hashedId) ? $hash->getHashInfo($hashedId)['options']['cost'] : null;

        // Now you can use $originalId in your controller logic
    }


    public function sendemail()
    {
        $email = \Config\Services::email();
        $merchantName = "John Doe"; // Replace with actual merchant name
        $applicationDetails = "Your application details"; // Replace with actual application details
        $adminName = "Administrator"; // Replace with actual administrator name

        $email->setTo('kiranp@intellimedianetworks.net'); // Replace with actual merchant email
        $email->setSubject("Jim's Limo Inc Completed Merchant Application Notification");
        $email->setMailType('html');
        $email->setMessage(view('email_templates/merchant_onboarding', [
            'merchantName' => $merchantName,
            'applicationDetails' => $applicationDetails,
            'adminName' => $adminName,
        ]));
        if ($email->send()) {
            echo 'Email sent successfully.';
        } else {
            echo 'Email could not be sent. Please contact your administrator.';
            echo $email->printDebugger(['headers']);
        }
    }

    public function update_merchant_key()
    {
        if ($this->request->getPost()) {

            $key = $this->request->getPost('key');
            $mid = $this->request->getPost('mid');
            $processorMid = $this->request->getPost('processormid');
            $merchant_id = $this->request->getPost('id');


            if ($key && $merchant_id) {

                $merchantModel = (new MerchantModel())->find($merchant_id);
                $merchantModel['key'] = $key;
                $merchantModel['CardknoxMid'] = $mid;
                $merchantModel['ProcessorMid'] = $processorMid;
                (new MerchantModel())->update($merchant_id, $merchantModel);

                return $this->response->setJSON(['success' => true, 'message' => 'Merchant key updated successfully.']);
                exit;
            } else {
                return $this->response->setJSON(['error' => true, 'message' => 'Something went wrong.']);
                exit;
            }
        }
    }

    public function checkEmail()
    {

        $email = trim((string)$this->request->getPost('email'));
        $lead_id = trim((int)$this->request->getPost('lead_id'));

        if ($lead_id && $email && $lead_id != 0)
            $merchantModel = $this->db->table("mechants")->where('email', $email)->where('id!=', $lead_id)->countAllResults();
        else
            $merchantModel = $this->db->table("mechants")->where('email', $email)->countAllResults();

        if ($merchantModel > 0) {
            echo 'false';
        } else {
            echo 'true';
        }

        //return $this->response->setJSON(['exists' => ($merchantModel > 0)]);
    }

    public function paymentsite()
    {
        $url = new \codeigniter\http\URI(current_url());

        $userModel = new UserModel();
        $data['users'] = $userModel->orderBy('id', 'DESC')->findAll();
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');

        return view('superadmin/paymentsite', $data);
    }

    public function submitgoapp()
    {
        $db = \Config\Database::connect();

        $db->transStart();
        try {

            if ($this->request->getPost()) {



                $corporateName = $this->request->getPost('corporateName');
                $businessPhone = $this->request->getPost('businessPhone');
                $businessAddress_streetAddress = $this->request->getPost('businessAddress_streetAddress');
                $businessAddress_state = $this->request->getPost('businessAddress_state');
                $dba = $this->request->getPost('dba');
                $businessEmail = $this->request->getPost('businessEmail');
                $businessAddress_city = $this->request->getPost('businessAddress_city');
                $businessAddress_zip = $this->request->getPost('businessAddress_zip');
                $goodsOrServicesDescription = goodsOrServicesDescription;
                $bankName = $this->request->getPost('bankName');
                $routingNumber = $this->request->getPost('routingNumber');
                $taxID = $this->request->getPost('taxID');
                $accountNumber = $this->request->getPost('accountNumber');
                $firstName = $this->request->getPost('firstName');
                $address_streetAddress = $this->request->getPost('address_streetAddress');
                $address_state = $this->request->getPost('address_state');
                $phoneNumber = $this->request->getPost('phoneNumber');
                $socialSecurityNumber = $this->request->getPost('socialSecurityNumber');
                $lastName = $this->request->getPost('lastName');
                $address_city = $this->request->getPost('address_city');
                $address_zip = $this->request->getPost('address_zip');
                $cellPhoneNumber = $this->request->getPost('cellPhoneNumber');
                $dateOfBirth = $this->request->getPost('dateOfBirth');
                $token = $this->request->getPost('token');

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://psapi.cardknox.com/boarding/v1/SubmitGoApp',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{
                    "apiKey": "' . SUPERADMIN_API_KEY . '",
                    "tierName": "' . TIER_NAME . '",
                    "corporateName": "' . $corporateName . '",
                    "dbaName": "' . $dba . '",
                    "ownershipType": "corporation",
                    "businessStartDate": "2024-01-23",
                    "taxId": "' . $taxID . '",
                    "businessEmail": "' . $businessEmail . '",
                    "businessPhone": "' . $businessPhone . '",
                    "businessAddress": {
                        "streetAddress": "' . $businessAddress_streetAddress . '",
                        "city": "' . $businessAddress_city . '",
                        "state": "' . $businessAddress_state . '",
                        "zip": "' . $businessAddress_zip . '",
                        "country": "United States"
                    },
                    "mailingAddress": {
                        "streetAddress": "' . $address_streetAddress . '",
                        "city": "' . $address_city . '",
                        "state": "' . $address_state . '",
                        "zip": "' . $address_zip . '",
                        "country": "United States"
                    },
                    "productSold": "' . $goodsOrServicesDescription . '",
                    "bankingInformation": {
                        "bankName": "' . $bankName . '",
                        "routingNumber": "' . $routingNumber . '",
                        "accountNumber": "' . $accountNumber . '"
                    },
                    "signerInformationList": [
                        {
                        "ssn": "' . $socialSecurityNumber . '",
                        "dateOfBirth": "' . date('Y-m-d', strtotime($dateOfBirth)) . '",
                        "firstName": "' . $firstName . '",
                        "lastName": "' . $lastName . '",
                        "address": {
                            "streetAddress": "' . $address_streetAddress . '",
                            "city": "' . $address_city . '",
                            "state": "' . $address_state . '",
                            "zip": "' . $address_zip . '",
                            "country": "United States"
                        },
                        "title": "Owner",
                        "ownershipPercentage": 100,
                        "title": "Owner",
                        "ownerCellPhone": "222-333-4444"
                        }
                    ],
                    "signature": {
                        "token": "' . $token . '"
                      }
                    }',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
                $response_decode = json_decode($response);
                //print_r($response_decode);exit;


                if ($response_decode->status == 'Error') {
                    return $this->response->setJSON(['error' => true, 'message' => $response_decode->error->errorMessages]);
                    exit;
                } else if ($response_decode->status == 'Success') {

                    // print_r($this->getwebhook($response_decode->appId));
                    //exit;

                    $insert_application = [
                        'appId' => $response_decode->appId,
                        //  'pendingPaymentSiteUrl' => $response_decode->pendingPaymentSiteUrl,
                        'pendingPaymentSiteUrl' => '',
                        'refnum' => $response_decode->refnum,
                        'dba_name' => $dba,
                        //  'signature_token'=>($token)?$token:''
                    ];

                    $applicationModel = new ApplicationModel();
                    $applicationModel->insert($insert_application);

                    $update_merchant_data = array();
                    $update_merchant_data['firstname'] = ($firstName ? $firstName : '');
                    $update_merchant_data['lastname'] = ($lastName ? $lastName : '');
                    $update_merchant_data['title'] = 'Owner';
                    $update_merchant_data['dba'] = ($dba ? $dba : '');
                    $update_merchant_data['phone_number'] = ($businessPhone ? $businessPhone : '');
                    $update_merchant_data['email'] = ($businessEmail ? $businessEmail : '');
                    $update_merchant_data['corporate_name'] = ($corporateName ? $corporateName : '');
                    $update_merchant_data['website'] = '';
                    $update_merchant_data['street_address'] = $businessAddress_streetAddress;
                    $update_merchant_data['city'] = ($businessAddress_city ? $businessAddress_city : '');
                    $update_merchant_data['zip'] = ($businessAddress_zip ? $businessAddress_zip : '');
                    $update_merchant_data['country'] = "United States";
                    $update_merchant_data['status'] = 1;
                    $update_merchant_data['appId'] = $response_decode->appId;
                    $update_merchant_data['pendingPaymentSiteUrl'] =  '';
                    //   $update_merchant_data['pendingPaymentSiteUrl'] =  $response_decode->pendingPaymentSiteUrl;
                    // $update_merchant_data['signature_token'] = ($token)?$token:'';

                    $merchantModel = $this->db->table("mechants")->where('dba', $dba)->get()->getRow();
                    if (($merchantModel) && $merchantModel->status == 0) {
                        $merchant_id = $merchantModel->id;
                        $merchantModel = (new MerchantModel())->find($merchant_id);
                        (new MerchantModel())->update($merchant_id, $update_merchant_data);
                    } else {
                        $merchantModel_insert = new MerchantModel();
                        $result = $merchantModel_insert->insert($update_merchant_data);
                    }

                    $db->transComplete();
                    // Check if the transaction was successful
                    if ($db->transStatus() === false) {
                        $db->transRollback();
                        // Handle the case where a transaction failed
                        return $this->response->setJSON(['error' => true, 'message' => array('Oops! Something went wrong. Please contact your administrator.')]);

                        exit;
                    } else {

                        $db->transCommit();

                        $email = \Config\Services::email();
                        $merchantName = $firstName . ' ' . $lastName; // Replace with actual merchant name
                        $email->setTo($businessEmail); // Replace with actual merchant email
                        $email->setFrom('noreply@payme.limo', 'PayMe.Limo');
                        $email->setSubject('Successful Onboarding');
                        $email->setMailType('html');
                        $email->setMessage(view('email_templates/merchant_onboarding', [
                            'merchantName' => $merchantName
                        ]));


                        if ($email->send()) {
                            return $this->response->setJSON(['success' => true, 'message' => 'Successfully onboarded. Please check your email.']);
                            exit;
                        } else {
                            return $this->response->setJSON(['error' => true, 'message' => array('Email not sent. Please contact the admin.')]);
                            exit;
                        }
                        // The transaction was successful, commit the changes

                    }
                }
            }
        } catch (\Exception $e) {
            $db->transRollback();
            // Handle exceptions
            return $this->response->setJSON(['error' => true, 'message' => array('Oops! Something went wrong. Please contact your administrator')]);
            exit;
        }
    }

    public function CreatenewKey()
    {
    }

    public function getwebhook()
    {
        $webhookUrl = 'https://dev.payme.limo/webhook';

        $data = '{
            "AppId": "' . $appid . '",
        }';
        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
        curl_close($ch);
        $response_decode = json_decode($response);
        // print_r("sfwge");
        // exit;
        return $response_decode;
    }

    public function details($MerchantId = null)
    {
        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');

        $merchantData = $this->db->table("mechants")->where('id', $MerchantId)->get()->getRow();

        $data['merchant_detail'] = $merchantData;
        return view('superadmin/merchant-details', $data);
    }

    function send_logindetail()
    {
        $db = \Config\Database::connect();
        $db->transStart();
        try {
            if ($this->request->getPost()) {

                $merchant_id = $this->request->getPost('merchant_id');
                $merchantData = $this->db->table("mechants")->where('id', $merchant_id)->get()->getRow();


                if ($merchantData && $merchantData->status == 1) {

                    $email = $merchantData->email;
                    $password = generate_random_password(8);
                    $username = generate_username_from_email($email);


                    $userModel = new UserModel();
                    $userData = [
                        'username' => $username,
                        'email' => $email,
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'active' => 1
                    ];

                    // Insert the user data into the database
                    $userModel->save($userData);



                    if ($userModel->getInsertID()) {

                        $update_merchant_data = array();
                        $update_merchant_data['status']   = 2;
                        $update_merchant_data['signature_token']   = $password;
                        $update_merchant_data['userId']   = $userModel->getInsertID();

                        (new MerchantModel())->update($merchant_id, $update_merchant_data);

                        $user = $userModel->findById($userModel->getInsertID());
                        // Add to default group
                        $userModel->addToDefaultGroup($user);

                        $builder = $db->table('auth_identities');

                        $userData_auth = [
                            'user_id' => $userModel->getInsertID(),
                            'name' => $username,
                            'type' => 'email_password',
                            'secret' => $email,
                            'secret2' => password_hash($password, PASSWORD_DEFAULT)
                        ];
                        $builder->insert($userData_auth);


                        $email = \Config\Services::email();
                        $merchantName = $merchantData->firstname . ' ' . $merchantData->lastname; // Replace with actual merchant name
                        $email->setTo($merchantData->email); // Replace with actual merchant email
                        $email->setFrom('noreply@payme.limo', 'PayMe.Limo');
                        $email->setSubject('Login Credentials');
                        $email->setMailType('html');
                        $email->setMessage(view('email_templates/merchant_verification_email', [
                            'merchantName' => $merchantName,
                            'email' => $merchantData->email,
                            'password' => $password
                        ]));

                        $db->transComplete();
                        // Check if the transaction was successful
                        if ($db->transStatus() === false) {
                            $db->transRollback();
                            return $this->response->setJSON(['error' => true, 'message' => 'Something went wrong.']);
                            exit;
                        } else {
                            $db->transCommit();
                        }

                        if ($email->send()) {
                            $email1 = \Config\Services::email();
                            $merchantName = $merchantData->firstname . ' ' . $merchantData->lastname; // Replace with actual merchant name
                            $email1->setTo($merchantData->email); // Replace with actual merchant email
                            $email1->setFrom('noreply@payme.limo', 'PayMe.Limo');
                            $email1->setSubject('Important PCI Information - ' . $merchantData->dba . '');
                            $email1->setMailType('html');
                            $email1->setMessage(view('email_templates/merchant_pci_information', [
                                'merchantName' => $merchantName,
                            ]));
                            $email1->send();

                            return $this->response->setJSON(['success' => true, 'message' => 'Login details sent successfully.']);
                            exit;
                        } else {
                            return $this->response->setJSON(['error' => true, 'message' => 'Email not sent.']);
                            exit;
                        }
                    } else {
                        return $this->response->setJSON(['error' => true, 'message' => 'Email not sent.']);
                        exit;
                    }
                }
                if ($merchantData && $merchantData->status == 2) {

                    $email = $merchantData->email;
                    $password = generate_random_password(8);

                    if (empty($merchantData->userId)) {
                        $user_data = $this->db->table("auth_identities")->where('secret', trim($email))->get()->getRow();
                        //$user_id = $user_data->user_id;
                        $update_merchant_data = array();
                        $update_merchant_data['signature_token']   = $password;
                        $update_merchant_data['userId']   = $user_data->user_id;
                        (new MerchantModel())->update($merchant_id, $update_merchant_data);

                        //Update Merchant Password
                        //$update_merchant_password = array();
                        //$update_merchant_password['password']   = password_hash($password, PASSWORD_DEFAULT);
                        //$update_merchant_password['active']   = 1;
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                        $builder = $db->table('auth_identities');
                        $builder->where('user_id', $user_data->user_id)->set('secret2', $hashedPassword)->update();
                    } else {

                        $update_merchant_data = array();
                        $update_merchant_data['signature_token']   = $password;
                        $update_merchant_data['userId']   = $merchantData->userId;

                        (new MerchantModel())->update($merchant_id, $update_merchant_data);
                        //Update Merchant Password
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                        $user_data = $db->table("auth_identities")->where('user_id', $merchantData->userId)->get()->getRow();

                        if ($user_data) {
                            $builder = $db->table('auth_identities');
                            $builder->where('user_id', $merchantData->userId)->set('secret2', $hashedPassword)->update();
                        } else {
                            $email = $merchantData->email;
                            $password = generate_random_password(8);
                            $username = generate_username_from_email($email);

                            // die('dddd');

                            $builder = $db->table('auth_identities');
                            $userData = [
                                'user_id' => $merchantData->userId,
                                'name' => $username,
                                'type' => 'email_password',
                                'secret' => $email,
                                'secret2' => password_hash($password, PASSWORD_DEFAULT)
                            ];
                            $builder->insert($userData);
                        }
                    }

                    $db->transComplete();
                    // Check if the transaction was successful
                    if ($db->transStatus() === false) {
                        $db->transRollback();
                        return $this->response->setJSON(['error' => true, 'message' => 'Something went wrong.']);
                        exit;
                    } else {
                        $db->transCommit();
                    }

                    if ($email && $password) {
                        $email = \Config\Services::email();
                        $merchantName = $merchantData->firstname . ' ' . $merchantData->lastname; // Replace with actual merchant name
                        $email->setTo($merchantData->email); // Replace with actual merchant email
                        $email->setSubject('Login Detail');
                        $email->setFrom('noreply@payme.limo', 'PayMe.Limo');
                        $email->setMailType('html');
                        $email->setMessage(view('email_templates/merchant_verification_email', [
                            'merchantName' => $merchantName,
                            'email' => $merchantData->email,
                            'password' => $password
                        ]));
                        if ($email->send()) {
                            return $this->response->setJSON(['success' => true, 'message' => 'Login details sent successfully.']);
                            exit;
                        } else {
                            return $this->response->setJSON(['error' => true, 'message' => 'Email not sent.']);
                            exit;
                        }
                    } else {
                        return $this->response->setJSON(['error' => true, 'message' => 'Email not sent.']);
                        exit;
                    }
                }
            }
        } catch (\Exception $e) {
            $db->transRollback();
            // Handle exceptions
            return $this->response->setJSON(['error' => true, 'message' => 'Oops! Something went wrong. Please contact your administrator.']);
            exit;
        }
    }

    function generate_logindetail()
    {
        $db = \Config\Database::connect();
        $db->transStart();
        try {
            if ($this->request->getPost()) {

                $merchant_id = $this->request->getPost('merchant_id');
                $merchantData = $this->db->table("mechants")->where('id', $merchant_id)->get()->getRow();


                if ($merchantData && $merchantData->status == 1) {

                    $email = $merchantData->email;
                    $password = generate_random_password(8);
                    $username = generate_username_from_email($email);


                    $userModel = new UserModel();
                    $userData = [
                        'username' => $username,
                        'email' => $email,
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'active' => 1
                    ];

                    // Insert the user data into the database
                    $userModel->save($userData);



                    if ($userModel->getInsertID()) {

                        $update_merchant_data = array();
                        $update_merchant_data['status']   = 2;
                        $update_merchant_data['signature_token']   = $password;
                        $update_merchant_data['userId']   = $userModel->getInsertID();

                        (new MerchantModel())->update($merchant_id, $update_merchant_data);

                        $user = $userModel->findById($userModel->getInsertID());
                        // Add to default group
                        $userModel->addToDefaultGroup($user);

                        $builder = $db->table('auth_identities');

                        $userData_auth = [
                            'user_id' => $userModel->getInsertID(),
                            'name' => $username,
                            'type' => 'email_password',
                            'secret' => $email,
                            'secret2' => password_hash($password, PASSWORD_DEFAULT)
                        ];
                        $builder->insert($userData_auth);

                        $db->transComplete();
                        // Check if the transaction was successful
                        if ($db->transStatus() === false) {
                            $db->transRollback();
                            return $this->response->setJSON(['error' => true, 'message' => 'Something went wrong.']);
                            exit;
                        } else {
                            $db->transCommit();
                            return $this->response->setJSON(['success' => true, 'message' => 'Password generated successfully. Please click on `Email` button to send new password to merchant.']);
                            exit;
                        }
                    }
                }
                if ($merchantData && $merchantData->status == 2) {

                    $email = $merchantData->email;
                    $password = generate_random_password(8);

                    if (empty($merchantData->userId)) {
                        $user_data = $this->db->table("auth_identities")->where('secret', trim($email))->get()->getRow();
                        //$user_id = $user_data->user_id;
                        $update_merchant_data = array();
                        $update_merchant_data['signature_token']   = $password;
                        $update_merchant_data['userId']   = $user_data->user_id;
                        (new MerchantModel())->update($merchant_id, $update_merchant_data);

                        //Update Merchant Password
                        //$update_merchant_password = array();
                        //$update_merchant_password['password']   = password_hash($password, PASSWORD_DEFAULT);
                        //$update_merchant_password['active']   = 1;
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                        $builder = $db->table('auth_identities');
                        $builder->where('user_id', $user_data->user_id)->set('secret2', $hashedPassword)->update();
                    } else {

                        $update_merchant_data = array();
                        $update_merchant_data['signature_token']   = $password;
                        $update_merchant_data['userId']   = $merchantData->userId;

                        (new MerchantModel())->update($merchant_id, $update_merchant_data);
                        //Update Merchant Password
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                        $user_data = $db->table("auth_identities")->where('user_id', $merchantData->userId)->get()->getRow();

                        if ($user_data) {
                            $builder = $db->table('auth_identities');
                            $builder->where('user_id', $merchantData->userId)->set('secret2', $hashedPassword)->update();
                        } else {
                            $email = $merchantData->email;
                            $password = generate_random_password(8);
                            $username = generate_username_from_email($email);

                            // die('dddd');

                            $builder = $db->table('auth_identities');
                            $userData = [
                                'user_id' => $merchantData->userId,
                                'name' => $username,
                                'type' => 'email_password',
                                'secret' => $email,
                                'secret2' => password_hash($password, PASSWORD_DEFAULT)
                            ];
                            $builder->insert($userData);
                        }
                    }

                    $db->transComplete();
                    // Check if the transaction was successful
                    if ($db->transStatus() === false) {
                        $db->transRollback();
                        return $this->response->setJSON(['error' => true, 'message' => 'Something went wrong.']);
                        exit;
                    } else {
                        $db->transCommit();
                        return $this->response->setJSON(['success' => true, 'message' => 'Password generated successfully. Please click on `Email` button to send new password to merchant.']);
                        exit;
                    }
                }
            }
        } catch (\Exception $e) {
            $db->transRollback();
            // Handle exceptions
            return $this->response->setJSON(['error' => true, 'message' => $e->getMessage()]);
            exit;
        }
    }

    // Delete customer
    public function delete_lead($leadsId = null)
    {

        if (!$leadsId) {
            return redirect('leads-lists');
        }

        // Load your model
        $model = new MerchantModel();

        // Perform the delete action
        $result = $model->delete($leadsId);

        if ($result) {
            // Deletion successful
            return $this->response->setJSON(['success' => true, 'message' => 'Lead deleted successfully.']);
            exit;
        } else {
            // Deletion failed
            return $this->response->setJSON(['error' => true, 'message' => 'Something went wrong.']);
            exit;
        }

        //return redirect('client-lists');
    }

    /* refund customer amount */
    public function refund_amount($xCustom01)
    {

        $postdata = $this->request->getPost();

        $db = \Config\Database::connect();
        $db->transStart();

        try {

            $refnumber = decodeID($postdata['refnumber']);
            $amout_type = $postdata['refund'];
            $amout = $postdata['amount' . $amout_type];
            $fullamount = $postdata['amountfull'];

            // $get_data = $db->table('customer_transaction');
            // $get_details = $get_data->select('*')->where('GatewayRefNum', $refnumber)->get()->getRow();

            if ($refnumber) {

                //if (refundpartial_amount && exists_amount < refundpartial_amount) {
                if ($amout_type == 'partial' &&  $fullamount < $amout) {

                    return $this->response->setJSON(['error' => true, 'message' => array('Please enter an amount less than the total amount.')]);
                    exit;
                }

                if ($refnumber) {

                    $apiurl = 'https://x1.cardknox.com/gatewayjson';
                    $parama = array(
                        'xKey' => getkey(),
                        "xCommand" => "cc:refund",
                        'xVersion' => xVersion,
                        'xSoftwareName' => xSoftwareName,
                        "xSoftwareVersion" => xSoftwareVersion,
                        "xRefNum" => $refnumber,
                        "xAmount" => $amout
                    );

                    $result = callapi($parama, getkey(), $apiurl);

                    if ($result->xStatus == 'Approved') {
                        $remaingAmount = $fullamount - $amout;
                        $updateDataArray = [
                            // 'is_refund' => 1,
                            'remaining_amount' => $remaingAmount,
                        ];
                        $updatedata = $db->table('customer_transaction');
                        $updatedata->where('GatewayRefNum', $refnumber)->set($updateDataArray)->update();

                        //Insert Child data

                        // $table = $db->table('customer_transaction');
                        // $insertData = [
                        //     'GatewayRefNum' => $result->xRefNum,
                        //     'parent_refnumber' => $refnumber,
                        //     'order_invoice_number' => ($result->xInvoice ? $result->xInvoice : ''),
                        //     'customer_id' => ($get_details->customer_id ? $get_details->customer_id : ''),
                        //     'amount'=>($result->xAuthAmount ? $result->xAuthAmount : 0),
                        //     'command'=>"cc:refund",
                        //     'transaction_type'=>'refund',
                        //     'status'=>($result->xStatus ? $result->xStatus : '')
                        // ];
                        // $table->insert($insertData);

                        $db->transComplete();

                        // get customer list
                        $apiEndpoint = $this->developers_url . 'GetCustomer';
                        $postData = ['SoftwareName' => "paymelimo", "SoftwareVersion" => "1.0", "CustomerId" => $xCustom01];
                        $response = $this->_post_api($postData, $apiEndpoint);
                        $customerData = json_decode($response, true);
                        $billFirstName = $customerData['BillFirstName'];
                        $to_email = $customerData['Email'];

                        // email send on refund customer amount
                        $subject = 'Your PayMe.Limo refund for ' . $xCustom01 . ' has been successfully completed';
                        $email = \Config\Services::email();
                        $email->setTo($to_email);
                        $email->setFrom('noreply@payme.limo', 'PayMe.Limo');

                        $email->setSubject($subject);
                        $email->setMailType('html');
                        $email->setMessage(view('email_templates/refund_transaction.php', [
                            'customer_id' => $xCustom01,
                            'name' => $billFirstName
                        ]));
                        $email->send();

                        return $this->response->setJSON(['success' => true, 'message' => 'Transaction refunded successfully.', 'customerid' => $xCustom01]);
                        exit;
                    } else {
                        return $this->response->setJSON(['error' => true, 'message' => $result->xError]);
                        exit;
                    }
                }
            } else {
                return $this->response->setJSON(['error' => true, 'message' => 'Oops! Transaction reference ID mismatch.']);
                exit;
            }

            if ($result->xStatus == 'Approved') {

                $db->transComplete();

                if ($db->transStatus() === false) {
                    $db->transRollback();
                    // Handle the case where a transaction failed
                    return $this->response->setJSON(['error' => true, 'message' => 'Transaction failed.']);
                    exit;
                } else {
                    $db->transCommit();
                    return $this->response->setJSON(['success' => true, 'message' => 'Transaction refunded successfully.', 'customerid' => $xCustom01]);
                    exit;
                }
            }
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Exception: ' . $e->getMessage());
            return $this->response->setJSON(['error' => true, 'error' => 'An error occurred.']);
        }
    }

    /* capture pre auth customer amount */
    public function capture_amount($xCustom01)
    {
        $db = \Config\Database::connect();
        $postdata = $this->request->getPost();

        try {

            $refnumber = decodeID($postdata['refnumber']);
            $amountfull = $postdata['amountfull'];
            //$tip = $postdata['tip'];


            if ($refnumber && $amountfull) {

                $apiurl = 'https://x1.cardknox.com/gatewayjson';

                $parama = array(
                    'xKey' => getkey(),
                    "xCommand" => "cc:capture",
                    'xVersion' => xVersion,
                    'xSoftwareName' => xSoftwareName,
                    "xSoftwareVersion" => xSoftwareVersion,
                    "xRefNum" => $refnumber,
                    "xAmount" => $amountfull,
                    "xCustom01" => $xCustom01,
                    //"xTip" => $tip
                );

                $result = callapi($parama, getkey(), $apiurl);


                if ($result->xStatus == 'Approved') {

                    $updateDataArray = [
                        'command' => 'cc:capture',
                        'transaction_type' => 'capture',
                        'amount' => $amountfull
                    ];

                    $updatedata = $db->table('customer_transaction');
                    $updatedata->where('GatewayRefNum', $refnumber)->set($updateDataArray)->update();

                    // get customer list
                    $apiEndpoint = $this->developers_url . 'GetCustomer';
                    $postData = ['SoftwareName' => "paymelimo", "SoftwareVersion" => "1.0", "CustomerId" => $xCustom01];
                    $response = $this->_post_api($postData, $apiEndpoint);
                    $customerData = json_decode($response, true);
                    $billFirstName = $customerData['BillFirstName'];
                    $to_email = $customerData['Email'];
                    // email send on capture pre auth customer amount
                    $subject = 'Your PayMe.Limo pre-authorized transaction for ' . $xCustom01 . ' has been successfully Captured';
                    $email = \Config\Services::email();
                    $email->setTo($to_email);
                    $email->setFrom('noreply@payme.limo', 'PayMe.Limo');

                    $email->setSubject($subject);
                    $email->setMailType('html');
                    $email->setMessage(view('email_templates/captured_transaction.php', [
                        'customer_id' => $xCustom01,
                        'name' => $billFirstName
                    ]));
                    $email->send();

                    return $this->response->setJSON(['success' => true, 'message' => 'Transaction successfully.', 'customerid' => $xCustom01]);
                    exit;
                } else {
                    return $this->response->setJSON(['error' => true, 'message' => $result->xError]);
                    exit;
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Exception: ' . $e->getMessage());
            return $this->response->setJSON(['error' => true, 'error' => 'An error occurred.']);
        }
    }

    /**
     * Returns the Entity class that should be used
     */
    protected function getUserEntity(): User
    {
        return new User();
    }


    /**
     * Returns the User provider
     */
    protected function getUserProvider(): UserModel
    {
        $provider = model(setting('Auth.userProvider'));

        assert($provider instanceof UserModel, 'Config Auth.userProvider is not a valid UserProvider.');

        return $provider;
    }

    protected function getValidationRules(): array
    {
        $rules = new ValidationRules();

        return $rules->getRegistrationRules();
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
}
