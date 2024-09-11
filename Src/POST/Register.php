<?php 

namespace Src\POST;

use Src\Database\Model\Usuario;
use Src\Services\Validate;
use Src\Services\Whatsapp\Message;

class Register 
{
    private Usuario $model;
    private Validate $validate;
    private string $nome;
    private string $usuario;
    protected string $uf;
    protected string $cidade;
    private string $mail;
    private string $celular;
    private string $senha;
    private string $confirmarSenha;
    private  $avatar;
    public function __construct()
    {
        $this->model = new Usuario;
        $this->validate = new Validate;
        $this->nome = $_POST['nome'];
        $this->usuario = $_POST['usuario'];
        $this->uf = $_POST['uf'];
        $this->cidade = $_POST['cidade'];
        $this->mail = $_POST['email'];
        $this->celular = $_POST['celular'];
        $this->avatar = $_FILES['avatar'];
        $this->senha = $_POST['senha'];
        $this->confirmarSenha = $_POST['confirmaSenha'];
    }

    public function Result()
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
         "Estado" => $this->uf,
         "Cidade" => $this->cidade,
         "Avatar" => $avatarValue
        ];
 
       if($this->validate->validate($request) != false){
 
         setSession("MessageRegister", messageWarning($this->validate->validate($request)));
         redirectBack();
         return true;
        }
 
        return false;
    }

    private function userName()
    {
       $select = $this->model->findBy("usuario", $this->usuario);
       if($select[0] == 1){
         setSession("MessageRegister", sweetAlertWarning("Nome de usuario já cadastrado", "Alerta de usuario")); 
         redirectBack();
         return true;
       }

       return false;
    }

    private function userEmail()
    {
      $select = $this->model->findBy("email", $this->mail);
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
       $create = $this->model->create([
          "nome" => $this->nome,
          "usuario" => $this->usuario,
          "uf" => $this->uf,
          "cidade" => $this->cidade,
          "email" => $this->mail,
          "celular" => $this->celular,
          "senha" => md5($this->senha),
          "viewSenha" => $this->senha,
          "avatar" => $this->avatar['name'],
          "tentativas" => 1,
          "nivel" => 2
       ]);

       if($create > 0){
         $select = $this->model->findBy("usuario", $this->usuario);
         $id = $select[1]->id;
         $this->uploadAvatar($id);
         $this->alerta($this->celular);
         setSession("Mensagem", sweetAlertSuccess("Agora faça o login com sua conta", "Cadastro realizado"));
         redirect(routerConfig()."/login");
       }else{
         setSession("MessageRegister", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
         redirectBack();
       }
    }

    private function alerta($to)
    {
       $message = "
        *Barberia Match*, Parabéns sua *conta* foi criada com *sucesso*,
         Estamos enviando essa mensagem para avisar que esse será número que irá notificar sobre a plataforma 
       ";
       $zap = new Message($to, $message);
       $zap->send();
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