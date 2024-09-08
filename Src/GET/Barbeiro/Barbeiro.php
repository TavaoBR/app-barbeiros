<?php 

namespace Src\GET\Barbeiro;

use Src\Database\Model\Barbeiro as DataBarbeiro;

class Barbeiro {

    private DataBarbeiro $barbeiro;
    private int $conta;
    private int $id;
    private int $fk;
    private string $nome;
    private string $celular;
    private string $avatar;
    private ?string $cep = null;
    private string $endereco;
    private string $cidade;
    private string $estado;
    private string $bairro;
    private ?string $numero = null;
    private ?int $pontos = null;
    private ?int $valorTotalNotas = null;
    private ?int $totalAvalicao = null;
    private ?int $online = null;
    private string $token;

    public function __construct(string $token)
    {
        $this->barbeiro = new DataBarbeiro;
        $find = $this->barbeiro->findBy("token", $token);
        $this->conta = $find[0];
        $data = $find[1];
        $this->id = $data->id;
        $this->fk = $data->fk;
        $this->nome = $data->nomeBarbeiro;
        $this->celular = $data->celular;
        $this->avatar = $data->avatarBarbeiro;
        $this->endereco = $data->endereco;
        $this->cidade = $data->cidade;
        $this->estado = $data->estado;
        $this->bairro = $data->bairro;
        $this->online = $data->online;
        $this->token = $data->token;
        $this->valorTotalNotas = $data->valorTotalNotas;
        $this->totalAvalicao = $data->totalAvalicao;
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

    public function nome()
    {
       return $this->nome;
    }

    public function celular()
    {
        return $this->celular;
    }

    public function avatar()
    {
       return $this->avatar;
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

    public function online()
    {
        return $this->online;
    }

    public function token()
    {
        return $this->token;
    }

    public function totalAvalicao()
    {
        return $this->totalAvalicao;
    }

    public function valorTotalNotas()
    {
        return $this->valorTotalNotas;
    }



}