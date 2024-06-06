<?php 

namespace Src\POST\Usuario;

use Src\Database\Model\Usuario;
use Src\Services\TokenUser;
use Config\Mail;

class Login {

    protected string $usuario;
    protected string $senha;
    protected $user;
    protected $mail;

    public function __construct()
    {
        $this->usuario = $_POST['usuario'];
        $this->senha = $_POST['senha'];
        $this->user = new Usuario;
        $this->mail = new Mail;
    }

    public function result(){

    }


    private function request(){
        $request = [
           "Nome de Usuario" => $this->usuario,
           "Senha" => $this->senha
        ];

        $html = "
        <ol>";

        $camposEmBranco = false;

        foreach ($request as $data => $value) {
            if (!isset($value) || empty($value)) {
                $camposEmBranco = true;
                $html .= "
                
                 <li>O campo <strong>'$data'</strong> está em branco. Por favor, preencha esse campo.<br></li>
                
                ";
            }
        }

        $html .= "</ol>";

        if($camposEmBranco){
            setSessions([ "Mensagem" => messageWarning($html), "userForm" => $this->usuario, "senhaForm" => $this->senha]);
            redirectBack();
            return true;
          }
  
          return false;

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

        $find = $this->user->findBy("usuario", $this->usuario);

        if($find[0] == 1){
         setSession("Mensagem", "Dados Invalidos");
        }

        $dados = $find[1];
        $id = $dados->id;

     }
    
}