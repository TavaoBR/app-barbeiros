<?php 

namespace Src\Controller\App;
use Config\TemplateConfig;
use Src\Database\Filters;
use Src\Database\Model\Barbeiro;
use Src\Database\Model\ServicoBarbeiro;
use Src\GET\Usuario;
use Src\GET\Pesquisa;

class IndexController extends TemplateConfig{
    
    private Barbeiro $barbeiro;
    private ServicoBarbeiro $servicos;

    public function __construct()
    {
      $this->barbeiro = new Barbeiro;
      $this->servicos = new ServicoBarbeiro;
    }

    public function index()
    {
      echo "aqui";
    }

    public function acessoNegado()
    {
       session_start();
       $this->view("error/AcessoNegado", ["title" => "Acesso Negado"]);
    }

    public function perfil()
    {
        session_start();
        $get = new Usuario();
        
        $this->view("app/usuario/perfil", 
        ["title" => "Perfil", 
        "id" => $get->id(), "avatar" => $get->avatar(),
        "usuario" => $get->usuario(), "email" => $get->mail(), "nome" => $get->nome(), "celular" => $get->celular(), "senha" => $get->viewSenha()]);
        
    }

    public function trocarSenha()
    {

      session_start();
      $get = new Usuario();
      $this->view("app/usuario/trocarsenha", ["title" => "Trocar Senha", "id" => $get->id()]);

    }

    public function perfilPublico($data)
    {

    }


    public function solicitarAcessoBarbeiro()
    {
      session_start();
      $get = new Usuario();
      $this->view("app/solicitarAcessoBarbeiro", 
      ["title" => "Solicitar Acesso", "email" => $get->mail(), "nome" => $get->nome(), "celular" => $get->celular(),"id" => $get->id()]);
    }

    public function solicitacaoAcessoBarbeiro()
    {
      session_start();
      $get = new Usuario();
      $this->view("app/usuario/solicitacaoAcesso/barbeiro", ["title" => "Solicitacao Acesso", "conta" => $get->historicoSolicitacaoAcesso()[0], "data" => $get->historicoSolicitacaoAcesso()[1]]);
    }

    public function Barbeiroagendarhoje($data)
    {
       session_start();
       $get = new Usuario();
       $token = $data['token'];
       $barbeiro = $this->barbeiro->findBy("token", $token);
       $id = $barbeiro[1]->id; 
       $servico = $this->servicos->fetchAll();
       $nome = $get->nome();
       $celular = $get->celular(); 

       $this->view("app/usuario/barbeiro/agendar", ["title" => "Agendar", "id" => $id, "servicos" => $servico[1], "celular" => $celular, "nome" => $nome]);
         
    }

    public function historicoAgendaBarbeiro()
    {
        session_start();
        $get = new Usuario();
        $agenda = HistoricoAgendaUsuarioBarbeiro($get->id());
        $this->view("app/usuario/barbeiro/historico", ["title" => "Historico Agendamento Barbeiro"]);
    }

    public function resultaPesquisa($data)
    {
      session_start();
      $nome = $data['nome'];
      $pequisa = new Pesquisa($nome);
      dd($pequisa->Result());
    }



}