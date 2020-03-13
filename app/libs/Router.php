<?php

namespace libs;

class Router
{
    public static function getRoute()
    {
        $routes = [
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
            ]
        ];

        return $routes;
    }
}
