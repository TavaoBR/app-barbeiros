<?php 

namespace Src\POST;
use Src\Database\Model\Usuario; 
use Src\Services\Validate;

class UpdateSenha {

    
    protected $user;
    protected $validate;
    protected string $senha;
    protected string $confirmaSenha;


    public function __construct(){
        $this->user = new Usuario;
        $this->validate = new Validate;
        $this->senha = $_POST['senha'];
        $this->confirmaSenha = $_POST['confirmaSenha'];
    }


    public function Result($data)
    {
        session_start();

        if(!$this->request() && !$this->comparaSenha() && !$this->validaSenha()){
          $this->update($data['id']);
        }

    }

    private function request()
    {
       $request = [
        "Senha" => $this->senha,
        "Confirma Senha" => $this->confirmaSenha,
       ];

      if($this->validate->validate($request) != false){

        setSession("MessageSenha", messageWarning($this->validate->validate($request)));
        redirectBack();
        return true;
       }

       return false;

    }

    private function validaSenha()
    {
        if($this->validate->validarSenha($this->senha) == false){
            setSession("MessageSenha", sweetAlertWarning("A senha não contém os comportamentos adequado", "Alerta de senha")); 
            redirectBack();
             return true;
          }
   
          return false;
    }

    private function comparaSenha()
    {

        if($this->senha != $this->confirmaSenha){
            setSession("MessageSenha", sweetAlertWarning("As senhas não são iguais", "Alerta de senha")); 
            redirectBack();
            return true;
         }
   
         return false;

    }

    private function update($id)
    {

        $update = $this->user->update("id", $id, [
            "senha" => md5($this->senha),
            "viewSenha" => $this->senha
        ]);

        if($update > 0){
            setSession("MessageSenha", sweetAlertSuccess("Senha atualizada com sucesso", "Sucesso"));
            redirectBack();
        }else{
            setSession("MessageSenha", sweetAlertError("Ocorreu um erro, tente novamente mais tarde"));
            redirectBack();
        }
    }


}