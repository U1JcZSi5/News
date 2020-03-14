<?php

namespace libs;

class Router
{
    public static function getRoute(string $route, string $request_method, string $string)
    {
        $routes = [
            'home' => [
                'GET' => [
                    'controller' => 'HomeController',
                    'action' => 'index'
                ],
            ],
            'register' => [
                'GET' => [
                    'controller' => 'RegisterController',
                    'action' => 'showRegisterForm'
                ],
                'POST' => [
                    'controller' => 'RegisterController',
                    'action' => 'register'
                ]
            ],
            'single' => [
                'GET' => [
                    'controller' => 'SingleController',
                    'action' => 'showNews'
                ],
                'POST' => [
                    'controller' => 'SingleController',
                    'action' => 'comment'
                ]
            ],
            'login' => [
                'GET' => [
                    'controller' => 'LoginController',
                    'action' => 'showLoginForm'
                ],
                'POST' => [
                    'controller' => 'LoginController',
                    'action' => 'login'
                ]
            ],
            'logout' => [
                'GET' => [
                    'controller' => 'LoginController',
                    'action' => 'logout'
                ],
            ]
        ];

        return $routes[$route][$request_method][$string];
    }
}
