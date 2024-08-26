<?php

namespace Src\POST;
use Src\Database\Model\AgendaBarbeiro;
use Src\Database\Model\Barbeiro;
use Src\GET\Usuario;
use Src\Services\Validate;
use Src\Services\Whatsapp;

class Avaliar
{
    private AgendaBarbeiro $agenda;
    private Barbeiro $barbeiro;
    private Validate $validate;
    private string $codigo;
    private string $nota;

    public function __construct()
    {
        $this->barbeiro = new Barbeiro; 
        $this->agenda = new AgendaBarbeiro;
        $this->validate = new Validate;
        $this->codigo = $_POST['codigo'];
        $this->nota = $_POST['nota'];
    }

    public function Result()
    {
        session_start();
        if(!$this->request()){
           $this->avaliar();
        }
    }

    private function avaliar()
    {

        $codigo = $this->selectCodigo();

        if($codigo[0] > 0){


            switch(true){

              case $codigo[1]->fkUser != $this->selectCliente():
                setSession("Avaliacao", sweetAlertWarning("Esse codigo não pertence a você 🤨", "Oops"));
                redirectBack();
              break;  

              case $codigo[1]->status != 5:
                setSession("Avaliacao", sweetAlertWarning("Esse atendimento ainda não foi concluid, volte depois de ser concluido", "Oops"));
                redirectBack();
              break;
              
              default:

                $selectBarbeiro = $this->selectBarbeiro($codigo[1]->fkBarbeiro);

                $totalNotas = $selectBarbeiro->valorTotalNotas;
                $totalAvaliacao = $selectBarbeiro->totalAvalicao;


                if($this->updateTotal($selectBarbeiro->id, $totalAvaliacao, $totalNotas) > 0){
                    setSession("Avaliacao", sweetAlertSuccess("Parabéns você avaliou com sucesso seu atendimento, recomende para seus amigos😊", "Sucesso"));
                    redirectBack();
                }else{
                    setSession("Avaliacao", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
                    redirectBack();
                }

              break;  
            }
        }else{
            setSession("Avaliacao", sweetAlertWarning("Esse codigo não existe 🤨", "Oops"));
            redirectBack();
        }
    }



    private function request()
    {
        $request = [
          "Codigo" => $this->codigo,
          "Nota" => $this->nota 
        ];

        if($this->validate->validate($request) != false){
 
            setSession("Avaliacao", messageWarning($this->validate->validate($request)));
            redirectBack();
            return true;
           }
    
           return false;
    }


    private function updateTotal(int $id, int $total, int $totalNota)
    {
        $soma = $total + 1;
        $total = $totalNota + $this->nota;
        $update = $this->barbeiro->update("id", $id, ["totalAvalicao" => $soma, "valorTotalNotas" => $total]);
        return $update;
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
}