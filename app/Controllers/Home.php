<?php

namespace App\Controllers;


class Home extends BaseController
{
    
    protected $helpers = ['custom'];

    public function index()
    {
        $url = new \codeigniter\http\URI(current_url());
        $data['pagename'] = '';

        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'user'){
            return redirect('leads');
        }else{
            return redirect('client-lists');
        }
        
    }
}
