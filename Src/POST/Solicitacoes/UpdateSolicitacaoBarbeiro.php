<?php 

namespace Src\POST\Solicitacoes;

use Src\Database\Model\AcessoBarbeiro;
use Src\Database\Model\Barbeiro;
use Src\Database\Model\Usuario;
use Src\Services\Whatsapp;
use Src\Services\Datas;

class UpdateSolicitacaoBarbeiro {
  
    private Datas $datas;
    private  AcessoBarbeiro $acesso;
    private Barbeiro $barbeiro;  
    private Usuario $user;

    public function __construct()
    {
        $this->acesso = new AcessoBarbeiro;
        $this->barbeiro = new Barbeiro;
        $this->user = new Usuario;
        $this->datas = new Datas;
    } 

    public function Andamento($data)
    {

        $id = $data['id'];
        $update = $this->acesso->update("id", $id, ["status" => 2]);

        if($update > 0){
            $data = $this->selectDados($id);
            $celular = $data->celular;
            $this->whatsappAlertAndamento($celular);
            $response = [
                "success" => true,
                "message" => "Solicitação em Andamento" 
            ];
        }else{
            $response = [
                "success" => false,
                "message" => "Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"
             ];
        }

        echo json_encode($response);

    }

    public function Aprovado($data)
    {
        $id = $data['id'];
        
        $data = $this->selectDados($id);


        $request = [
          "fk" => $data->fk,
          "token" => $this->selectToken($data->fk),
          "cep" => $data->cep,
          "estado"  => $data->uf,
          "cidade" => $data->cidade,
          "bairro" => $data->bairro,
          "endereco" => $data->endereco,
          "numero" => $data->numero,
        ]; 

        $create = $this->barbeiro->create($request);
        $update = $this->acesso->update("id", $id, ["status" => 3]);
        $updateUser = $this->user->update("id", $data->fk, ["nivel" => 3]);
        

        if($create > 0 && $update > 0 && $updateUser > 0){
            $this->whatsappAlertAprovado($data->celular);
            $response = [
                "success" => true,
                "message" => "Solicitação Aprovado. Conta de Barbeiro criado com sucesso" 
             ];
        }else{
            $response = [
                "success" => false,
                "message" => "Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"
             ];
        }

        echo json_encode($response);

    }

    public function Reprovado($data)
    {
        $id = $data['id'];
        $update = $this->acesso->update("id", $id, ["status" => 4]);

        if($update > 0){
           $response = [
              "success" => true,
              "message" => "Solicitação Reprovada" 
           ];
        }else{
            $response = [
                "success" => false,
                "message" => "Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"
             ];
        }

        echo json_encode($response);
    }

    public function Cancelado($data)
    {

    }


    private function selectDados(int $id)
    {
        $select = $this->acesso->findBy("id", $id);
        return $select[1];
    }

    private function selectToken(int $id)
    {
        $get = new \Src\GET\Usuario($id);
        $token = $get->token();
        return $token;
    }

    private function whatsappAlertAndamento($to)
    {
        $data = $this->datas->dataAtual();
        $message =  "
        🧏 Sua solicitação está em analise:
          \n 📆 Data: $data
          \n Sua solicitação está em analise no momento
        ";
        $send = new Whatsapp($to, $message);

        return $send->send();

    }

    private function whatsappAlertAprovado($to)
    {
        $data = $this->datas->dataAtual();
        $message =  "
          ✅ Sua solicitação foi Aprovado:
          \n 📆 Data: $data
          \n Parabéns sua solicitação para ser barbeiro na plataforma foi aprovada
        ";

        $send = new Whatsapp($to, $message);

        return $send->send();
    }

}