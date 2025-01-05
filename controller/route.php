<?php
class Router{
    private $routes= [];
    //ajouter plusieurs routes via tableau
    public function setRoutes(array $routes){
        $this->routes= $routes;
    }
    //verifier et executer l action correspendant
    public function dispatch($action){
        if (isset($this->routes[$action])) {
            call_user_func($this->routes[$action]);
        }else {
            echo 'erreur 404';
        }
    }
}