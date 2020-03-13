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
                    'action' => 'showForm'
                ],
                'POST' => [
                    'controller' => 'RegisterController',
                    'action' => 'register'
                ]
            ]
        ];

        return $routes;
    }
}
