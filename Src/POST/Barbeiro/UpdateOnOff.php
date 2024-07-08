<?php 

namespace Src\POST\Barbeiro;

use Src\Database\Model\Barbeiro;

class UpdateOnOff  
{

    private Barbeiro $barbeiro;

    public function __construct()
    {
       $this->barbeiro = new Barbeiro;
    }

    public function Online($data)
    {
        $id = $data['id'];
        $update = $this->barbeiro->update("id", $id, ["online" => 1]);

        if($update > 0){
           $response = [
            "success" => true,
            "message" => "Você está visivel para clientes"
           ];
        }else{
            $response = [
                "success" => false,
                "message" => "Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"
             ];
        }

        echo json_encode($response);
    }

    public function Offline($data)
    {
        $id = $data['id'];
        
        $update = $this->barbeiro->update("id", $id, ["online" => 2]);

        if($update > 0){
            $response = [
             "success" => true,
             "message" => "Você está invisivel para clientes"
            ];
         }else{
             $response = [
                 "success" => false,
                 "message" => "Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"
              ];
         }

         echo json_encode($response);
    }

}