<?php

namespace components;

class Router
{
    public static function start()
    {
        $uri = Server::getUri();

        $segments = explode('/', $uri);

        $controllerName = ucfirst(array_shift($segments) . 'Controller');

        $actionName = 'action' . ucfirst(array_shift($segments));

        $className = '\controllers\\' . $controllerName;

        if (class_exists($className)) {
            $controller = new $className();

            if (!method_exists($controller, $actionName) && $actionName == 'action') {
                $actionName = 'action' . ucfirst($controller->defaultAction);
            }

            if (method_exists($controller, $actionName)) {
                call_user_func_array([$controller, $actionName], $segments);
                return true;
            }
        }

        return false;
    }
}
