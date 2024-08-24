<?php 

namespace Src\POST;
use Src\Database\Model\AgendaBarbeiro;
use Src\Database\Model\Barbeiro;

class Atendimento {

    private AgendaBarbeiro $agenda;
    private Barbeiro $barbeiro;
    private string $codigo;

    public function __construct()
    {
       $this->codigo = $_POST['codigo'];
    }

    public function confirmarPresenca()
    {
        echo $this->codigo;
    }

    public function cancelarPresenca()
    {
        echo $this->codigo;
    }

    private function alertaWhatsapp(string $mesagem, string $celular)
    {

    }
}