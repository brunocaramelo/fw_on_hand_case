<?php

namespace Core;

class Auth
{
    private $id = null;
    private $name = null;
    private $email = null;
    private $session = null;
    private $apiToken = null;

    public function __construct(Session $session)
    {
        $this->session = $session;
        if ($this->session->get('user')) {
            $user = $this->session->get('user');
            $this->id = $user['id'];
            $this->name = $user['name'];
            $this->email = $user['email'];
            $this->apiToken = $user['api_token'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }
    
    public function getApiToken()
    {
        return $this->apiToken;
    }

    public function check()
    {
        return (!($this->id == null &&
                $this->name == null &&
                $this->email == null));
    }

    public function can($permission)
    {
        return in_array($permission, (array) $this->session->get('credentials'));
    }
}
