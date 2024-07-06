<?php 

namespace Src\GET\Barbeiro;

use Src\Database\Model\Barbeiro as DataBarbeiro;

class Barbeiro {

    private DataBarbeiro $barbeiro;
    private int $conta;
    private int $id;
    private int $fk;
    public function __construct(string $token)
    {
        $this->barbeiro = new DataBarbeiro;
        $find = $this->barbeiro->findBy("token", $token);
        $this->conta = $find[0];
        $data = $find[1];
        $this->id = $data->id;
        $this->fk = $data->fk;
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



}