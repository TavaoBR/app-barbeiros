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
        $router->get("/acesso/negado", "IndexController:acessoNegado");
        $router->get("/", "IndexController:index");
        
        $router->get("/perfil", "IndexController:perfil");
        $router->get("/perfil/trocar/senha", "IndexController:trocarSenha");
        $router->get("/perfil/historico/solicitacao/acesso/barbeiro", "IndexController:solicitacaoAcessoBarbeiro");
        $router->get("/perfil/publico/{id}", "IndexController:perfilPublico");
        
        $router->get("/solicitar/acesso/barbeiro", "IndexController:solicitarAcessoBarbeiro");
        
        $router->get("/admin", "AdminController:index");
        $router->get("/admin/barbeiros", "AdminController:barbeiros");
        $router->get("/admin/solicitacoes/acesso/barbeiro", "AdminController:solicitacoesBarbeiro");   

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
        $router->post("/solicitacao/acesso/barbeiro/{id}", "SolicitarAcessoBarbeiro:result");
        $router->post("/atualizar/info/{id}", "UpdateInfo:Result");
        $router->post("/atualizar/senha/{id}", "UpdateSenha:Result");

        $router->group("solicitacoes")->namespace("Src\POST\Solicitacoes");
        $router->post("/acesso/barbeiro/andamento/{id}", "UpdateSolicitacaoBarbeiro:Andamento");
        $router->post("/acesso/barbeiro/aprovado/{id}", "UpdateSolicitacaoBarbeiro:Aprovado");
        $router->post("/acesso/barbeiro/reprovado/{id}", "UpdateSolicitacaoBarbeiro:Reprovado");
        $router->post("/acesso/barbeiro/cancelado/{id}", "UpdateSolicitacaoBarbeiro:Cancelado");
        
        $router->dispatch();
        
        if($router->error()){
            $router->redirect("/oops/{$router->error()}");
        }

    }
}