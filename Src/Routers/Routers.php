<?php 

namespace Src\Routers;

use CoffeeCode\Router\Router;

class Routers {

    private function dominio():string{
        return routerConfig();
    }

    private function server(){
        $router = new Router("{$this->dominio()}");
        return $router;
    }

    public function get(){
        $router = $this->server();
        $router->group(null)->namespace("Src\Controller");
        $router->get("/", "IndexController:index");
        $router->get("/test", "IndexController:test");


        $router->group("oops")->namespace("Src\Controller\Error");
        $router->get("/{errocode}", "ErrorController:notFound");
        
        $router->dispatch();
        
        if($router->error()){
            $router->redirect("/oops/{$router->error()}");
        }
    }

    public function post(){
        $router = $this->server();


        $router->group("oops")->namespace("Src\Controller\Error");
        $router->get("/{errocode}", "ErrorController:notFound");
        
        $router->dispatch();
        
        if($router->error()){
            $router->redirect("/oops/{$router->error()}");
        }

    }
}