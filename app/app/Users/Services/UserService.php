<?php

namespace App\Users\Services;

use App\Users\Repositories\UserRepository;
use App\Users\Exceptions\UserCreateException;
use App\Users\Validators\UserCreateValidator;
use App\Users\Validators\UserUpdateValidator;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(array $params)
    {
        $validator = new UserCreateValidator($params);
        $validator->validate();

        if ($validator->isValid()==false) {
            throw new UserCreateException(implode('<br />', $validator->getErrors()));
        }

        $params['password'] = password_hash($params['password'], PASSWORD_BCRYPT);
        $params['api_token'] = password_hash($params['password'], PASSWORD_BCRYPT);
        return $this->userRepository->create($params);
    }

    public function update(array $params)
    {
        $validator = new UserUpdateValidator($params);
        $validator->validate();

        if ($validator->isValid()==false) {
            throw new UserCreateException(implode('<br />', $validator->getErrors()));
        }

        $params['password'] = password_hash($params['password'], PASSWORD_BCRYPT);
        $params['api_token'] = password_hash($params['password'], PASSWORD_BCRYPT);
        return $this->userRepository->update($params);
    }

    public function getById($userId)
    {
        return $this->userRepository->findById($userId);
    }
    
    public function listAll()
    {
        return $this->userRepository->listAll();
    }
}
