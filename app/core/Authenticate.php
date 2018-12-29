<?php

namespace Core;

use App\Users\Repositories\UserRepository;
use App\Users\Repositories\PermissionRoleRepository;

trait Authenticate
{
    public function login()
    {
        $messages = ['errors'=>$this->errors,
                    ];
        return  $this->get('template')
            ->setup($messages, 'user/login', 'Login')
            ->setUseLayout(true)
            ->render();
    }

    public function auth($request)
    {
        $redirector = $this->get('redirect');
        $session = $this->get('session');
        
        $getPost = $request->getPost()->post;
        $userRep = new UserRepository($this->get('connection'));
        
        $result = $userRep->findByEmail($getPost->email);
      
        if ($result && password_verify($getPost->password, $result->password)) {
            $user = [
                'id' => $result->id,
                'name' => $result->name,
                'email' => $result->email
            ];
            $session->set('user', $user);
            $session->set('credentials', $this->getCredentialsByRoleId($result->role_id));
            return $redirector->route('/');
        }

        return $redirector->route('/login', [
            'errors' => ['Usuário ou senha estão incorretos'],
            'inputs' => ['email' => $request->post->email]
        ]);
    }

    public function logout()
    {
        $redirector = $this->get('redirect');
        $session = $this->get('session');
        
        $session->destroy('user');
        return $redirector->route('/login');
    }

    private function getCredentialsByRoleId($roleId)
    {
        $listPerms = [];
        $userRep = new PermissionRoleRepository($this->get('connection'));
        $result = $userRep->getCredentialsByRoleId($roleId);
          
        foreach ($result as $credential) {
            $listPerms[] = $credential->slug;
        }
        return $listPerms;
    }
}
