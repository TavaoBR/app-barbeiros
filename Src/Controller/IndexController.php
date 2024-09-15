<?php 

namespace Src\Controller;
use Config\TelegramBot;
use Config\TemplateConfig;
use Src\Database\Filters;
use Src\Database\Model\AgendaBarbeiro;
use Src\GET\Barbeiro\Barbeiro;
use Src\Database\Model\ProfissionalBarbearia;
use Src\Database\Model\Usuario;
use Src\GET\Telegram\DefaultBot;
use Src\GET\Usuario as UserGet;
use Src\Services\CodigoAgendamento;
use Src\Services\Whatsapp;
use Src\Services\Whatsapp\Link;
use Src\Database\Model\ServicoBarbeiro;
use Src\Database\Model\HorarioAtendimento;

class IndexController extends TemplateConfig{

    protected $_smane;

    protected HorarioAtendimento $atendimento;
    protected ServicoBarbeiro $servicos;

    public function __construct()
    {
       $this->atendimento = new HorarioAtendimento;
       $this->servicos = new ServicoBarbeiro;
    }

    public function index()
    {
        $this->view("site/index", ["title" => "Barbearia Match"]);
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
    

    public function sucesso($data)
    {
 
      $message = "";
      switch($data['tipo']){
         case 1:
           $message = "Parabéns, você confirmou consulta do seu cliente, enviamos um alerta para o mesmo avisando sobre a confirmação";
         break; 

         case 2:
            $message = "Que pena, você acabou de cancelar a consulta com seu cliente, enviamos um alerta para o mesmo avisando sobre";
         break; 

         case 3:
           $message = "Parabéns, você confirmou sua presença na barbaearia, enviamos um alerta para o mesmo avisando sobre";
         break; 

         case 4:
          $message = "Que pena, você acabou de cancelar sua consulta na Barbearia, enviamos um alerta para o mesmo avisando sobre";
         break;
         
      }

       $this->view("site/webhooks/sucesso", ["title" => "Sucesso", "message" => $message]);
    }

    public function erro()
    {
      $this->view("site/webhooks/error", ["title" => "Erro"]);
    }

    public function alertaCodigo($data)
    {

      $message = "";
        switch($data['tipo']){
         case 1:
           $message = "Esse codigo não existe";
         break; 

         case 2:
            $message = "Esse codigo já foi atendido";
         break; 

         case 3:
           $message = "Esse codigo foi cancelado";
         break; 

         case 4:
           $message = "Esse codigo foi confirmado pelo cliente";
         break;
         
         case 5:
           $message = "Esse codigo já foi concluido";
         break; 
        } 

      $this->view("site/webhooks/tela", ["title" => "Alerta Codigo", "message" => $message]);
    }


    public function avaliar($data)
    {
       session_start();
       $this->view("site/avaliar", ["title" => "Avaliar Atendimento", "codigo" => $data['codigo']]);
    }

    public function procurar()
    {
      $this->view("site/busca/index", ["title"=> "Procurar"]);
    }

    public function resultado($data)
    {
      $uf = $data['uf'];
      $cidade = $data['cidade']; 
      $pesquisa = pesquisaTelaProcura($uf, $cidade);
      if($pesquisa[0] > 0){
        $this->view("site/busca/resultado", ["title"=> "Resultado", "result" => $pesquisa[1], "total" => $pesquisa[0]]);
      }else{
        $this->view("site/busca/naoEncontrado", ["title"=> "Resultado"]);
      }
      
    }


    public function perfil($data)
    {
        session_start();
        $barbeiro = new Barbeiro($data['token']);
        $servico = $this->servicos->fetchAll();
        $this->view("site/barbearia/index", 
        ["title" => "Perfil", "id" => $barbeiro->id(),"fk" => $barbeiro->fk(), "token" => $barbeiro->token(), "celular" => $barbeiro->celular(), "avatar" => $barbeiro->avatar(), "nome" => $barbeiro->nome(),
        "endereco" => $barbeiro->endereco(), "bairro" => $barbeiro->bairro(), "numero" => $barbeiro->numero(), "cidade" => $barbeiro->cidade(), "estado" => $barbeiro->estado(), "online" => $barbeiro->online(),
        "totalAvaliacao" => $barbeiro->totalAvalicao(), "valorNotas" => $barbeiro->valorTotalNotas(), "servicos" => $servico[1],
        "horaInicial" => horariosAtendimentoBarbeiroFirst($barbeiro->id())[1]->hora, "horaFinal" => horariosAtendimentoBarbeirolast($barbeiro->id())[1]->hora
      ]);
    }

    public function test(){


/*$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://apistart02.megaapi.com.br/rest/sendMessage/megastart-MRV06P5o2G2/text',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer MRV06P5o2G2'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;*/

     //$link = new Link("557991917634", "https://www.youtube.com/watch?v=IKqwRAUrsv8&t=520s&ab_channel=sarahw");
     //return $link->send();

     $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://apistart02.megaapi.com.br/rest/group/list/megastart-MRV06P5o2G2',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer MRV06P5o2G2'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;

      /*$barbeiro = new Barbeiro;
      $select = $barbeiro->findBy("id", 12);
      dd($select);*/

      /*$agenda = new AgendaBarbeiro;
      $filtro = new Filters;
      $filtro->where("fkBarbeiro", "=", 12);
      //$filtro->where("", "", "");
      $agenda->setFilters($filtro);
      $select = $agenda->fetchAll();
      dd($select);*/

      /*$barbeiros = new ProfissionalBarbearia;
      $filtro = new Filters;
      $filtro->where("fk", "=", 12);
      $barbeiros->setFilters($filtro);
      $select = $barbeiros->fetchAll();
      dd($select);*/

      /*$estado = "SE";
      $logica = "and";
      $cidade = "Aracaju";
      $barbearia = new Barbeiro;
      $filtro = new Filters;
      $filtro->where("estado", "=", $estado);
      $barbearia->setFilters($filtro);
      $select = $barbearia->fetchAll();
      dd($select);*/

      /*$data = "2024-08-04";
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

       }*/


       /*$instancia = new CodigoAgendamento;
       echo $instancia->result();*/
      




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