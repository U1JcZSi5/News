<?php

namespace libs;

class App
{
    private $request_method;
    private $route;
    protected $controller;
    protected $action;
    protected $params = [];

    public function __construct($request_method, $route)
    {
        $this->request_method = $request_method;
        $this->route = $route;
        $this->setController();
        $this->setAction();
        $this->setParams();
    }

    private function setController()
    {
        if (isset($this->route)) {
            $this->controller = '\controllers\\' . Router::getRoute()[$this->route][$this->request_method]['controller'];
        }
    }

    private function setAction()
    {
        if (isset($this->route)) {
            $this->action = Router::getRoute()[$this->route][$this->request_method]['action'];
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
        call_user_func_array([$this->controller, $this->action], $this->params);
    }
}
