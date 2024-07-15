<?php 

namespace Src\POST\Usuario;

use Src\Database\Model\Usuario;
use Src\Services\Whatsapp; 

class RecuperarConta {

    private Usuario $user;

    public function __construct()
    {
        $this->user = new Usuario;
    }

    public function Recuperar($data)
    {
       session_start();
       $senha = gerarSenha(12);
       $select = $this->user->findBy("id", $data['id']);
       $dados = $select[1];
       $update = $this->user->update("id", $data['id'], [
         "senha" => md5($senha),
         "viewSenha" => $senha,
         "tentativas" => 1
       ]);

       if($update > 0){
            $this->alertaWhatsapp($dados->celular, $dados->usuario, $senha);
            setSession("Mensagem", sweetAlertSuccess("Sua conta foi recuperada, enviamos seu usuario e senha de acesso para seu whatsapp", "Sucesso"));
            redirect(routerConfig()."/login");
       }else{
            setSession("Message", sweetAlertWarning("Parece que você já solicitou acesso ao plataforma como barbeiro", "Alerta")); 
            redirectBack();
       }
    }


    private function alertaWhatsapp($to, $usuario, $senha)
    {
       $message = "✅ Sucesso
       \n  Sua conta foi recuperada
       \n seu usuario: $usuario
       \n nova senha: $senha
       ";
       $enviar = new Whatsapp($to, $message);
       $enviar->send();
    }
}