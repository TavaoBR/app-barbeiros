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
    }

    public function result()
    {
       session_start();

       if(!$this->request()){
          echo "Aqui";
       }
    }

    private function request()
    {
        $avatarValue = isset($this->avatar['error']) && $this->avatar['error'] === UPLOAD_ERR_NO_FILE ? null : $this->avatar;

       $request = [
        "Nome de usuario" => $this->usuario,
        "Nome" => $this->nome,
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
      
    }

    private function create()
    {

    }

    private function uploadAvatar($id)
    {
      
    }

}