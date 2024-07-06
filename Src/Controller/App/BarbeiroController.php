<?php 

namespace Src\Controller\App;
use Config\TemplateConfig;
use Src\GET\Barbeiro\Barbeiro;
use Src\GET\Usuario\Usuario;

class BarbeiroController  extends TemplateConfig{

    private function verificarNivel()
    {
      $get = new Usuario();
      if($get->nivel() != 3){
        redirect(routerConfig()."/app/acesso/negado");
      }
    }

    public function perfil($data)
    {
        session_start();
        $this->verificarNivel();
        $barbeiro = new Barbeiro($data['token']);
        $usuario =  new Usuario($barbeiro->fk());
        $this->view("app/barbeiro/perfil", ["title" => "Perfil", "fk" => $barbeiro->fk(), "avatar" => $usuario->avatar(), "nome" => $usuario->nome()]);
    }

    public function agenda($data)
    {

    }

    public function cadastrarAgenda($data)
    {
       
    }


}