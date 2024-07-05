<?php 

namespace Src\Controller\App;
use Config\TemplateConfig;
use Src\GET\SolicitacaoAcesso\Barbeiro;
use Src\GET\Usuario;

class AdminController extends TemplateConfig {

    private function verificarNivel()
    {
      $get = new Usuario();
      if($get->nivel() != 1){
        redirect(routerConfig()."/app/acesso/negado");
      }
    }

    public function index()
    {
      session_start();
      $this->verificarNivel();
    }

    public function barbeiros()
    {
      session_start();
      $this->verificarNivel();
    }

    public function barbearias()
    {
      session_start();
      $this->verificarNivel();

    }

    public function solicitacoesBarbeiro()
    {
        session_start();
        $this->verificarNivel();
        $acesso = new Barbeiro();
        $this->view("app/admin/solicitacoes/acessoBarbeiro",  ["title" => "Solicitações Acesso", 
        "conta" => $acesso->conta(), "data" => $acesso->getAll(), "pagination" => $acesso->pagination()]);
       
    }

}