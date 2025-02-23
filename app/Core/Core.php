<?php
session_start();
class Core
{
    public function start($urlGet)
    {

        $controller = $this->getController($urlGet);
        $action = $this->getAction($urlGet);
        $id = $this->getId($urlGet);
        
        if (!method_exists($controller, $action)) {
            $controller = new NotFoundController();
            $action = 'index';
        }

        call_user_func([$controller, $action], ['param' => $id]);
    }

    private function getController($urlGet)
    {
        if (isset($urlGet['controller'])) {
            $controllerName = ucfirst($urlGet['controller']) . 'Controller';
            if (class_exists($controllerName)) {
                return new $controllerName();
            }
        }
        return new HomeController();
    }

    private function getAction($urlGet)
    {
        return isset($urlGet['action']) ? ucfirst($urlGet['action']) : 'Index';
    }

    private function getId($urlGet)
    {
        return isset($urlGet['id']) && $urlGet['id'] !== null ? $urlGet['id'] : null;
    }
}