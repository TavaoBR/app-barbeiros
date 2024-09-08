<?php 

namespace Src\POST;

use Src\Database\Model\Usuario;
use Src\Services\TokenUser;
use Config\Mail;
use Src\Services\Whatsapp;
use Src\Services\Whatsapp\Link;
use Src\Services\Whatsapp\Message;

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
        session_start();
        if(!$this->request()){
            $this->logar();
        }
    }


    private function request(){
        $request = [
           "Usuario" => $this->usuario,
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

        if($find[0] == 0){
         setSession("Mensagem", sweetAlertError("Dados Inválidos"));
         redirectBack();
        }

        $dados = $find[1];
        $id = $dados->id;

        if($dados->tentativas == 5){
            /*$this->mail->from("jamesgustavo133@gmail.com")
            ->to($dados->mail)
            ->message("Seu Login foi Bloqueado por conta das inumeras tentivas de logar")
            ->template("usuario/LoginBloqueado", ["user" => $this->usuario, "id" => $id])
            ->subject("Login Bloqueado")
            ->send();*/
            $this->zap($dados->celular, $dados->token);
            setSession("Mensagem", sweetAlertError("Login Bloqueado por conta das inumeras tentivas de logar. Enviamos um link para seu Whatsapp ou E-mail com link de recuperação da conta"));
            redirectBack();
            
        }elseif($dados->senha != md5($this->senha)){
            $this->tentativasLogin($id, $dados->tentativas);
            $tentativas = 5;
            $totalTentativasRestantes = $tentativas - $dados->tentativas;
            setSession("Mensagem", sweetAlertError("Login Inválido. Restão apenas $totalTentativasRestantes"));
            redirectBack();

        }else{
          $this->token($id);
          $this->resetarTentativas($id);
          setSessions(["id" => $id, "token" => $dados->token]);
          redirect(routerConfig()."/app/perfil");

        }


     }


     private function zap($celular, $token)
     {
        $link = routerConfig()."/recuperar/conta/$token";
        $message = 
            "⚠️ Atenção
            \n 👤 Seu Login foi Bloqueado por conta das inumeras tentivas de logar
            \n 🔐 Para desbloquear clique no link"
        ;

        $enviarMessage = new Message($celular, $message);
        $enviarLink = new Link($celular, $link);
        $enviarMessage->send();
        $enviarLink->send();
     }

     public function alertaWhatsapp($celular, $token)
     {

        $link = routerConfig()."/recuperar/conta/$token";

         $message = "
            ⚠️ Atenção
            \n 👤 Seu Login foi Bloqueado por conta das inumeras tentivas de logar
            \n 🔐 Para desbloquear clique no link
            \n\n
            \n $link
         ";
         $enviar = new Whatsapp($celular, $message);

         $enviar->send();
     }
    
}