<?php

namespace controllers;

class RegisterController extends \libs\Controller
{
    public function showRegisterForm()
    {
        $this->viewObj('register\register');
        $this->setViewData();
    }

    public function register()
    {
        $userModel = $this->modelObj('\models\User');
        $this->viewObj('register\register');
        $authentication = new \libs\Authentication($userModel);
        $validation = new \libs\Validation;

        $input = $validation->escapeInput($_POST);

        $username = $input['username'];
        $password = password_hash($input['password'], PASSWORD_DEFAULT);
        $email = $input['email'];

        $validation->checkInput();

        if ($validation->isInputValid()) {
            if ($validation->isTokenValid()) {
                if (!$authentication->userAlreadyExists($username)) {
                    $userModel->addUser([
                        $userModel::USERNAME => $username,
                        $userModel::PASSWORD => $password,
                        $userModel::EMAIL => $email
                    ]);

                    header('location: ' . BASE_URL);
                } else {
                    $this->view->data['errors'] = $authentication->getErrors();
                }
            }
        } else {
            $this->view->data['errors'] = $validation->getErrors();
        }

        $this->setViewData();
    }

    private function setViewData()
    {
        $this->view->pageTitle = 'Register';
        $this->view->data['username'] = \libs\Validation::getInputValue('username');
        $this->view->data['email'] = \libs\Validation::getInputValue('email');
        $this->view->token = \libs\Session::setToken();
        $this->view->render();
    }
}
