<?php

namespace Src\Controller;
use Src\Database\Model\AgendaBarbeiro;
use Src\Database\Model\Barbeiro;
use Src\Services\Whatsapp\Message;

class Publico 
{
    private Barbeiro $barbeiro;
    private AgendaBarbeiro $agenda;

    public function __construct()
    {
        $this->barbeiro = new Barbeiro;
        $this->agenda = new AgendaBarbeiro;
    }

    public function BarbeariaConfirmar($data)
    {
       $codigo = $data['codigo'];
       $select = $this->getCodigo($codigo);
       
       if($select[0] > 0){
          $dados = $select[1];
          $dataAtendimento = date("d/m/Y", strtotime($dados->data));
          $hora = date("H:i", strtotime($dados->horario));
          $barbearia = $this->barbeiro->findBy("id", $dados->fkBarbeiro);
          $nomeBarbearia = $barbearia[1]->nomeBarbeiro;
          switch($dados->status){
            
            case 2:
              redirect(routerConfig()."/alerta/codigo/2");
            break;
            
            case 3:
              redirect(routerConfig()."/alerta/codigo/3");
            break;
            
            case 4:
              redirect(routerConfig()."/alerta/codigo/4");         
            break;
            case 5:
               redirect(routerConfig()."/alerta/codigo/5");
            break;   

            default:
               $update = $this->agenda->update("id", $dados->id, ["status" => 2]);
               if($update > 0){
                  $this->alertConfirmadoAtendimento($dados->celular, $nomeBarbearia, $codigo, $dataAtendimento, $hora);
                  redirect(routerConfig()."/atendimento/sucesso/1");
               }else{
                  redirect(routerConfig()."/atendimento/erro");
               }
            break;
          }
       }else{
          redirect(routerConfig()."/alerta/codigo/1");
       }
       
       
    }

    public function BarbeariaCancelar($data)
    {
      $codigo = $data['codigo'];
      $select = $this->getCodigo($codigo);
      
      if($select[0] > 0){
         $dados = $select[1];
         $dataAtendimento = date("d/m/Y", strtotime($dados->data));
         $hora = date("H:i", strtotime($dados->horario));
         $barbearia = $this->barbeiro->findBy("id", $dados->fkBarbeiro);
         $nomeBarbearia = $barbearia[1]->nomeBarbeiro;
         switch($dados->status){
           
           
           case 3:
             redirect(routerConfig()."/alerta/codigo/3");
           break;
           
           case 4:
             redirect(routerConfig()."/alerta/codigo/4");         
           break;
           case 5:
              redirect(routerConfig()."/alerta/codigo/5");
           break;   

           default:
              $update = $this->agenda->update("id", $dados->id, ["status" => 3]);
              if($update > 0){
                 $this->alertCanceladoAtendimento($dados->celular, $nomeBarbearia, $dataAtendimento, $hora);
                 redirect(routerConfig()."/atendimento/sucesso/2");
              }else{
                 redirect(routerConfig()."/atendimento/erro");
              }
           break;
         }
      }else{
         redirect(routerConfig()."/alerta/codigo/1");
      }
    }


    public function ClienteConfirmar($data)
    {
      $codigo = $data['codigo'];
      $select = $this->getCodigo($codigo);
      
      if($select[0] > 0){
         $dados = $select[1];
         $dataAtendimento = date("d/m/Y", strtotime($dados->data));
         $hora = date("H:i", strtotime($dados->horario));
         $barbearia = $this->barbeiro->findBy("id", $dados->fkBarbeiro);
         switch($dados->status){
           
           case 3:
             redirect(routerConfig()."/alerta/codigo/3");
           break;
           
           case 4:
             redirect(routerConfig()."/alerta/codigo/4");         
           break;
           case 5:
              redirect(routerConfig()."/alerta/codigo/5");
           break;   

           default:
              $update = $this->agenda->update("id", $dados->id, ["status" => 4]);
              if($update > 0){
                 $this->alertClienteConfirmado($barbearia[1]->celular,$dados->nome, $dataAtendimento, $hora);
                 redirect(routerConfig()."/atendimento/sucesso/3");
              }else{
                 redirect(routerConfig()."/atendimento/erro");
              }
           break;
         }
      }else{
         redirect(routerConfig()."/alerta/codigo/1");
      }
    }

    public function ClienteCancelar($data)
    {
      $codigo = $data['codigo'];
      $select = $this->getCodigo($codigo);
      
      if($select[0] > 0){
         $dados = $select[1];
         $dataAtendimento = date("d/m/Y", strtotime($dados->data));
         $hora = date("H:i", strtotime($dados->horario));
         $barbearia = $this->barbeiro->findBy("id", $dados->fkBarbeiro);
         switch($dados->status){
           
           case 2:
             redirect(routerConfig()."/alerta/codigo/2");
           break;
           
           case 3:
             redirect(routerConfig()."/alerta/codigo/3");
           break;
           
           case 4:
             redirect(routerConfig()."/alerta/codigo/4");         
           break;
           case 5:
              redirect(routerConfig()."/alerta/codigo/5");
           break;   

           default:
              $update = $this->agenda->update("id", $dados->id, ["status" => 3]);
              if($update > 0){
                 $this->alertClienteCancelou($barbearia[1]->celular, $dados->nome, $dataAtendimento, $hora);
                 redirect(routerConfig()."/atendimento/sucesso/4");
              }else{
                 redirect(routerConfig()."/atendimento/erro");
              }
           break;
         }
      }else{
         redirect(routerConfig()."/alerta/codigo/1");
      }
    }

    private function getCodigo($codigo)
    {
      $codigo = $this->agenda->findBy("codigo", $codigo);
      return $codigo;
    }

    private function alertConfirmadoAtendimento($to, $nome, $codigo, $data, $hora)
    {

      $link1 = routerConfig()."/cliente/confirmar/atendimento/$codigo";
      $link2 = routerConfig()."/cliente/cancelar/atendimento/$codigo";

       $message = "
        ✅ Seu agendamento foi confirmado pela Barbearia {$nome}
        \n Codigo : {$codigo}
        \n 📆 Data: {$data}
        \n ⏰ Horario: {$hora}
        \n Clique no link abaixo para confirmar sua presença:
        \n $link1
        \n Clique no link abaixo para cancelar sua consulta: 
        \n $link2 
       ";

       /*
       \n Clique no link abaixo para confirmar sua presença:
        \n $link1
        \n Clique no link abaixo para cancelar sua consulta: 
        \n $link2 
       */
       $zap = new Message($to, $message);
       $zap->send();
    }

    private function alertCanceladoAtendimento($to, $nome, $data, $hora)
    {
       $message = "
        ❌ Seu agendamento foi cancelado pela Barbearia {$nome}
         \n 📆 Na Data: {$data}
         \n ⏰ No Horario: {$hora}
        \n Não fique triste 😭, entre no sistema e tente agendar para outro dia com o mesmo ou procure outra barbearia
       ";
       $zap = new Message($to, $message);
       $zap->send();
    }

    private function alertClienteCancelou($to, $nome, $data, $hora)
    {
       $message = "
       ❌ {$nome} cancelou sua presença
        \n 🗓️ Data: {$data}
        \n ⏰ Horario: {$hora}
       ";
       $zap = new Message($to, $message);
       $zap->send();
    }

    private function alertClienteConfirmado($to, $nome, $data, $hora)
    {
       $message = "
       ✅ {$nome} confirmou presença no seu estabelecimento
       \n 🗓️ Data: {$data}
       \n ⏰ Horario: {$hora}
       ";
       $zap = new Message($to, $message);
       $zap->send();
    }
} 