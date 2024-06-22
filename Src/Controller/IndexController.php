<?php 

namespace Src\Controller;
use Config\TemplateConfig;
use Src\Database\Filters;
use Src\Database\Model\Usuario;
use Src\GET\Usuario as UserGet;
use Src\POST\Test\Login;

class IndexController extends TemplateConfig{

    public function index()
    {
        $this->view("site/index", ["title" => "App Barbeiros"]);
    }

    public function cadastro()
    {
       session_start();
       $this->view("site/cadastro",  ["title" => "Cadastro"]);
    }

    public function login()
    {
      include_once("Web/site/login.php");
    }

    public function sair()
    {
      session_destroy();
      session_start();
      unsetSession("id");
      unsetSession("token");
      setSession("Mensagem",sweetAlertSuccess("Deslogado com sucesso"));
      redirect(routerConfig()."/login");
    }
    

    public function test(){



       /*session_start();
       $get = new UserGet();

       
       if($get->conta() == 1){

        echo "<br>";

       echo $get->usuario();
       echo "<br>";
       echo $get->mail();
       echo "<br>";
       echo $get->token();

       }else{
        echo "Não encontrado";
       }*/

       


         /*$test = new Login;

         $test->result();

        $usuario = new Usuario;

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