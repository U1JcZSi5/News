<?php

namespace libs;

class Authentication
{
    private $userModel;
    private $errors;

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }

    public function verifyLogin($username, $password)
    {
        $user = $this->userModel->getByUsername($username);

        if (!empty($user)) {
            if ($user[0]->password == $password) {
                return true;
            }
        }
        $this->errors[] = 'Wrong credentials';
        return false;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
