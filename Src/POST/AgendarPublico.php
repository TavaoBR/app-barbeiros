<?php

namespace Src\POST;
use Src\Services\Whatsapp\Link;
use Src\Services\Whatsapp\Message;
use Src\Database\Model\AgendaBarbeiro;
use Src\Database\Model\Barbeiro;
use Src\Services\CodigoAgendamento;
use Src\Services\Validate;

class AgendarPublico {
    private Barbeiro $barbeiro;
    private AgendaBarbeiro $agenda;
    private Validate $validate;
    private CodigoAgendamento $codigo;
    private string $data;
    private string $valor;
    private string $servicos;
    private string $nome;
    private string $celular;
    private ?string $hora;
    private ?int $fk;

    public function __construct(){
        $this->barbeiro = new Barbeiro;
        $this->agenda = new AgendaBarbeiro;
        $this->validate = new Validate;
        $this->codigo = new CodigoAgendamento;
        $this->data = $_POST['data'];
        $this->nome = $_POST['nome'];
        $this->servicos = $_POST['itensEscolhidos'];
        $this->valor = $_POST['valorTotal'];
        $this->celular = $_POST['celular'];
        $this->hora = $_POST['horario'];
        $this->fk = $_POST['fk'];
    }

    public function Result()
    {
      session_start();
      if(!$this->request() AND !$this->verificaTelefonetemagendamento()){
          $this->agendar();
      }
    }

    private function request()
    {
        $request = [
            "Nome" => $this->nome,
            "Celular" => $this->celular,
            "Serviço" => $this->servicos,
            "Data" => $this->data,
            "Horario" => $this->hora,
        ];

        if($this->validate->validate($request) != false){

            setSession("MessageAgenda", messageWarning($this->validate->validate($request)));
            redirectBack();
            return true;
        }

        return false;
    }

    private function verificaTelefonetemagendamento()
    {
        $verifica = verificaTelefonetemagendamento($this->celular, $this->data);
        if($verifica[0] > 0){
            if($verifica[1]->status == 1){
                $dataFormatada = date("d/m/Y", strtotime($this->data));
                setSession("MessageAgenda", sweetAlertWarning("A data $dataFormatada já tem um agendamento seu, escolha outra data", "Você já fez um agendamento"));
                redirectBack();
                return true;
             }
        }

        return false;
    }

    private function selectBarbeiro()
    {
        $select = $this->barbeiro->findBy("id", $this->fk); 

        return $select[1]->celular;
    }

    private function agendar()
    {
        $codigo = $this->codigo->result();

        $create = $this->agenda->create([
            "fkBarbeiro" => $this->fk,
            "codigo" => $codigo,
            "nome" => $this->nome,
            "celular" => $this->celular,
            "data" => $this->data,
            "horario" => $this->hora,
            "servicosSolicitados" => $this->servicos,
            "valorTotal" => $this->valor,
            "status" => 1
       ]); 

       if($create > 0){
        setSession("MessageAgenda", sweetAlertSuccess("Você acabou de agendar seu corte, por favor aguarde a confirmação Barbeiro 😁", "Sucesso ao Agendar"));
        $celular = $this->selectBarbeiro();
        $this->alertCelularCliente();
        $this->alertarWhatsappBarbeiro($celular, $this->hora, $codigo);
        redirectBack();
       }else{
        setSession("MessageAgenda", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));  
        redirectBack();
       }
    }

    private function alertCelularCliente()
    {

        $message = "
        *Barbearia Match*, Parabéns você acabou de agendar seu *corte* com *sucesso*,
         Estamos enviando essa mensagem para avisar que esse será número que irá notificar sobre a plataforma 
        ";
        $zap = new Message($this->celular, $message);
        $zap->send();
    }

    private function alertarWhatsappBarbeiro(string $celular, string $horario, string $codigo)
    {

        $data = date("d/m/Y", strtotime($this->data));

        $link1 = routerConfig()."/barbearia/confirmar/atendimento/$codigo";
        $link2 = routerConfig()."/barbearia/cancelar/atendimento/$codigo";

        $message = "
           🧏 Você tem um novo agendamento:
           \n 🔣 Codigo : {$codigo}
           \n 👤: {$this->nome}
           \n 📆 Data: {$data}
           \n ⏰ Horario: {$horario}
           \n 📋 Serviço: {$this->servicos}
           \n 💰 Valor: R$ {$this->valor}
           \n Clique no link abaixo para confirmar: 
           \n $link1
           \n Clique no link abaixo para cancelar: 
           \n $link2 
        ";


        /*
           \n Clique no link abaixo para confirmar: 
           \n $link1
           \n Clique no link abaixo para cancelar: 
           \n $link2 
        */

        $api = new Message($celular, $message);
        return $api->send();
    }
}