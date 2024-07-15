<?php 

namespace Src\POST\Barbeiro;
use Src\Database\Model\HorarioAtendimento;
use Src\Services\Validate;

class CadastroHorarios {

    protected Validate $validate;
    protected HorarioAtendimento $atendimento;
    protected string $start;
    protected string $end;

    public function __construct()
    {
        $this->validate = new Validate;
        $this->atendimento = new HorarioAtendimento;
        $this->start = $_POST['inicial'];
        $this->end = $_POST['final'];
    }

    public function Result($data)
    {
        session_start();
       if(!$this->request()){
         $this->create($data['id']);
       }
    }

    private function request()
    {
        $request = [
            "Horário Inicial" => $this->start,
            "Horário Final" => $this->end
        ];

        if($this->validate->validate($request) != false){
            setSession("Message", messageWarning($this->validate->validate($request)));
            redirectBack();
            return true;
        }

        return false;
        
    }

    private function create(int $id)
    {
       $inicial = $this->replace($this->start);
       $final = $this->replace($this->end);

       for($hora = $inicial; $hora <= $final; $hora++){
            for($minutos = 0; $minutos < 60; $minutos += 30){
                $tempoFormatado = str_pad($hora, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minutos, 2, "0", STR_PAD_LEFT). ":" . "00"; 
                $create = $this->atendimento->create([
                  "fk" => $id,
                  "hora" => $tempoFormatado
                ]);

                if($create > 0){
                    setSession("Message",sweetAlertSuccess("Horários de atendimento cadastrados", "Sucesso"));
                    redirectBack();
                }else{
                    setSession("Message", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
                    redirectBack();
                }
            }
       }
    }

    private function replace(string $valor)
    {
        $zero = str_replace("0", "", $valor);
        $caracter = str_replace(":", "", $zero);
        $result = $caracter;
        return $result;
    }
}