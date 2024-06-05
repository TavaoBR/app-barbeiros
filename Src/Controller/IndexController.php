<?php 

namespace Src\Controller;
use Config\TemplateConfig;
use Src\Database\Filters;
use Src\Database\Model\Usuario;

class IndexController extends TemplateConfig{

    public function index(){
        $this->view("site/index", ["title" => "App Barbeiros"]);
    }

    public function test(){
        $usuario = new Usuario;

        $usuario->findBy("usuario", "Gustavo");

        $create = $usuario->create([
          "usuario" => "Gustavo",
          "viewSenha" => "Meu amigo"
        ]);


        if($create == 1){
          echo "sucesso";
        }else{
          echo "Negado";
        } 
        


    }

}