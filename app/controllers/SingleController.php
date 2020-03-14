<?php

namespace controllers;

class SingleController extends \libs\Controller
{
    public function showNews($id = null, $comment_id = null)
    {
        $this->viewObj('single/single');
        $newsModel = $this->modelObj('\models\News');
        $commentsModel = $this->modelObj('\models\Comments');
        $userModel = $this->modelObj('\models\User');

        $authentication = new \libs\Authentication($userModel);
        if ($comment_id) {
            if ($authentication->isLoggedIn()) {
                if (
                    \libs\Session::getSession('username') == $commentsModel->getCommentById($comment_id)->username
                    || $authentication->isAdmin(\libs\Session::getSession('admin'))
                ) {
                    $commentsModel->deleteComment($comment_id);
                }
            } else {
                http_response_code(404);
                include(VIEWS . 'error/error.php');
                die();
            }
        }

        $this->setViewData($id, $newsModel, $commentsModel);
    }

    public function comment($id = null)
    {
        $this->viewObj('single/single');
        $newsModel = $this->modelObj('\models\News');
        $userModel = $this->modelObj('\models\User');
        $commentsModel = $this->modelObj('\models\Comments');
        $validation = new \libs\Validation;
        $authentication = new \libs\Authentication($userModel);

        $input = $validation->escapeInput($_POST);

        $text = $input['text'];

        $validation->checkInput();

        if ($validation->isInputValid()) {
            if ($validation->isTokenValid()) {
                if ($authentication->isLoggedIn()) {
                    $commentsModel->addComment([
                        $commentsModel::TEXT => $text,
                        $commentsModel::NEWS_ID => $id,
                        $commentsModel::USERNAME => $authentication->getLoggedInUser()->username
                    ]);
                } else {
                    $this->view->data['errors'] = $authentication->getErrors();
                }
            }
        } else {
            $this->view->data['errors'] = $validation->getErrors();
        }

        $this->setViewData($id, $newsModel, $commentsModel);
    }

    private function setViewData($id, $newsModel, $commentsModel)
    {
        $this->view->data['news'] = $newsModel->getById($id)->getResults();
        $this->view->data['comments'] = $commentsModel->getCommentsByNewsId($id)->getResults();
        $this->view->token = \libs\Session::setToken();
        $this->view->pageTitle = 'SingleNews';
        $this->view->render();
    }
}
