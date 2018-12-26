<?php

namespace Core;

use Core\Session;

class Auth
{
    private $id = null;
    private $name = null;
    private $email = null;
    private $session = null;

    public function __construct(Session $session)
    {
        $this->session = $session;
        if ($this->session->get('user')) {
            $user = $this->session->get('user');
            $this->id = $user['id'];
            $this->name = $user['name'];
            $this->email = $user['email'];
        }
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    public function email()
    {
        return $this->email;
    }

    public function check()
    {
        return (!($this->id == null &&
                $this->name == null &&
                $this->email == null));
    }

    public function can($permission)
    {
        return in_array($permission, $this->session->get('credentials'));
    }
}
