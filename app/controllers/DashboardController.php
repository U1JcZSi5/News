<?php

namespace controllers;

use libs\Authentication;

class DashboardController extends \libs\Controller
{
    public function showPage($list = '', $id = '')
    {
        $this->viewObj('dashboard\dashboard');
        $userModel = $this->modelObj('\models\User');
        $newsModel = $this->modelObj('\models\News');
        $commentsModel = $this->modelObj('\models\Comments');

        $authentication = new \libs\Authentication($userModel);

        if ($authentication->isLoggedIn()) {
            if ($authentication->isAdmin($authentication->getLoggedInUser()->username)) {
                if ($list == 'users') {
                    if ($id) {
                        $userModel->deleteUser([$userModel::PRIMARY_KEY => $id]);
                    }
                    $this->view->active = false;
                } elseif ($list == 'news') {
                    if ($id) {
                        $newsModel->deleteNews([$newsModel::PRIMARY_KEY => $id]);
                        $commentsModel->deleteCommentsByNewsId($id);
                    }
                    $this->view->active = true;
                }
            } else {
                http_response_code(404);
                include(VIEWS . 'error/error.php');
                die();
            }
        }

        $this->view->data['users'] = $userModel->getUsers()->getResults();
        $this->view->data['news'] = $newsModel->getNews()->getResults();
        $this->view->pageTitle = 'Dashboard';
        $this->view->render();
    }
}
