<?php

namespace controllers;

class RegisterController extends \libs\Controller
{
    public function showForm($id = '', $name = '')
    {
        $this->createViewObj('register\register', [
            'name' => $name,
            'id' => $id
        ]);
        $this->view->pageTitle = 'Register';
        $this->view->render();
    }

    public function register()
    {
        dd($_POST['register']);
    }
}
