<?php

use CodeIgniter\Router\RouteCollection;

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
 
$routes->get('/', 'Home::index');



 
$routes->get('/', 'Home::index');

$routes->get('dashboard', 'Dashboard::index');


$routes->add('/merchant-details/(:any)', '\App\Controllers\Superadmin\Merchant::details/$1');

$routes->get('/merchant-lists', '\App\Controllers\Superadmin\Merchant::index');

//  service('auth')->routes($routes, ['except' => ['login', 'register']]);
$routes->get('login', '\App\Controllers\Auth\LoginController::loginView');
$routes->get('register', '\App\Controllers\Auth\RegisterController::registerView');


$routes->post('submitgoapp', '\App\Controllers\Superadmin\Merchant::submitgoapp');

$routes->post('addmerchant', '\App\Controllers\Superadmin\Merchant::addmerchant');

$routes->get('sendemail', '\App\Controllers\Superadmin\Merchant::sendemail');

$routes->post('send_form_to_merchant', '\App\Controllers\Superadmin\Merchant::send_form_to_merchant');

$routes->post('update_form_to_merchant', '\App\Controllers\Superadmin\Merchant::update_form_to_merchant');

$routes->post('update_merchant_key', '\App\Controllers\Superadmin\Merchant::update_merchant_key');

$routes->get('merchant_boarding/(:any)', '\App\Controllers\Superadmin\Merchant::merchant_boarding/$1');

$routes->get('leads', '\App\Controllers\Superadmin\Merchant::leads');

$routes->get('lead/(:num)', '\App\Controllers\Superadmin\Merchant::getLeadById/$1');

$routes->get('paymentsite', '\App\Controllers\Superadmin\Merchant::paymentsite');

$routes->post('checkEmail', '\App\Controllers\Superadmin\Merchant::checkEmail');

$routes->post('checkcustomerEmail', '\App\Controllers\Superadmin\Merchant::checkcustomerEmail');

$routes->get('checkemail/(:any)', '\App\Controllers\Superadmin\Merchant::checkemail/$1');

$routes->post('register', '\App\Controllers\Auth\RegisterController::registerAction');

$routes->post('send_logindetail', '\App\Controllers\Superadmin\Merchant::send_logindetail');

$routes->post('generate_logindetail', '\App\Controllers\Superadmin\Merchant::generate_logindetail');

$routes->post('refund_amount/(:any)', '\App\Controllers\Superadmin\Merchant::refund_amount/$1');

$routes->post('capture_amount/(:any)', '\App\Controllers\Superadmin\Merchant::capture_amount/$1');

$routes->get('transaction_json/(:any)', '\App\Controllers\Merchant\Customer::transaction_json/$1');


service('auth')->routes($routes,['namespace' => '\App\Controllers\Auth']);
$routes->get('merchant/(:any)', 'Verify::mpa/$1');

$routes->post('checkEmailOnboarded', 'Verify::checkEmailOnboarded');

//$routes->get('verify', 'Verify::index',['filter' => 'noauth']);


/// pankaj

$routes->get('/client-lists', '\App\Controllers\Merchant\Customer::index');
$routes->add('/client-details/(:any)', '\App\Controllers\Merchant\Customer::details/$1');
$routes->post('/add-client', '\App\Controllers\Merchant\Customer::addcustomer');
$routes->match(['get', 'post'], 'edit-client/(:segment)', '\App\Controllers\Merchant\Customer::editcustomer/$1');
$routes->post('/delete-client/(:segment)', '\App\Controllers\Merchant\Customer::deletecustomer/$1');
$routes->get('/client-transaction/(:segment)', '\App\Controllers\Merchant\Customer::transaction/$1');
$routes->post('/add-transaction', '\App\Controllers\Merchant\Customer::addtransaction');
$routes->match(['get', 'post'], '/payment-request/(:segment)', '\App\Controllers\Merchant\Customer::paymentRequest/$1');
$routes->match(['get', 'post'], '/send-payment-request/(:segment)', '\App\Controllers\Merchant\Customer::sendPaymentRequest/$1');
$routes->post('/send_payment_form_to_client', '\App\Controllers\Merchant\Customer::send_payment_form_to_customer');
$routes->get('/thank-you', '\App\Controllers\Merchant\Customer::thank_you');

$routes->get('downloads/(:segment)', '\App\Controllers\Merchant\Customer::downloadFile/$1');

$routes->post('/add-transaction-with-link', '\App\Controllers\Merchant\Customer::addTransactionWithLink');


$routes->get('/transaction-lists', '\App\Controllers\Merchant\Transaction::index');


$routes->post('reset-password', '\App\Controllers\Auth\AuthController::resetPassword');

$routes->get('view-reset-password/(:any)', '\App\Controllers\Auth\AuthController::viewResetPassword/$1');
$routes->match(['get', 'post'], 'forgot-password', '\App\Controllers\Auth\AuthController::forgotPassword');

$routes->match(['get', 'post'], '/update-profile/(:segment)', '\App\Controllers\Auth\UserController::index/$1');

$routes->setAutoRoute(true);
$routes->match(['get', 'post'], '/update-profile/(:segment)', '\App\Controllers\Auth\UserController::index/$1');

$routes->post('/delete-leads/(:segment)', '\App\Controllers\Superadmin\Merchant::delete_lead/$1');

$routes->post('webhook', '\App\Controllers\WebhookController::handleWebhook');
$routes->setAutoRoute(true);
