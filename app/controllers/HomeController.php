<?php

namespace controllers;

class HomeController extends \libs\Controller
{
    public function index($topic = '')
    {
        $this->viewObj('home/home');
        $newsModel = $this->modelObj('\models\News');

        $this->view->data['topics'] = $newsModel->getTopics();
        $this->view->pageTitle = 'Home';

        if ($topic) {
            $this->view->active = true;
            $this->view->data['news'] = $newsModel->getByTopic($topic)->getResults();
        } else {
            $this->view->data['news'] = $newsModel->getLastFour()->getResults();
        }

        $this->view->render();
    }
}
