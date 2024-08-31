<?php 

namespace Src\POST\Barbeiro;
use Src\Database\Model\ServicoBarbeiro;

class DeletarServico 
{
    private ServicoBarbeiro $servico;

    public function __construct()
    {
        $this->servico = new ServicoBarbeiro;
    }

    public function Deletar($data)
    {
       if($this->query($data['id'])){
         $response = [
            "success" => true,
            "message" => "Serviço excluido com sucesso"
          ];
       }else{
        $response = [
            "success" => false,
            "message" => "Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"
         ];
       }

       echo json_encode($response);
    }

    private function query(int $id)
    {

       $delete = $this->servico->delete("id", $id);

       if($delete > 0){
          return true;
       }else{
          return false;
       }
    }
}