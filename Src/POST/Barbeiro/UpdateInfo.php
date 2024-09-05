<?php

namespace Src\POST\Barbeiro;
use Src\Database\Model\ServicoBarbeiro;
use Src\Database\Model\Barbeiro;
use Src\Services\Validate;

class UpdateInfo
{
    private Barbeiro $barbeiro;  
    private Validate $validate;
    private string $nome;
    private string $celular;
    private string $uf;
    private string $cidade;
    private string $bairro;
    private string $endereco;
    private string $numero;
    private $avatar;

    public function __construct()
    {
        $this->barbeiro = new Barbeiro;
        $this->validate = new Validate;
        $this->nome = $_POST['nome'];  
        $this->celular = $_POST['celular'];
        $this->uf = $_POST['uf'];
        $this->cidade = $_POST['cidade'];
        $this->bairro = $_POST['bairro'];
        $this->endereco = $_POST['endereco'];
        $this->numero = $_POST['numero'];
    }

    public function Result($data)
    {

    }

    private function request(int $id)
    {

    }

    private function Null()
    {
        $data = [
            "Nome Barbearia" => $this->nome,
            "Celular Barbearia" => $this->celular,
            "Estado" => $this->uf,
            "Cidade" => $this->cidade,
            "Bairro" => $this->bairro,
            "Endereco" => $this->endereco 
        ]; 

        if($this->validate->validate($data) != false){
 
            setSession("UpdatePerfilBarbearia", messageWarning($this->validate->validate($data)));
            redirectBack();
            return true;
           }
    
           return false;
    }

    private function dadosNovos()
    {

    }

    private function dadosAntigos(int $id)
    {

    }

    private function update(int $id)
    {

    }

    private function folder(int $id)
    {

    }
}