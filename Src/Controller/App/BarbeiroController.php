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
        $this->view("app/barbeiro/perfil", 
        ["title" => "Perfil", "id" => $barbeiro->id(),"fk" => $barbeiro->fk(), "token" => $barbeiro->token(), "celular" => $usuario->celular(), "email" => $usuario->mail(), "avatar" => $usuario->avatar(), "nome" => $usuario->nome(),
        "endereco" => $barbeiro->endereco(), "bairro" => $barbeiro->bairro(), "numero" => $barbeiro->numero(), "cidade" => $barbeiro->cidade(), "estado" => $barbeiro->estado(), "online" => $barbeiro->online()
      ]);
    }

    public function addImagens($data)
    {
      session_start();
      $this->verificarNivel();
      $barbeiro = new Barbeiro($data['token']);
      $this->view("app/barbeiro/addImagens", ["title" => "Adicionar Imagens a galeria", "fk" => $barbeiro->fk()]);
    }

    public function agenda($data)
    {

    }

    public function cadastrarAgenda($data)
    {
       
    }


}