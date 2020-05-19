<?php

class Routing
{
    public static function buildRoute() {
        $controllerName = "IndexController";
        $modelName = "IndexModel";
        $action = "index";

        $route = explode("/", $_SERVER['REQUEST_URI']);

        if ($route[2] != '') {
            $controllerName = ucfirst($route[2] . "Controller");
            $modelName = ucfirst($route[2] . "Model");
        }

        include CONTROLLER_PATH . $controllerName . ".php";
        include MODEL_PATH . $modelName . ".php";

        if (isset($route[3]) && $route[3] != '') {
            $action = $route[3];
        }

        $controller = new $controllerName();
        $controller->$action();
    }

    public function errorPage() {

    }
}