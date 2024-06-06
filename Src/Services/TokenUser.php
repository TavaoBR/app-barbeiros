<?php

namespace Src\Services;

use Src\Database\Model\Usuario;

class TokenUser {
  
    private $usuario;
    private int $id;

    public function __construct(int $id){
        $this->usuario = new Usuario;
        $this->id = $id;
    }

    private function verificaTokenExiste(){
        $token = $this->gerarToken();
        return $this->usuario->findBy("token", $token);
    }

    private function verificaseUsuarioTokenExiste(){
        return $this->usuario->findBy("id", $this->id);
    }

    private function gerarToken(){
        $uuid = bin2hex(random_bytes(16));
        $token = sprintf(
            "%s-%s-%s-%s-%s",
            substr($uuid, 0, 8),
            substr($uuid, 8, 4),
            substr($uuid, 12, 4),
            substr($uuid, 16, 4),
            substr($uuid, 20)
        );

        return $token;
    } 

    private function atualizarToken(){
        $token = $this->gerarToken();
        $this->usuario->update("id", $this->id, ["token" => $token]);
    }

    public function token(){
       if($this->verificaTokenExiste()[0] == 0 && $this->verificaseUsuarioTokenExiste()[1]->token == ""){
          $this->atualizarToken();
       }
    }

}