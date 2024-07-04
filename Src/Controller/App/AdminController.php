<?php 

namespace Src\Controller\App;
use Config\TemplateConfig;
use Src\GET\SolicitacaoAcesso\Barbeiro;
use Src\GET\Usuario;

class AdminController extends TemplateConfig {

    public function index()
    {

    }

    public function barbeiros()
    {

    }

    public function barbearias()
    {

    }

    public function solicitacoesBarbeiro()
    {
       session_start();
       $get = new Usuario();
       $acesso = new Barbeiro();

       if($get->nivel() == 1){
        $this->view("app/admin/solicitacoes/acessoBarbeiro",  ["title" => "Solicitações Acesso", 
        "conta" => $acesso->conta(), "data" => $acesso->getAll(), "pagination" => $acesso->pagination()]);
       }else{
         redirect(routerConfig()."/app/acesso/negado");
       } 
       
    }

}