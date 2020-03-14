<?php

namespace libs;

class Router
{
    public static function getRoute()
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

        return $routes;
    }
}
