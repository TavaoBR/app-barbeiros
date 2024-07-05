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

       if(!$this->request() && !$this->validaSenha() && !$this->compareSenha() && !$this->userName() && !$this->userEmail()){
          $this->create();
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
       if($select[0] == 1){
         setSession("MessageRegister", sweetAlertWarning("Nome de usuario já cadastrado", "Alerta de usuario")); 
         redirectBack();
         return true;
       }

       return false;
    }

    private function userEmail()
    {
      $select = $this->user->findBy("email", $this->mail);
      if($select[0] > 0){
        setSession("MessageRegister", sweetAlertWarning("E-mail já cadastrado", "Alerta de usuario")); 
        redirectBack();
        return true;
      }

      return false;
    }

    private function compareSenha()
    {
      if($this->senha != $this->confirmarSenha){
         setSession("MessageRegister", sweetAlertWarning("As senhas não são iguais", "Alerta de senha")); 
         redirectBack();
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
       $create = $this->user->create([
          "nome" => $this->nome,
          "usuario" => $this->usuario,
          "email" => $this->mail,
          "celular" => $this->celular,
          "senha" => md5($this->senha),
          "viewSenha" => $this->senha,
          "avatar" => $this->avatar['name'],
          "nivel" => 2
       ]);

       if($create > 0){
         $select = $this->user->findBy("usuario", $this->usuario);
         $id = $select[1]->id;
         $this->uploadAvatar($id);
         setSession("Mensagem", sweetAlertSuccess("Agora faça o login com sua conta", "Cadastro realizado"));
         redirect(routerConfig()."/login");
       }else{
        setSession("MessageRegister", sweetAlertWarning("Parece que você já solicitou acesso ao plataforma como barbeiro", "Alerta")); 
        redirectBack();
       }
    }

    private function uploadAvatar($id)
    {

      $file = $this->avatar['tmp_name'];
      $foto = $this->avatar['name'];
      $_UP['pasta'] = "Public/img/avatar/$id/";
      mkdir($_UP['pasta'], 0777);
      move_uploaded_file($file, $_UP['pasta'].$foto);
      
    }

}