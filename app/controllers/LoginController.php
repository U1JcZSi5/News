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

        $input = $validation->escapeInput($_POST);

        $username = $input['username'];
        $password = $input['password'];

        $validation->checkInput();

        if (!$validation->isInputValid()) {
            $this->view->data['errors'] = $validation->getErrors();
        } elseif (!$validation->isTokenValid()) {
            die('No access!');
        } elseif (!$authentication->verifyLogin($username, $password)) {
            $this->view->data['errors'] = $authentication->getErrors();
        } else {
            if ($authentication->isAdmin($username)) {
                \libs\Session::setSession('admin', 'admin');
                header('location: ' . BASE_URL);
            }
            \libs\Session::setSession('username', $username);
            \libs\Session::setSession('password', $password);
            header('location: ' . BASE_URL);
        }

        $this->view->data['username'] = \libs\Validation::getInputValue('username');
        $this->view->pageTitle = 'Login';
        $this->view->token = \libs\Session::setToken();
        $this->view->render();
    }

    public function logout()
    {
        session_destroy();
        header('location: ' . BASE_URL);
    }
}
