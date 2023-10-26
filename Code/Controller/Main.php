<?php
namespace Controller;

use Controller\App_Exceptions;

class Main
{
    static function Route($routes)
    {
        $dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) use ($routes) {
            foreach ($routes as $uri => $route) {
                $r->addRoute($route['method'], $uri, $route['controller']);
            }
        });

        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                App_Exceptions::RouteErrors('404', '404 Not Found', $_SERVER['REQUEST_URI']);
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                App_Exceptions::RouteErrors('405', '405 Method Allowed', $_SERVER['REQUEST_URI']);
                break;
            case \FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                // Si non Static : 
                $handler[0] = new $handler[0];

                call_user_func(
                    $handler
                    ,
                    $vars
                );
                break;
        }
    }

}
?>