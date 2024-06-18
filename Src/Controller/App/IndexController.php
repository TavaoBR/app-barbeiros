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
        "usuario" => $get->usuario(), "email" => $get->mail(), "nome" => $get->nome(), "celular" => $get->celular()]);
        
    }

    public function perfilPublico($data)
    {

    }


}