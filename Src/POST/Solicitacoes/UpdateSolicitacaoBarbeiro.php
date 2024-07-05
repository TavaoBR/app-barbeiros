<?php 

namespace Src\POST\Solicitacoes;

use Src\Database\Model\AcessoBarbeiro;
use Src\Database\Model\Barbeiro;

class UpdateSolicitacaoBarbeiro {
  
    private  AcessoBarbeiro $acesso;
    private Barbeiro $barbeiro;  

    public function __construct()
    {
        $this->acesso = new AcessoBarbeiro;
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

        $select = $this->acesso->findBy("id", $id);

        $data = $select[1];

        

    }

    public function Reprovado($data)
    {

    }

    public function Cancelado($data)
    {

    }

}