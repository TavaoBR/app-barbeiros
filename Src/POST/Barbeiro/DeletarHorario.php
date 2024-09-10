<?php 

namespace Src\POST\Barbeiro;
use Src\Database\Model\HorarioAtendimento;

class DeletarHorario
{

    protected HorarioAtendimento $atendimento;

    public function __construct()
    {
      $this->atendimento = new HorarioAtendimento;
    }


    public function deletar($data)
    {
        $id = $data['id'];
        $delete = $this->atendimento->delete("id",$id);
        
        if($delete > 0){
            $response = [
                "success" => true,
                "message" => "Horario excluido com sucesso"
              ];
        }else{
            $response = [
                "success" => false,
                "message" => "Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"
             ];
        }

        echo json_encode($response);

    }

    public function deletarTodos($data)
    {
      
        $fk = $data['fk'];
        $delete = $this->atendimento->delete("fk", $fk);
      
        if($delete > 0){
            $response = [
                "success" => true,
                "message" => "Horarios excluidos com sucesso"
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