<?php

namespace controllers;

class RegisterController extends \libs\Controller
{
    public function showRegisterForm()
    {
        $this->viewObj('register\register');
        $this->view->pageTitle = 'Register';
        $this->view->token = \libs\Session::setToken();
        $this->view->data['username'] = \libs\Validation::getInputValue('username');
        $this->view->render();
    }

    public function register()
    {
        $userModel = $this->modelObj('\models\User');
        $this->viewObj('register\register');

        $input = \libs\Validation::escapeInput($_POST);

        $username = $input['username'];
        $password = $input['password'];

        $validation = new \libs\Validation;
        $validation->checkInput();

        if ($validation->isInputValid()) {
            if ($validation->isTokenValid()) {
                $userModel->addUser([
                    $userModel::USERNAME => $username,
                    $userModel::PASSWORD => $password
                ]);
            }
        } else {
            $this->view->data['errors'] = $validation->getErrors();
        }

        $this->view->data['username'] = \libs\Validation::getInputValue('username');
        $this->view->pageTitle = 'Register';
        $this->view->token = \libs\Session::setToken();
        $this->view->render();
    }
}
