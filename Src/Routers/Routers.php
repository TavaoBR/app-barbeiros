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
        $router->get("/cadastro", "IndexController:cadastro");
        $router->get("/login", "IndexController:login");
        $router->get("/sair", "IndexController:sair");
        $router->get("/test", "IndexController:test");

        $router->group("app")->namespace("Src\Controller\App");
        $router->get("/", "IndexController:index");
        $router->get("/perfil", "IndexController:perfil");
        $router->get("/perfil/publico/{id}", "IndexController:perfilPublico");


        $router->group("oops")->namespace("Src\Controller\Error");
        $router->get("/{errocode}", "ErrorController:notFound");
        
        $router->dispatch();
        
        if($router->error()){
            $router->redirect("/oops/{$router->error()}");
        }
    }

    public function post(){
        $router = $this->server();

        $router->group(null)->namespace("Src\POST");
        $router->post("/login", "Login:result");

        $router->group("oops")->namespace("Src\Controller\Error");
        $router->get("/{errocode}", "ErrorController:notFound");

        $router->group("usuario")->namespace("Src\Post\Usuario");
        $router->post("/cadastrar", "Register:result");
        $router->post("/atualizar/info/{id}", "UpdateInfo:Result");
        
        $router->dispatch();
        
        if($router->error()){
            $router->redirect("/oops/{$router->error()}");
        }

    }
}