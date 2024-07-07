<?php 

namespace Src\GET\Barbeiro;

use Src\Database\Model\Barbeiro as DataBarbeiro;

class Barbeiro {

    private DataBarbeiro $barbeiro;
    private int $conta;
    private int $id;
    private int $fk;
    private string $cep;
    private string $endereco;
    private string $cidade;
    private string $estado;
    private string $bairro;
    private string $numero;
    private ?int $pontos = null;
    private ?int $avaliacao = null;

    public function __construct(string $token)
    {
        $this->barbeiro = new DataBarbeiro;
        $find = $this->barbeiro->findBy("token", $token);
        $this->conta = $find[0];
        $data = $find[1];
        $this->id = $data->id;
        $this->fk = $data->fk;
        $this->cep = $data->cep;
        $this->endereco = $data->endereco;
        $this->cidade = $data->cidade;
        $this->estado = $data->estado;
        $this->bairro = $data->bairro;
        $this->numero = $data->numero;
    }

    public function conta()
    {
      return $this->conta;
    }

    public function id()
    {
       return $this->id;
    }

    public function fk()
    {
        return $this->fk;
    }

    public function cep()
    {
        return $this->cep;
    }
    public function endereco()
    {
        return $this->endereco;
    }
    
    public function bairro()
    {
        return $this->bairro;
    }

    public function numero()
    {
        return $this->numero;
    }

    public function estado()
    {
        return $this->estado;
    }
    
    public function cidade()
    {
        return $this->cidade;
    }





}