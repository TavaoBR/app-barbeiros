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
        $router->get("/recuperar/conta/{token}", "IndexController:recuperar");
        

        $router->get("/test", "IndexController:test");

        $router->group("app")->namespace("Src\Controller\App");
        $router->get("/acesso/negado", "IndexController:acessoNegado");
        $router->get("/", "IndexController:index");
        $router->get("/pesquisa/resultado/{nome}", "IndexController:resultaPesquisa");
        $router->get("/agendar/barbeiro/{token}", "IndexController:Barbeiroagendarhoje");
        $router->get("/agenda/confirmar/presenca", "IndexController:confirmarPresenca");
        $router->get("/agenda/cancelar/presenca", "IndexController:cancelarPresenca");
        $router->get("/perfil", "IndexController:perfil");
        $router->get("/perfil/trocar/senha", "IndexController:trocarSenha");
        $router->get("/perfil/historico/solicitacao/acesso/barbeiro", "IndexController:solicitacaoAcessoBarbeiro");
        $router->get("/perfil/publico/{id}", "IndexController:perfilPublico");
        $router->get("/perfil/historico/agenda/barbeiro", "IndexController:historicoAgendaBarbeiro");
        
        $router->get("/solicitar/acesso/barbeiro", "IndexController:solicitarAcessoBarbeiro");
        
        $router->get("/admin", "AdminController:index");
        $router->get("/admin/barbeiros", "AdminController:barbeiros");
        $router->get("/admin/solicitacoes/acesso/barbeiro", "AdminController:solicitacoesBarbeiro");   

        $router->get("/barbeiro/perfil/{token}", "BarbeiroController:perfil");
        $router->get("/barbeiro/perfil/galeria/adicionar/imagens/{token}", "BarbeiroController:addImagens");
        $router->get("/barbeiro/atendimento/cadastro/horarios/{token}", "BarbeiroController:cadastrarHorarios"); 
        $router->get("/barbeiro/servicos/cadastrar/{token}", "BarbeiroController:cadastrarServicos");
        $router->get("/barbeiro/agenda/{token}/{data}", "BarbeiroController:agenda");
        $router->get("/barbeiro/configuracao/{token}", "BarbeiroController:configuracao");
        $router->get("/barbeiro/perfil/editar/{token}", "BarbeiroController:configuracao");
        $router->get("/barbeiro/perfil/avatar/{token}", "BarbeiroController:addAvatar");
    

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
        $router->post("/cadastrar", "Register:Result");
        $router->post("/solicitacao/acesso/barbeiro/{id}", "SolicitarAcessoBarbeiro:Result");
        $router->post("/atualizar/info/{id}", "UpdateInfo:Result");
        $router->post("/atualizar/senha/{id}", "UpdateSenha:Result");
        $router->post("/recuperar/conta/{id}", "RecuperarConta:Recuperar");
        $router->post("/agendar/barbeiro/{fk}", "AgendarBarbeiro:Result");
        $router->post("/agenda/confirmar/presenca", "Atendimento:confirmarPresenca");
        $router->post("/agenda/cancelar/presenca", "Atendimento:cancelarPresenca");


        $router->group("solicitacoes")->namespace("Src\POST\Solicitacoes");
        $router->post("/acesso/barbeiro/andamento/{id}", "UpdateSolicitacaoBarbeiro:Andamento");
        $router->post("/acesso/barbeiro/aprovado/{id}", "UpdateSolicitacaoBarbeiro:Aprovado");
        $router->post("/acesso/barbeiro/reprovado/{id}", "UpdateSolicitacaoBarbeiro:Reprovado");
       
        
        $router->group("barbeiro")->namespace("Src\POST\Barbeiro");
        $router->post("/online/{id}", "UpdateOnOff:Online");
        $router->post("/offline/{id}", "UpdateOnOff:Offline");
        $router->post("/galeria/imagens", "GaleriaAddImagens:adicionar");
        $router->post("/atendimento/cadastro/horarios/{id}", "CadastroHorarios:Result");
        $router->post("/servicos/cadastro/{id}", "CadastrarServicos:Result");
        $router->post("/agenda/consultar/{fk}", "ConsultarHorarioDisponivel:Result");
        $router->post("/perfil/avatar/{id}","Avatar:Result");
        $router->post("/agenda/confirmar/{codigo}","AtendimentoUpdate:ConfirmarAtendimento");
        $router->post("/agenda/cancelar/{codigo}","AtendimentoUpdate:CancelarAtendimento");


        $router->group("oops")->namespace("Src\Controller\Error");
        $router->get("/{errocode}", "ErrorController:notFound");

        $router->dispatch();

        
        
        if($router->error()){
            $router->redirect("/oops/{$router->error()}");
        }

    }
}