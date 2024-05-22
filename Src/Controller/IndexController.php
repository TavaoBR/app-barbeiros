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

        $create = $usuario->create([
          "nome" => "Gustavo",
          "cpf" => "081.628.985-90"
        ]);

        if($create){
          echo "sucesso";
        }else{
          echo "Negado";
        } 
        


    }

}