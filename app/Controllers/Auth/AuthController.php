<?php

namespace App\Controllers\Auth;

use CodeIgniter\Controller;
// use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\Events\Events;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Exceptions\ValidationException;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Traits\Viewable;
use CodeIgniter\Shield\Validation\ValidationRules;
use Psr\Log\LoggerInterface;

class AuthController extends Controller
{

    /**
     * Attempts to forgot password the user.
     */
    public function forgotPassword()
    {
        if ($this->request->getPost()) {
            $data['data'] = $this->request->getPost();
            $email = $this->request->getPost('email');
            $db = \Config\Database::connect();
            $builder = $db->table('auth_identities');
            $findemail = $builder->select('*')->where('secret', $email)->get()->getRow();
            if ($findemail) {
                // Generate a 6-digit OTP
                $otp = sprintf('%06d', mt_rand(100000, 999999));

                // Send the OTP via email or SMS
                $this->sendOtpEmail($findemail, $otp);

                // Load the view and return its HTML content
                $data['email'] = $email;
                $viewContent = view('auth/reset_password', $data);

                // Return the HTML content as JSON
                return $this->response->setJSON(['success' => true, 'message' => 'Verification code has been sent', 'html' => $viewContent]);
                exit;
            } else {
                return $this->response->setJSON(['error' => true, 'message' => 'Verification code not sent']);
                exit;
            }
        } else {
            return view('auth/forgot_password');
            // return $this->response->setJSON(['error' => true, 'message' => 'Verification code not sent']);
            // exit;
        }
    }

    /**
     * Send otp to the user email.
     */
    private function sendOtpEmail($findemail, $otp)
    {
        // Example: use PHPMailer, or CodeIgniter's Email class
        $to = $findemail->secret;
        $subject = 'Password recovery';
        $message = 'Your otp :  ' . $otp;

        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('noreply@payme.limo', 'Password recovery');

        $email->setSubject($subject);
        // $email->setMessage($message);
        $email->setMailType('html');
        $email->setMessage(view('email_templates/password_recovery.php', [
            'otp' => $otp
        ]));
        if ($email->send()) {
            $db = \Config\Database::connect();
            $builder = $db->table('auth_identities');
            $userData = ['otp' => $otp, 'expires' => date('Y-m-d H:i:s', strtotime('+10 minutes'))];
            $builder->where('id', $findemail->id)
                ->set($userData)
                ->update();
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }


    /**
     * Attempts to reset password the user.
     */
    public function viewResetPassword($email)
    {
        $data['email'] = $email;

        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->loginRedirect());
        }

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();
        if ($email) {
            $data['success_message'] = 'Verification code has been sent';
            return view('auth/reset_password', $data);
        } else {
            // Display the form again with validation errors
            return view('auth/reset_password', $data);
        }
    }



    public function resetPassword()
    {
        $data['data'] = $this->request->getPost();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email'    => 'required|max_length[254]|valid_email',
            'otp' => 'required',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'matches[password]',
        ]);

        $rules = [
            'otp' => [
                'label' => 'otp',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'OTP is required',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[50]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'min length is 5',
                    'max_length' => 'max length is 50',
                    'alpha_numeric' => 'add alpha and numeric',
                ]
            ],
            'password_confirm' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Retype password',
                    'matches' => 'password dont matches',
                ],
            ]
        ];

        $users = $this->getUserProvider();
        if (!$this->validateData($this->request->getPost(), $rules, [], config('Auth')->DBGroup)) {
            $data['errors'] = $this->validator->getErrors();
            return $this->response->setJSON(['error' => true, 'message' => $data['errors']['password_confirm']]);
            exit;
        }
        if ($this->request->getMethod() === 'post' && $validation->withRequest($this->request)->run()) {
            // User input is valid, proceed to change password
            $email = $this->request->getPost('email');
            $newPassword = $this->request->getPost('password_confirm');
            $otp = $this->request->getPost('otp');
            $db = \Config\Database::connect();
            $builder = $db->table('auth_identities');
            $checkOtp = $builder->select('*')->where('otp', $otp)->get()->getRow();
            if (isset($checkOtp) && !empty($checkOtp)) {
                // Inside changePassword() method
                // Hash the new password
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                // Update the user's password in the database
                // Example using the Query Builder
                $db = \Config\Database::connect();
                $builder = $db->table('auth_identities');
                $builder->where('secret', $email)->where('otp', $otp)
                    ->set('secret2', $hashedPassword)
                    ->update();

                session()->setFlashdata('success', 'Password changed successfully.');

                // Return the HTML content as JSON
                return $this->response->setJSON(['success' => true, 'message' => 'Password changed successfully']);
                exit;
            } else {
                return $this->response->setJSON(['error' => true, 'message' => 'Please enter valid Otp']);
                exit;
            }
        } else {
            // Display the form again with validation errors
            $data['error'] = $users->errors();
            return $this->response->setJSON(['error' => true, 'message' => $data['error']]);
            exit;
        }
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

    /**
     * Returns the Entity class that should be used
     */
    protected function getUserEntity(): User
    {
        return new User();
    }

    /**
     * Returns the rules that should be used for validation.
     *
     * @return array<string, array<string, array<string>|string>>
     * @phpstan-return array<string, array<string, string|list<string>>>
     */
    protected function getValidationRules(): array
    {
        $rules = new ValidationRules();

        return $rules->getRegistrationRules();
    }
}
