<?php 

namespace Src\POST\Barbeiro;
use Src\Database\Model\AgendaBarbeiro;
use Src\Database\Model\Barbeiro;
use Src\Database\Model\historicoAgendamento;
use Src\Services\Whatsapp\Message;

class AtendimentoUpdate 
{

    private Barbeiro $barbeiro;
    private AgendaBarbeiro $agenda;
    private historicoAgendamento $historico;

    public function __construct()
    {
        $this->agenda = new AgendaBarbeiro;
        $this->barbeiro = new Barbeiro;
        $this->historico = new historicoAgendamento;
    }

    /*public function confirmarTodos($data)
    {
         $fk = $data['fk'];
         $dia = $data['data'];
         $select = agendaBarbeiroDataOrderDesc($fk, $data);
    }

    public function cancelarTodos($data)
    {
      $fk = $data['fk'];
      $dia = $data['data'];
      $select = agendaBarbeiroDataOrderDesc($fk, $data);
    }*/

    public function concluirTodos()
    {
      session_start();
      $fk = $_POST['fk'];
      $dia = $_POST['data'];
      $select = agendaBarbeiroDataOrderDesc($fk, $dia);
      $dados = $select[1];
      $success = true;
      //$cel = [];
      $ganhos = [];
      foreach($dados as $array){
        if($array->status != 3 AND $array->status != 5){
          $update =  $this->agenda->update("id", $array->id, ["status" => 5]);  
          $ganhos[] = $array->valorTotal;
          if($update <= 0){
             $success = false;
             break;
          }
        }      
      }

      if($success){
        $total = array_sum($ganhos);
         foreach($dados as $alert){           
          if($alert->status == 5){
            $this->alertaConcluido($alert->celular, $alert->codigo);
          }
         }
         setSession("ConcluidosAgenda", sweetAlertSuccess("Agenda Concluida com sucesso, seu ganho foi de: R$ $total ", "Sucesso"));
      }else{
        setSession("ConcluidosAgenda", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
      }

      redirectBack();

    }

    public function ConfirmarAtendimento($data)
    {
        $codigo = $data['codigo'];
        $select = $this->agenda->findBy("codigo", $codigo);
        $selectBarbeiro = $this->barbeiro->findBy("id", $select[1]->fkBarbeiro);
        $barbeiro = $selectBarbeiro[1]->nomeBarbeiro;
        $celular = $select[1]->celular;
        $id = $select[1]->id;
        $status = 2;
        $dataA = date("d/m/Y", strtotime($select[1]->data));
        $update = $this->agenda->update("id", $id, ["status" => $status]);
        $hora = date("H:i", strtotime($select[1]->horario));
        if($update > 0){
          $message = "
           ✅ Seu agendamento foi confirmado por {$barbeiro}:
           \n 🔣 Codigo : {$codigo}
           \n 📆 Data: {$dataA}
           \n ⏰ Horario: {$hora}
           \n Acesse o sistema e use codigo para confirmar sua presença ou cancelar
          ";
          //$this->historicoAgendamento($codigo, $status);
          //$this->historicoAgendamento($codigo, 4);
          $this->alertarWhatsap($message, $celular);   
          $response = [
            "success" => true,
            "message" => "Alterado o status para Confirmado, enviamos um alerta para o cliente, confirmar sua presença"
          ];  
        }else{
            $response = [
                "success" => false,
                "message" => "Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"
             ];
        }
        echo json_encode($response);   
    }

    public function CancelarAtendimento($data)
    {
        $codigo = $data['codigo'];
        $select = $this->agenda->findBy("codigo", $codigo);
        $selectBarbeiro = $this->barbeiro->findBy("id", $select[1]->fkBarbeiro);
        $barbeiro = $selectBarbeiro[1]->nomeBarbeiro;
        $celular = $select[1]->celular;
        $id = $select[1]->id;
        $status = 3;
        $dataA = date("d/m/Y", strtotime($select[1]->data));
        $hora = date("H:i", strtotime($select[1]->horario));
        $update = $this->agenda->update("id", $id, ["status" => $status]);
        if($update > 0){
         $message = "
            \n❌ Seu agendamento foi cancelado por {$barbeiro}:
            \n 📆 Data do seu agendamento: {$dataA}
            \n ⏰ Horario do seu agendamento: {$hora}
            \n Não fique triste 😭, entre no sistema e tente agendar para outro dia
         ";
         //$this->historicoAgendamento($codigo, $status);
         $this->alertarWhatsap($message, $celular);  
         $response = [
            "success" => true,
            "message" => "Alterado o status para Cancelado, que pena, enviamos um alerta para o cliente, avisando sobre o cancelamento"
          ];
        }else{
            $response = [
                "success" => false,
                "message" => "Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"
             ];
        }

        echo json_encode($response);
    }

    public function ConcluirAtendimento($data)
    {
      $codigo = $data['codigo'];
      $select = $this->agenda->findBy("codigo", $codigo);
      $selectBarbeiro = $this->barbeiro->findBy("id", $select[1]->fkBarbeiro);
      $barbeiro = $selectBarbeiro[1]->nomeBarbeiro;
      $celular = $select[1]->celular;
      $id = $select[1]->id;
      $status = 5;
      $dataA = date("d/m/Y", strtotime($select[1]->data));
      $hora = date("H:i", strtotime($select[1]->horario));
      $update = $this->agenda->update("id", $id, ["status" => $status]);
      if($update > 0){
       $message = "
          ✅ Seu atendimento foi concluido por {$barbeiro}:
          \n 📆 Data: {$dataA}
          \n ⏰ Horario: {$hora}
          \n 🔣 Codigo : {$codigo}
          \n Entre no sistema e avalie seu atendimento, use codigo
       ";
       //$this->historicoAgendamento($codigo, $status);
       $this->alertarWhatsap($message, $celular);  
       $response = [
          "success" => true,
          "message" => "Alterado o status para Cancelado, que pena, enviamos um alerta para o cliente, avisando sobre o cancelamento"
        ];
      }else{
          $response = [
              "success" => false,
              "message" => "Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"
           ];
      }

      echo json_encode($response);
    }

    private function historicoAgendamento(string $codigo, int $status)
    {
         $create = $this->historico->create([
           "codigo" => $codigo,
           "status" =>  $status,
           "dateCreated" => dataAtual(),
           "timeCreated" => horarioAtual()
         ]);

         return $create;
    }

    private function alertarWhatsap(string $message, string $celular)
    {
        $api = new Message($celular, $message);
        return $api->send();
    }

    private function alertaConcluido($to, $codigo)
    { 
       $link = routerConfig()."/atendiment/avaliar/$codigo";
       $message = "
        Seu atendimento foi concluido com sucesso
        \n Faça avaliação, clicando no link abaixo
        \n $link 
       ";
       $zap = new Message($to, $message);
       return $zap->send();
    }


}