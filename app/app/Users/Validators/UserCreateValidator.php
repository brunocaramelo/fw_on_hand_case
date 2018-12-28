<?php

namespace App\Users\Validators;

class UserCreateValidator
{
    private $errors = [];
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    public function validate()
    {
        $this->run();
    }
    
    private function run()
    {
        $this->validateName();
        $this->validateEmail();
        $this->validatePassword();
    }

    private function validateName()
    {
        if (empty(trim($this->data['name']))) {
            $this->errors[] = 'Preencha o nome';
        }
    }

    private function validateEmail()
    {
        if (!filter_var(trim($this->data['email']), FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Preencha corretamente o email';
        }
    }
    
    private function validatePassword()
    {
        if (!(!empty($this->data['password']) && !empty($this->data['password_check']))) {
            $this->errors[] = 'Preencha a senha e sua confirmacao';
        } elseif ($this->data['password'] != $this->data['password_check']) {
            $this->errors[] = 'Os campos de senha não conferem';
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function isValid()
    {
        return empty($this->errors);
    }
}
