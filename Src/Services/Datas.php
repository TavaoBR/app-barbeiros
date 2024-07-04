<?php 

namespace Src\Services;

class Datas {

    private $timezone;

    public function __construct($timezone = 'America/Sao_Paulo'){
      $this->timezone = $timezone;
      date_default_timezone_set($this->timezone);
    }

    public function pegarMeseAnoAtual(){
        
        $ano = date('Y');
        $mes = date('m');
        $data = array($ano, $mes);
        return $data;
    }

    public function proximoMesOuAnoCobranca($data, $qtdmes, $qtdAno = null){

        if($qtdAno == ""){
            $cal = date("Y-m-d", strtotime("+$qtdmes month", strtotime($data)));
         }else{
             $cal = date("Y-m-d", strtotime("+$qtdmes month +$qtdAno year", strtotime($data)));
         }
     
         return $cal;
    }


    public function dataAtual(){
        $data = date("Y-m-d");
        return $data;
    }

    public function horaAtual(){
        $hora = date("H:i");
        return $hora;
    }

}