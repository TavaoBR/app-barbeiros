<?php 

namespace Src\POST\Usuario;

use Src\Database\Model\AgendaBarbeiro;
use Src\Database\Model\Barbeiro;
use Src\Database\Model\historicoAgendamento;
use Src\Database\Model\Usuario as ModelUsuario;
use Src\GET\Usuario\Usuario;
use Src\Services\CodigoAgendamento;
use Src\Services\Validate;
use Src\Services\Whatsapp;

class AgendarBarbeiro {

    private ModelUsuario $usuario;
    private Barbeiro $barbeiro;
    private AgendaBarbeiro $agenda;
    private Validate $validate;
    private CodigoAgendamento $codigo;
    private historicoAgendamento $historico;
    private string $data;
    private string $valor;
    private string $servicos;
    private string $nome;
    private string $celular;

    public function __construct(){
        $this->usuario = new ModelUsuario;
        $this->barbeiro = new Barbeiro;
        $this->agenda = new AgendaBarbeiro;
        $this->validate = new Validate;
        $this->codigo = new CodigoAgendamento;
        $this->historico = new historicoAgendamento;
        $this->data = $_POST['data'];
        $this->nome = $_POST['nome'];
        $this->servicos = $_POST['itensEscolhidos'];
        $this->valor = $_POST['valorTotal'];
        $this->celular = $_POST['celular'];
    }


    public function Result($data)
    {
        session_start();
        $id = $data['fk'];
        $horario = $_POST['horario'];

        if(!$this->request($horario) && !$this->verificaSeTemAgendaDataUsuario()){
            $this->agendar($id, $horario);
        }
    }

    private function request($horario)
    {
        
        $request = [
            "Nome" => $this->nome,
            "Celular" => $this->celular,
            "Serviço" => $this->servicos,
            "Data" => $this->data,
            "Horario" => $horario,
        ];

        if($this->validate->validate($request) != false){

            setSession("MessageAgenda", messageWarning($this->validate->validate($request)));
            redirectBack();
            return true;
        }
    
      
        return false;
    }

    private function verificaSeTemAgendaDataUsuario()
    {
        $get = new Usuario;
        $fkUser = $get->id();

        $verifica = UsuarioagendaBarbeiroData($fkUser, $this->data);

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

    private function selectBarbeiro(int $id)
    {
        $select = $this->barbeiro->findBy("id", $id); 

        return $select[1]->celular;
    }

    private function selectUsuarioCelular(int $id)
    {
       $select = $this->usuario->findBy("id", $id);
       return $select[1]->celular;
    }

    private function agendar(int $fkBarbeiro, string $horario)
    {
        $get = new Usuario;
        $fkUser = $get->id();
        $codigo = $this->codigo->result();

        $create = $this->agenda->create([
         "fkBarbeiro" => $fkBarbeiro,
         "fkUser" => $fkUser,
         "codigo" => $codigo,
         "nome" => $this->nome,
         "celular" => $this->celular,
         "data" => $this->data,
         "horario" => $horario,
         "servicosSolicitados" => $this->servicos,
          "valorTotal" => $this->valor,
          "status" => 1
        ]); 

        if($create > 0){
         setSession("MessageAgenda", sweetAlertSuccess("Você acabou de agendar seu corte, por favor aguarde a confirmação Barbeiro 😁", "Sucesso ao Agendar"));
         $celular = $this->selectBarbeiro($fkBarbeiro);
         $this->alertarWhatsappBarbeiro($celular, $horario, $codigo);
         //$this->historicoAgendamento($codigo, $horario, 1);
         //$this->historicoAgendamento($codigo, $horario, 2);
         redirectBack();
        }else{
          setSession("MessageAgenda", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));  
          redirectBack();
        }
    }

    private function historicoAgendamento(string $codigo, string $horario, int $status)
    {
         $create = $this->historico->create([
           "codigo" => $codigo,
           "status" =>  $status,
           "dateCreated" => $this->data,
           "timeCreated" => $horario
         ]);

         return $create;
    }

    private function alertarWhatsappBarbeiro(string $celular, string $horario, string $codigo)
    {

        $data = date("d/m/Y", strtotime($this->data));

        $message = "
           🧏 Você tem um novo agendamento:
           \n 🔣 Codigo : {$codigo}
           \n 👤: {$this->nome}
           \n 📆 Data: {$data}
           \n ⏰ Horario: {$horario}
           \n 📋 Serviço: {$this->servicos}
           \n 💰 Valor: R$ {$this->valor}
           \n Acesse o sistema e use codigo para confirmar o agendamento ou cancelar 
        ";
        $api = new Whatsapp($celular, $message);
        return $api->send();
    }


}