<?php 

namespace Src\POST\Solicitacoes;

use Src\Database\Model\AcessoBarbeiro;
use Src\Database\Model\Barbeiro;
use Src\Database\Model\Usuario;

class UpdateSolicitacaoBarbeiro {
  
    private  AcessoBarbeiro $acesso;
    private Barbeiro $barbeiro;  
    private Usuario $user;

    public function __construct()
    {
        $this->acesso = new AcessoBarbeiro;
        $this->barbeiro = new Barbeiro;
        $this->user = new Usuario;
    } 

    public function Andamento($data)
    {

        $id = $data['id'];
        $update = $this->acesso->update("id", $id, ["status" => 2]);

        if($update > 0){
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

}