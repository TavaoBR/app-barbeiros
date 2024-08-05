<?php 

namespace Src\Controller;
use Config\TelegramBot;
use Config\TemplateConfig;
use Src\Database\Filters;
use Src\Database\Model\Usuario;
use Src\GET\Telegram\DefaultBot;
use Src\GET\Usuario as UserGet;
use Src\Services\Whatsapp;

class IndexController extends TemplateConfig{

    protected $_smane;

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

    public function recuperar($data)
    { 
      $token = $data['token'];
      $usuario = new Usuario;
      $select = $usuario->findBy("token", $token);
      $conta = $select[0];
      $dados = $select[1];

      $this->view("site/usuario/recuperarConta",  ["title" => "Recuperar Conta", "conta" => $conta, "usuario" => $dados->usuario, "id" => $dados->id]);

    }
    

    public function test(){

      $data = "2024-08-04";
      $fk = "12";
      
       $fecth = agendaBarbeiroData($fk, $data);
      
       $fecth1 = horariosAtendimentoBarbeiro($fk);



       if($fecth[0] > 0){

        $horarioAgendamento = [];

        foreach($fecth[1] as $consulta){
          
          $horarioAgendamento[] = $consulta->horario;
       }
       

       foreach($fecth1[1] as $horas){
            if(!in_array($horas->hora, $horarioAgendamento)){
               echo $horas->hora . "<br>";
            } 
       }

       }else{

        foreach($fecth1[1] as $horas){
             echo $horas->hora . "<br>";
        }

       }

       




      //include_once("Web/site/test.php");

      /*$start = 8; // Hora inicial
      $end = 22; // Hora final

      // Array para armazenar os intervalos de tempo
      $times = [];

      for ($hour = $start; $hour <= $end; $hour++) {
          for ($minute = 0; $minute < 60; $minute += 30) {
              // Formata a hora e minuto com dois dígitos
              $formattedTime = str_pad($hour, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minute, 2, "0", STR_PAD_LEFT);
              $times[] = $formattedTime;
          }
      }

      // Imprime o array de intervalos de tempo
      print_r($times);*/

      /*$zap = new Whatsapp("+5579991917634", "Olá meu eu");
      $zap->send();*/

      /*$default = new DefaultBot();

      $id = $default->token();
      $chat = $default->chatId();
      $text = "Testando alerta 2";

      $send = new TelegramBot($id, $chat, $text);

      $send->send();

      echo "enviado";*/


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