<?php

namespace controllers;

class RegisterController extends \libs\Controller
{

    public function showForm()
    {
        $this->viewObj('register\register');
        $session = new \libs\Session();
        $this->view->pageTitle = 'Register';
        $this->view->token = $session->setToken();
        $this->view->s = $session->sessionExists('token');
        $this->view->render();
    }

    public function register()
    {
        $session = new \libs\Session();
        $userModel = $this->modelObj('\models\User');
        $this->viewObj('register\register');

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $validation = new \libs\Validation;
        $validation->checkInput();

        if ($validation->isPermitted()) {
            if ($session->isTokenValid()) {
                $userModel->addUser([
                    $userModel::USERNAME => $username,
                    $userModel::PASSWORD => $password
                ]);
            }
        } else {
            $this->view->data['errors'] = $validation->getErrors();
        }

        $this->view->pageTitle = 'Register';
        $this->view->token = $session->setToken();
        $this->view->render();
    }
}
