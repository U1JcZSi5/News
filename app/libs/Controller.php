<?php

namespace libs;

class Controller
{
    protected $model;
    protected $view;

    public function createModelObj($modelName, $data = [])
    {
        if (file_exists(VIEWS . $modelName . '.php')) {
            echo 'hi';
            // require VIEWS . $modelName . '.php';
            // $this->model = new $modelName;
        } else {
            echo 'not hi';
        }
    }

    public function createViewObj($viewName, $data = [])
    {
        $this->view = new View($viewName, $data = []);
        return $this->view;
    }
}
