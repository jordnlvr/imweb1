<?php

namespace App\Controllers;

ini_set('memory_limit', '256M');

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\ApplicationModel;
use App\Models\MerchantModel;

class Verify extends BaseController
{

    private $db;
    public function __construct()
    {

        $this->db = db_connect();
        $this->merchantModel = model('MerchantModel');
    }

    public function index()
    {
        return view('welcome_message');
    }

    public function unprotected()
    {
        return view('unprotected');
    }

    public function mpa($param = null)
    {

        $url = new \codeigniter\http\URI(current_url());
        $merchant_id = ($url->getSegment(4) ? $url->getSegment(4) : '');
        $substring = substr($merchant_id, 32);
        $merchant_id_decode = base64_decode($substring);
        $merchantModel = $this->db->table("mechants")->where('id', $merchant_id_decode)->get()->getRow();

        if ($merchantModel && $merchantModel->status == 0) {
            $data['dba_data'] = ($merchantModel ? $merchantModel : '');
            return view('merchant_verify', $data);
        } else if ($merchantModel && $merchantModel->status == 2) {
            return view('email_templates/already_boarded');
        } else {
            return view('email_templates/no_data_found');
        }
    }

    public function checkEmailOnboarded()
    {

        $email = trim((string)$this->request->getPost('email'));
        
        $merchantModel = $this->db->table("mechants")->where('email', $email)->where('appId!=',0)->get()->getRow();
        if ($merchantModel) {
            echo 'false';
        } else {
            echo 'true';
        }
        
        //return $this->response->setJSON(['exists' => ($merchantModel > 0)]);
    }
    //please check it

}
