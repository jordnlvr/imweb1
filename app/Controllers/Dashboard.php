<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
 
class Dashboard extends BaseController
{
    public function index()
    {
        return view('dashboard');
    }   
    
    function captured_transaction(){

        return view('email_templates/captured_transaction.php', [
            'customer_id' => 'c111657798',
            'name' => 'test'
        ]);
    }
    
    function customer_payment_request_form(){

        return view('email_templates/customer_payment_request_form.php', [
            'customer_id' => 'c111657798',
            'firstname' => 'Test',
            'lastname' => 'Demo',
            'url' => 'https://www.google.co.in/'
        ]);
    }
    
    function customer_transaction_successfully(){

        return view('email_templates/customer_transaction_successfully.php', [
            'customer_id' => 'c111657798',
            'name' => 'Test',
            'GatewayRefNum' => 'x344dddd',
            'amount' => 100,
        ]);
    }
    
    function merchant_application_form(){

        return view('email_templates/merchant_application_form.php', [
            'dba_name' => 'Test',
            'applicationlink' => 'https://www.google.co.in/'
        ]);
    }
    
    function merchant_onboarding(){

        return view('email_templates/merchant_onboarding.php', [
            'merchantName' => 'Test',
            'applicatapplicationDetailsionlink' => 'https://www.google.co.in/',
            'adminName' =>  'ffff',
        ]);
    }
    
    function merchant_verification_email(){

        return view('email_templates/merchant_verification_email.php', [
            'merchantName' => 'Test',
            'email' => 'pankajmalviya@yopmail.com',
            'password' => 'admin@123'
        ]);
    }
    
    function pre_auth_transaction(){

        return view('email_templates/pre_auth_transaction.php', [
            'name' => 'Test',
            'customer_id' => 'c111657798'
        ]);
    }
    
    function refund_transaction(){

        return view('email_templates/refund_transaction.php', [
            'name' => 'Test',
            'customer_id' => 'c111657798'
        ]);
    }
    
    function old_refund_transaction(){

        return view('email_templates/old_refund_transaction.php', [
            'name' => 'Test',
            'customer_id' => 'c111657798'
        ]);
    }
    
    function old_pre_auth_transaction(){

        return view('email_templates/old_pre_auth_transaction.php', [
            'name' => 'Test',
            'customer_id' => 'c111657798'
        ]);
    }
    
    function old_merchant_verification_email(){

        return view('email_templates/old_merchant_verification_email.php', [
            'merchantName' => 'Test',
            'email' => 'pankajmalviya@yopmail.com',
            'password' => 'admin@123'
        ]);
    }
    
    function old_merchant_onboarding(){

        return view('email_templates/old_merchant_onboarding.php', [
            'merchantName' => 'Test',
            'applicatapplicationDetailsionlink' => 'https://www.google.co.in/',
            'adminName' =>  'ffff',
        ]);
    }
    
    function old_merchant_application_form(){

        return view('email_templates/old_merchant_application_form.php', [
            'dba_name' => 'Test',
            'applicationlink' => 'https://www.google.co.in/'
        ]);
    }
    
    function old_customer_transaction_successfully(){

        return view('email_templates/old_customer_transaction_successfully.php', [
            'customer_id' => 'c111657798',
            'name' => 'Test',
            'GatewayRefNum' => 'x344dddd',
            'amount' => 100,
        ]);
    }
    
    function old_customer_payment_request_form(){

        return view('email_templates/old_customer_payment_request_form.php', [
            'customer_id' => 'c111657798',
            'firstname' => 'Test',
            'lastname' => 'Demo',
            'url' => 'https://www.google.co.in/'
        ]);
    }  
    
    function old_captured_transaction(){

        return view('email_templates/old_captured_transaction.php', [
            'customer_id' => 'c111657798',
            'name' => 'test'
        ]);
    }
}