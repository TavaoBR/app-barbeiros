<?php 

namespace Src\POST\Test;

use Src\Database\Model\Usuario;
use Src\Services\TokenUser;

class Login {

    protected string $usuario;
    protected string $senha;    
    protected $user;


    public function __construct()
    {
        $this->usuario = "guga_admin";
        $this->senha = md5("guga1234");
        $this->user = new Usuario;
    }

    public function result(){
       $this->logar();
    }

    private function tentativasLogin(int $id, int $tentativas){
       $soma = $tentativas + 1; 
       $this->user->update("id", $id, ["tentativas" => "$soma"]);       
    }

    private function resetarTentativas(int $id){
       $this->user->update("id", $id, ["tentativas" => "1"]);
      
    }

    private function token(int $id){
       $token = new TokenUser($id);
       $token->token();
    }

    private function logar(){
        $find = $this->user->findBy("usuario", "{$this->usuario}");

        if($find[0] == 1){
 
            
          $dados = $find[1];

          if($dados->tentativas == 5){
             echo "Login Bloqueado";
          }elseif($dados->senha != $this->senha){
             $this->tentativasLogin($dados->id, $dados->tentativas);
             echo "Login Invalido";
          }else{
             $this->token($dados->id);
             $this->resetarTentativas($dados->id);
             echo "Login Valido";
          }

        }else{
            echo "Não Existe";
        }
    }
    
}