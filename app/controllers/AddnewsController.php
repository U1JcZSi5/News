<?php

namespace controllers;

class AddnewsController extends \libs\Controller
{
    public function showPage()
    {
        $this->viewObj('addnews\addnews');
        $newsModel = $this->modelObj('\models\News');
        $userModel = $this->modelObj('\models\User');
        $authentication = new \libs\Authentication($userModel);

        if ($authentication->isAdmin($authentication->getLoggedInUser()->username)) {
            $this->setViewData($userModel, $newsModel);
        } else {
            http_response_code(404);
            include(VIEWS . 'error/error.php');
            die();
        }
    }

    public function addNews()
    {
        $userModel = $this->modelObj('\models\User');
        $newsModel = $this->modelObj('\models\News');
        $this->viewObj('addnews\addnews');
        $authentication = new \libs\Authentication($userModel);
        $validation = new \libs\Validation;

        $input = $validation->escapeInput($_POST);

        $title = $input['title'];
        $text = $input['text'];
        $author = $input['author'];
        $category = $input['category'];

        $validation->checkInput();
        if ($authentication->isAdmin($authentication->getLoggedInUser()->username)) {
            if ($validation->isInputValid()) {
                if ($validation->isTokenValid()) {
                    $newsModel->addNews([
                        $newsModel::TITLE => $title,
                        $newsModel::TEXT => $text,
                        $newsModel::AUTHOR => $author,
                        $newsModel::CATEGORY => $category,
                    ]);
                    header('location: ' . BASE_URL);
                }
            } else {
                $this->view->data['errors'] = $validation->getErrors();
            }
        } else {
            http_response_code(404);
            include(VIEWS . 'error/error.php');
            die();
        }

        $this->setViewData($userModel, $newsModel);
    }

    private function setViewData($userModel, $newsModel)
    {
        $this->view->token = \libs\Session::setToken();
        $this->view->data['topics'] = $newsModel->getTopics();
        $this->view->pageTitle = 'Post News';
        $this->view->data['text'] = \libs\Validation::getInputValue('text');
        $this->view->data['title'] = \libs\Validation::getInputValue('title');
        $this->view->data['author'] = \libs\Validation::getInputValue('author');
        $this->view->data['category'] = \libs\Validation::getInputValue('category');
        $this->view->render();
    }
}
