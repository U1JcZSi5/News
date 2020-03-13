<?php

namespace libs;

class App
{
    private $request_method;
    protected $controller;
    protected $action;
    protected $params = [];

    public function __construct($request_method)
    {
        $this->request_method = $request_method;
        $this->setController();
        $this->setAction();
        $this->setParams();
    }

    private function setController()
    {
        if (isset($_GET['route'])) {
            $this->controller = '\controllers\\' . Router::getRoute()[$_GET['route']][$this->request_method]['controller'];
        }
    }

    private function setAction()
    {
        if (isset($_GET['route'])) {
            $this->action = Router::getRoute()[$_GET['route']][$this->request_method]['action'];
        }
    }

    private function setParams()
    {
        $params = [];
        if (!empty($_GET)) {
            foreach ($_GET as $k => $v) {
                if ($k != 'route') {
                    $params[$k] = $v;
                }
            }
        }
        $this->params = $params;
    }

    public function startApp()
    {
        $this->controller = new $this->controller;
        // call method from controller
        call_user_func_array([$this->controller, $this->action], $this->params);
    }
}
