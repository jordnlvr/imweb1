<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Exceptions\ValidationException;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Models\UserIdentityModel;
use CodeIgniter\Shield\Traits\Viewable;
use Psr\Log\LoggerInterface;

/**
 * Class UserController
 *
 * Handles displaying registration form,
 * and handling actual registration flow.
 */
class UserController extends BaseController
{
    use Viewable;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void {
        parent::initController(
            $request,
            $response,
            $logger
        );
    }

    /**
     * Displays the registration form.
     *
     * @return RedirectResponse|string
     */
    public function index($CustomerId = null)
    {
        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = ($url->getSegment(3) ? $url->getSegment(3) : '');
        $userModel = new UserModel();
        $data['users'] = $userModel->find($CustomerId);

        $db = \Config\Database::connect();
        $data['users'] =  $db->table('users')->select('users.username, ai.id as auth_identities,ai.name,ai.secret')
            ->join('auth_identities ai', 'ai.user_id = users.id')
            ->where('users.id', $CustomerId)
            ->get()->getRow();


        if ($this->request->is('post')) {
            $email = $this->request->getPost('email');
            $name  = $this->request->getPost('name');
            $id  = $this->request->getPost('id');
            $userData = [
                'name'      => ($name ? $name : ''),
                'status'    => 0
            ];

            $usersModel = new UserIdentityModel();
            $usersModel->where('id', $id)->set($userData)->update();
            if (isset($usersModel) && !empty($usersModel)) {
                $session = \Config\Services::session();
                $session->set('login_user', $name);
                return $this->response->setJSON(['success' => true, 'message' => 'Profile updated successfully']);
                exit;
            } else {
                return $this->response->setJSON(['error' => true, 'message' => 'Profile not updated']);
                exit;
            }
        }
        return view('update_profile', $data);
    }
}
