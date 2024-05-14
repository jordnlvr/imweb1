<?php

namespace App\Controllers\Merchant;

use App\Controllers\BaseController;
use Exception;
use CodeIgniter\Shield\Authentication\Authenticators\Session;

class Sendpaymentrequest extends BaseController
{

    function __construct()
    {
        // /** @var Session $authenticator */
        // $authenticator = auth('session')->getAuthenticator();
        
        // echo '<pre>';
        // print_r(auth()->user());
        // exit;
    }

    public function index(){
        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');
        return view('merchant/send_payment_request/lists', $data);
    }

}