<?php 

namespace Src\POST\Usuario;
use Src\Database\Model\Usuario;
use Src\Services\Validate;

class Register {

    protected $user;
    protected $validate;
    protected string $nome;
    protected string $usuario;
    protected string $mail;
    protected string $celular;
    protected string $senha;
    protected string $confirmarSenha;
    protected  $avatar;

    public function __construct()
    {
        $this->user = new Usuario;
        $this->validate = new Validate;
        $this->nome = $_POST['nome'];
        $this->usuario = $_POST['usuario'];
        $this->mail = $_POST['email'];
        $this->celular = $_POST['celular'];
        $this->avatar = $_FILES['avatar'];
        $this->senha = $_POST['senha'];
        $this->confirmarSenha = $_POST['confirmaSenha'];
    }

    public function result()
    {
       session_start();

       if(!$this->request() && !$this->validaSenha()){
          echo "Aqui";
       }
    }

    private function request()
    {
        $avatarValue = isset($this->avatar['error']) && $this->avatar['error'] === UPLOAD_ERR_NO_FILE ? null : $this->avatar;

       $request = [
        "Nome" => $this->nome,
        "Nome de usuario" => $this->usuario,
        "Senha" => $this->senha,
        "Confirma Senha" => $this->confirmarSenha,
        "Email" => $this->mail,
        "Celular" => $this->celular,
        "Avatar" => $avatarValue
       ];

      if($this->validate->validate($request) != false){

        setSession("MessageRegister", messageWarning($this->validate->validate($request)));
        redirectBack();
      
       }

       return false;
    }


    private function userName()
    {
       $select = $this->user->findBy("usuario", $this->usuario);
       return $select[0];
    }

    private function compareSenha()
    {
      if($this->senha != $this->confirmarSenha){

         return true;
      }

      return false;
    }

    private function validaSenha()
    {
       if($this->validate->validarSenha($this->senha) == false){
         setSession("MessageRegister", sweetAlertWarning("A senha não contém os comportamentos adequado", "Alerta de senha")); 
         redirectBack();
          return true;
       }

       return false;


    }

    private function create()
    {

    }

    private function uploadAvatar($id)
    {
      
    }

}