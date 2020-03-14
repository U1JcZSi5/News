<?php

namespace controllers;

class HomeController extends \libs\Controller
{
    public function index()
    {
        $this->viewObj('home/home');
        $this->view->pageTitle = 'Home';
        $this->view->render();
    }
}
