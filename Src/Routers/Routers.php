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
        $router->get("/barbearia/confirmar/atendimento/{codigo}", "Publico:BarbeariaConfirmar");
        $router->get("/barbearia/cancelar/atendimento/{codigo}", "Publico:BarbeariaCancelar");
        $router->get("/cliente/confirmar/atendimento/{codigo}", "Publico:ClienteConfirmar");
        $router->get("/cliente/cancelar/atendimento/{codigo}", "Publico:ClienteCancelar");
        $router->get("/atendimento/sucesso/{tipo}", "IndexController:sucesso");
        $router->get("/atendimento/erro", "IndexController:erro");
        $router->get("/alerta/codigo/{tipo}", "IndexController:alertaCodigo");
        $router->get("/atendimento/avaliar/{codigo}", "IndexController:avaliar");
        $router->get("/procurar",  "IndexController:procurar");
        $router->get("/resultado/{uf}/{cidade}",  "IndexController:resultado");
        $router->get("/barbearia/perfil/{token}", "IndexController:perfil");
        
        $router->get("/test", "IndexController:test");

        $router->group("app")->namespace("Src\Controller\App");
        $router->get("/acesso/negado", "IndexController:acessoNegado");
        $router->get("/", "IndexController:index");
        $router->get("/procurar", "IndexController:telaProcurar");
        $router->get("/criar/perfil/barbearia", "IndexController:cadastrarPerfilBarbearia");
        $router->get("/pesquisa/resultado/{nome}", "IndexController:resultaPesquisa");
        $router->get("/agendar/barbeiro/{token}", "IndexController:Barbeiroagendarhoje");
        $router->get("/agenda/confirmar/presenca", "IndexController:confirmarPresenca");
        $router->get("/agenda/cancelar/presenca", "IndexController:cancelarPresenca");
        $router->get("/atendimento/avaliar", "IndexController:AvaliarAtendimento");
        $router->get("/perfil", "IndexController:perfil");
        $router->get("/perfil/trocar/senha", "IndexController:trocarSenha");
        $router->get("/perfil/historico/solicitacao/acesso/barbeiro", "IndexController:solicitacaoAcessoBarbeiro");
        $router->get("/perfil/publico/{id}", "IndexController:perfilPublico");
        $router->get("/perfil/historico/agenda/barbeiro", "IndexController:historicoAgendaBarbeiro");
        
        $router->get("/admin", "AdminController:index");
        $router->get("/admin/barbearias", "AdminController:barbearias");
        
        
        $router->get("/barbearia/perfil/{token}", "BarbeiroController:perfil");
        $router->get("/barbearia/perfil/editar/{token}", "BarbeiroController:editarPerfilBarbearia");
        $router->get("/barbearia/perfil/galeria/adicionar/imagens/{token}", "BarbeiroController:addImagens");
        $router->get("/barbearia/atendimento/cadastro/horarios/{token}", "BarbeiroController:cadastrarHorarios");
        $router->get("/barbearia/atendimento/horarios/{token}", "BarbeiroController:horarios"); 
        $router->get("/barbearia/servicos/cadastrar/{token}", "BarbeiroController:cadastrarServicos");
        $router->get("/barbearia/agenda/{token}/{data}", "BarbeiroController:agenda");
        $router->get("/barbearia/configuracao/{token}", "BarbeiroController:configuracao");
        $router->get("/barbearia/perfil/avatar/{token}", "BarbeiroController:addAvatar");
        $router->get("/barbearia/servicos/{token}", "BarbeiroController:servicos");
        $router->get("/barbearia/servicos/editar/{token}/{id}", "BarbeiroController:editarServico");
        $router->get("/barbearia/barbeiro/cadastrar/{token}", "BarbeiroController:cadastroProfissional");
        $router->get("/barbearia/barbeiros/{token}", "BarbeiroController:profissionais");
        $router->get("/barbearia/barbeiros/editar/{token}/{id}", "BarbeiroController:editarProfissional");
    

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
        $router->post("/atualizar/info/{id}", "UpdateInfo:Result");
        $router->post("/atualizar/senha/{id}", "UpdateSenha:Result");
        $router->post("/recuperar/conta/{id}", "RecuperarConta:Recuperar");
        $router->post("/agendar/barbearia/{fk}", "AgendarBarbeiro:Result");
        $router->post("/agenda/confirmar/presenca", "Atendimento:confirmarPresenca");
        $router->post("/agenda/cancelar/presenca", "Atendimento:cancelarPresenca");
        $router->post("/atendimento/avaliar", "Avaliar:Result");
        $router->post("/atendimento/publico/avaliar", "AvaliarPublico:Result");
        $router->post("/criar/perfil/barbearia", "CadastrarPerfilBarbearia:Result");
        $router->post("/agendar", "AgendarPublico:Result");
        $router->post("/barbearia/confirmar/{codigo}", "ClienteAtendimento:BarbeariaConfirmar");
        $router->post("/barbearia/cancelar/{codigo}", "ClienteAtendimento:BarbeariaCancelar");
        $router->post("/cliente/confirmar/{codigo}", "ClienteAtendimento:ClienteConfirmar");
        $router->post("/cliente/cancelar/{codigo}", "ClienteAtendimento:ClienteCancelar");
        
               
        
        $router->group("barbearia")->namespace("Src\POST\Barbeiro");
        //$router->post("/online/{id}", "UpdateOnOff:Online");
        //$router->post("/offline/{id}", "UpdateOnOff:Offline");
        //$router->post("/galeria/imagens", "GaleriaAddImagens:adicionar");
        $router->post("/atendimento/cadastro/horarios/{id}", "CadastroHorarios:Result");
        $router->post("/servicos/cadastro/{id}", "CadastrarServicos:Result");
        $router->post("/agenda/consultar/{fk}", "ConsultarHorarioDisponivel:Result");
        $router->post("/perfil/avatar/{id}","Avatar:Result");
        $router->post("/perfil/editar/{id}","UpdateInfo:Result");
        $router->post("/agenda/confirmar/{codigo}","AtendimentoUpdate:ConfirmarAtendimento");
        $router->post("/agenda/cancelar/{codigo}","AtendimentoUpdate:CancelarAtendimento");
        $router->post("/agenda/concluir/{codigo}","AtendimentoUpdate:ConcluirAtendimento");
        $router->post("/agenda/confirmar/todos","AtendimentoUpdate:confirmarTodos");
        $router->post("/agenda/cancelar/todos","AtendimentoUpdate:cancelarTodos");
        $router->post("/agenda/concluir/todos","AtendimentoUpdate:concluirTodos");
        $router->post("/servico/atualizar/{id}", "UpdateServico:Result");
        $router->post("/servico/deletar/{id}", "DeletarServico:Deletar");
        $router->post("/atendimento/horario/deletar/{id}", "DeletarHorario:deletar");
        $router->post("/atendimento/horario/todos/deletar/{fk}", "DeletarHorario:deletarTodos");
        
        $router->group("barbeiro")->namespace("Src\POST\ProfissionalBarbearia");
        $router->post("/cadastrar/{id}", "Cadastro:Result");
        $router->post("/editar/{id}", "Editar:Result");

        $router->group("oops")->namespace("Src\Controller\Error");
        $router->get("/{errocode}", "ErrorController:notFound");

        $router->dispatch();

        
        
        if($router->error()){
            $router->redirect("/oops/{$router->error()}");
        }

    }
}