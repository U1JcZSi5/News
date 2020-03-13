<?php

namespace controllers;

class LoginController extends \libs\Controller
{
    public function showLoginForm()
    {
        $this->viewObj('login\login');
        $this->view->pageTitle = 'Login';
        $this->view->token = \libs\Session::setToken();
        $this->view->data['username'] = \libs\Validation::getInputValue('username');
        $this->view->render();
    }

    public function login()
    {
        $this->viewObj('login\login');
        $userModel = $this->modelObj('\models\User');
        $authentication = new \libs\Authentication($userModel);
        $validation = new \libs\Validation;

        $input = \libs\Validation::escapeInput($_POST);

        $username = $input['username'];
        $password = $input['password'];

        $validation->checkInput();

        if (!$validation->isInputValid() || !$validation->isTokenValid()) {
            $this->view->data['errors'] = $validation->getErrors();
        } elseif (!$authentication->verifyLogin($username, $password)) {
            $this->view->data['errors'] = $authentication->getErrors();
        } else {
            \libs\Session::setSession('username', $username);
            \libs\Session::setSession('password', $password);
        }

        $this->view->data['username'] = \libs\Validation::getInputValue('username');
        $this->view->pageTitle = 'Login';
        $this->view->token = \libs\Session::setToken();
        $this->view->render();
    }
}
