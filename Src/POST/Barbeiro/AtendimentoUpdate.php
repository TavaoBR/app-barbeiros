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

    public function confirmarTodos($data)
    {
         session_start();
         $fk = $data['fk'];
         $dia = $data['data'];
         $select = agendaBarbeiroDataStatus($fk, $dia, 1);
         if($select[0] > 0){
           $dados = $select[1];
           $success = true;
           foreach($dados as $array){
            $update = $this->agenda->update("id", $array->id, ["status" => 2]);
            if($update <= 0){
              $success = false;
              break;
            }

            if($success){
              setSession("ConcluidosAgenda", sweetAlertSuccess("Você confirmou os atendimentos com sucesso!", "Sucesso"));
              $this->alertaConfirmado($fk, $dia);
            }else{
              setSession("ConcluidosAgenda", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
            }

            redirectBack();
           }
         }else{
          setSession("ConcluidosAgenda", sweetAlertWarning("Você não tem nenhum agendamento para confirmar", "Ops"));
          redirectBack();
        }
    }

    public function cancelarTodos($data)
    {
      session_start();
        if (!isset($_POST['fk']) || !isset($_POST['data'])) {
            setSession("ConcluidosAgenda", sweetAlertError("Dados inválidos, tente novamente."));
            redirectBack();
            return;
      }
      $fk = $data['fk'];
      $dia = $data['data'];
      $select = agendaBarbeiroDataOrderDesc($fk, $dia);
      $dados = $select[1];
      $success = true;

      foreach($dados as $array){
         if($array->status == 3 || $array->status == 5){
          setSession("ConcluidosAgenda", sweetAlertWarning("Você tem nenhum agendamento para cancelar hoje", "Ops"));
          redirectBack();
          return;
         }
      }

      foreach($dados as $array){
        $update = $this->agenda->update("id", $array->id, ["status" => 3]);
        if($update <= 0){
          $success = false;
          break;
        }
      }


      if($success){
        setSession("ConcluidosAgenda", sweetAlertSuccess("Que pena, você cancelou seus compromissos de hoje", "Sucesso"));
        $this->alertCancelado($fk, $dia);
      }else{
        setSession("ConcluidosAgenda", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
      }

      redirectBack();
      
    }

    public function concluirTodos()
    {
        session_start();
        if (!isset($_POST['fk']) || !isset($_POST['data'])) {
            setSession("ConcluidosAgenda", sweetAlertError("Dados inválidos, tente novamente."));
            redirectBack();
            return;
        }
    
        $fk = $_POST['fk'];
        $dia = $_POST['data'];
        $select = agendaBarbeiroDataOrderDesc($fk, $dia);
        $dados = $select[1];
        $success = true;
        $ganhos = [];
    
        // Verifica se há agendamentos já concluídos
        foreach ($dados as $array) {
            if ($array->status == 3 || $array->status == 5) {
                setSession("ConcluidosAgenda", sweetAlertWarning("Você tem nenhum agendamento para concluir hoje", "Ops"));
                redirectBack();
                return; // Finaliza o processamento
            }
        }
    
        // Atualiza o status dos agendamentos e calcula ganhos
        foreach ($dados as $array) {
            $update = $this->agenda->update("id", $array->id, ["status" => 5]);
            $ganhos[] = $array->valorTotal;
    
            if ($update <= 0) {
                $success = false;
                break;
            }
        }
    
        if ($success) {
            $total = number_format(array_sum($ganhos), 2, ',', '.');
            $this->alertaConcluido($fk, $dia);
            setSession("ConcluidosAgenda", sweetAlertSuccess("Agenda Concluída com sucesso! Seu ganho foi de: R$ $total", "Sucesso"));
        } else {
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

    private function alertaConfirmado($fk, $data)
    {
      $select = agendaBarbeiroDataStatus($fk, $data, 2);
      $selectBarbeiro = perfilBarberio($fk);
      $nome = $selectBarbeiro[1]->nomeBarbeiro;
      $dados = $select[1];
      foreach($dados as $alert){
        $to = $alert->celular;
        $codigo = $alert->codigo;
        $link1 = routerConfig()."/cliente/confirmar/atendimento/$codigo";
        $link2 = routerConfig()."/cliente/cancelar/atendimento/$codigo";
        $dia = date("d/m/Y", strtotime($alert->data));
        $hora = date("H:i", strtotime($alert->horario));
        $message = "
        ✅ Seu agendamento foi confirmado pela Barbearia {$nome}
        \n Codigo : {$codigo}
        \n 📆 Data: {$dia}
        \n ⏰ Horario: {$hora}
        \n Clique no link abaixo para confirmar sua presença:
        \n $link1
        \n Clique no link abaixo para cancelar sua consulta: 
        \n $link2 
       ";
        $zap = new Message($to, $message);
        $zap->send();         
       }
    }

    private function alertCancelado($fk, $data)
    {
      $select = agendaBarbeiroDataStatus($fk, $data, 3);
      $selectBarbeiro = perfilBarberio($fk);
      $nome = $selectBarbeiro[1]->nomeBarbeiro;
      $dados = $select[1];
      foreach($dados as $alert){
        $to = $alert->celular;
        $dia = date("d/m/Y", strtotime($alert->data));
        $hora = date("H:i", strtotime($alert->horario));
        $message = "
        ❌ Seu agendamento foi cancelado pela Barbearia {$nome}
        \n 📆 Na Data: {$dia}
        \n ⏰ No Horario: {$hora}
        \n Não fique triste 😭, entre no sistema e tente agendar para outro dia com o mesmo ou procure outra barbearia
       ";
        $zap = new Message($to, $message);
        $zap->send();         
       }
    }

    private function alertaConcluido($fk, $data)
    { 
       

       $select = agendaBarbeiroDataStatus($fk, $data, 5);
       $dados = $select[1];

       foreach($dados as $alert){
        $to = $alert->celular;
        $codigo = $alert->codigo;
        $link = routerConfig()."/atendimento/avaliar/$codigo";

        $message = "
          Seu atendimento foi concluido com sucesso
          \n Faça avaliação, clicando no link abaixo
          \n $link 
        ";
        $zap = new Message($to, $message);
        $zap->send();         
       }


    }


}