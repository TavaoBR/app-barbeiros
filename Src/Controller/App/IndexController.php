<?php 

namespace Src\Controller\App;
use Config\TemplateConfig;
use Src\GET\Usuario;

class IndexController extends TemplateConfig{


    public function index()
    {
      echo "aqui";
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
      $this->view("app/solicitarAcessoBarbeiro", ["title" => "Solicitar Acesso"]);
    }


}