<?php 

namespace Src\POST;
use Src\Database\Model\AgendaBarbeiro;
use Src\Database\Model\Barbeiro;
use Src\GET\Usuario;
use Src\Services\Whatsapp;

class Atendimento {

    private AgendaBarbeiro $agenda;
    private Barbeiro $barbeiro;
    private string $codigo;

    public function __construct()
    {
       $this->barbeiro = new Barbeiro; 
       $this->agenda = new AgendaBarbeiro;
       $this->codigo = $_POST['codigo'];
    }

    public function confirmarPresenca()
    {
        session_start();
        $codigo = $this->selectCodigo();

        
        if($codigo[0] > 0){
            $idUser =  $this->selectCliente();

            switch(true){
              case $codigo[1]->fkUser != $idUser:
                setSession("ConfPresenca", sweetAlertWarning("Esse codigo não pertence a você 🤨", "Oops"));
                redirectBack();
              break;  

              case $codigo[1]->status == 2:
                $cliente = $codigo[1]->nome;
                $data = date("d/m/Y", strtotime($codigo[1]->data));
                $horario = date("H:i", strtotime($codigo[1]->horario));
                $barbeiro = $this->selectBarbeiro($codigo[1]->fkBarbeiro);
                $celularBarbeiro = $barbeiro->celular;
                $status = 4;
                $update = $this->updateStatus($status);
                
                if($update > 0){
                    setSession("ConfPresenca", sweetAlertSuccess("Parabéns você confirmou sua presença, enviamos um alerta para estabelecimento 😊", "Sucesso"));
                    $message = "
                     ✅ {$cliente} confirmou presença no seu estabelecimento
                     \n 🗓️ Data: {$data}
                     \n ⏰ Horario: {$horario}
                    ";
                    $this->alertaWhatsapp($message, $celularBarbeiro);
                    redirectBack();
                }else{
                    setSession("ConfPresenca", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
                    redirectBack();
                }
              break;  

              case $codigo[1]->status == 4:
                setSession("ConfPresenca", sweetAlertWarning("Você já confirmou presença 🤨", "Oops"));
                redirectBack();
              break;   

              default:
                setSession("ConfPresenca", sweetAlertWarning("O estabelicimento ainda não confirmou seu atendimento, confirme apenas quando o mesmo confirmar seu atendimento 😊", "Oops"));
                redirectBack();
              break;

            }

        }else{
          setSession("ConfPresenca", sweetAlertWarning("Esse codigo não existe 🤨", "Oops"));
          redirectBack();
        }
    }

    public function cancelarPresenca()
    {
        session_start();
        $codigo = $this->selectCodigo();

        
        if($codigo[0] > 0){
            $idUser =  $this->selectCliente();

            switch(true){
              case $codigo[1]->fkUser != $idUser:
                setSession("ConfPresenca", sweetAlertWarning("Esse codigo não pertence a você 🤨", "Oops"));
                redirectBack();
              break;  

                case $codigo[1]->status == 1:
                case $codigo[1]->status == 2:
                case $codigo[1]->status == 4:
                  $cliente = $codigo[1]->nome;
                  $data = date("d/m/Y", strtotime($codigo[1]->data));
                  $horario = date("H:i", strtotime($codigo[1]->horario));
                  $barbeiro = $this->selectBarbeiro($codigo[1]->fkBarbeiro);
                  $celularBarbeiro = $barbeiro->celular;
                  $status = 3;
                  $update = $this->updateStatus($status);
                  
                  if($update > 0){
                      setSession("CancelPresenca", sweetAlertSuccess("Confirmamos seu cancelamento, enviamos um alerta ao estabelecimento avisando sobre", "Que pena 😭"));
                      $message = "
                      ❌ {$cliente} cancelou sua presença
                      \n 🗓️ Data: {$data}
                      \n ⏰ Horario: {$horario}
                      ";
                      $this->alertaWhatsapp($message, $celularBarbeiro);
                      redirectBack();
                  }else{
                      setSession("CancelPresenca", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
                      redirectBack();
                  }
                break;  

              case $codigo[1]->status == 3:
                setSession("CancelPresenca", sweetAlertWarning("Você já cancelou sua presença 🤨", "Oops"));
                redirectBack();
              break;   

            }

        }else{
          setSession("CancelPresenca", sweetAlertWarning("Esse codigo não existe 🤨", "Oops"));
          redirectBack();
        }
    }

    private function selectCodigo()
    {
        $select = $this->agenda->findBy("codigo", $this->codigo);
        return $select;
        
    }

    private function selectBarbeiro(int $id)
    {
       $select = $this->barbeiro->findBy("id", $id);
       return $select[1];
    }

    private function selectCliente()
    {
        $select = new Usuario;
        return $select->id();
    }

    private function updateStatus(int $status)
    {
        $update = $this->agenda->update("codigo", $this->codigo, ["status" => $status]);
        return $update;
    }

    
    private function alertaWhatsapp(string $mesagem, string $celular)
    {
        $api = new Whatsapp($celular, $mesagem);
        return $api->send();
    }
}