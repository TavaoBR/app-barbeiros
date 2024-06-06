<?php 

namespace Src\Controller;
use Config\TemplateConfig;
use Src\Database\Filters;
use Src\Database\Model\Usuario;
use Src\POST\Test\Login;

class IndexController extends TemplateConfig{

    public function index(){
        $this->view("site/index", ["title" => "App Barbeiros"]);
    }

    public function test(){

         $test = new Login;

         $test->result();

        /*$usuario = new Usuario;

        $usuario->findBy("usuario", "Gustavo");

        $create = $usuario->create([
          "usuario" => "guga_admin",
          "senha" => md5("guga1234")
        ]);


        if($create == 1){
          echo "sucesso";
        }else{
          echo "Negado";
        }*/
        


    }

}