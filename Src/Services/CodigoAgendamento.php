<?php

namespace Src\Services;

class CodigoAgendamento
{

    private string $carecter;
    private string $sequencia =  "";
    private string $length;
    private string $codigo = "";

    public function __construct()
    {
       $this->carecter = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
       $this->length = 7;
       $this->codigo = $this->gerar();
    }   

    private function verificaNumeroGerado(): bool
    {
       $verifica = codigoGeradoAgendamento($this->codigo);
       return $verifica[0] === 1;
    }

    private function gerar(): string 
    {
       do{
        $this->sequencia = "";
        for($i = 0; $i < $this->length; $i++){
            $this->sequencia .= $this->carecter[rand(0, strlen($this->carecter) - 1)]; 
         }

         $this->codigo = $this->sequencia;

       }while($this->verificaNumeroGerado()); 
       
       return $this->sequencia;
    }

    public function result(): string 
    {
        return $this->codigo;
    }
    
}