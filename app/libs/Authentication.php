<?php

namespace libs;

class Authentication
{
    private const ADMIN = 'admin';
    private $userModel;
    private $errors = [];

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }

    public function verifyLogin($username, $password)
    {
        $user = $this->userModel->getByUsername($username);
        if (!empty($user)) {
            if (password_verify($password, $user[0]->password)) {
                return true;
            }
        }
        $this->errors[] = 'Wrong credentials';
        return false;
    }

    public function isLoggedIn()
    {
        if (\libs\Session::sessionExists('username') && !empty(\libs\Session::sessionExists('username'))) {
            return true;
        }
        return false;
    }

    public function getLoggedInUser()
    {
        if ($this->isLoggedIn()) {
            if (!empty($this->userModel->getByUsername(\libs\Session::getSession('username')))) {
                return $this->userModel->getByUsername(\libs\Session::getSession('username'))[0];
            }
        }
        return false;
    }

    public function isAdmin($username)
    {
        $user = $this->userModel->getByUsername($username);
        if ($username == self::ADMIN) {
            if ($user[0]->admin == 1) {
                return true;
            }
        }
        return false;
    }

    public function userAlreadyExists($username)
    {
        $user = $this->userModel->getByUsername($username);
        if (empty($user)) {
            return  false;
        }
        $this->errors[] = 'Username already exists';
        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
