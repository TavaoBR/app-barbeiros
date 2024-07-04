<?php 

namespace Src\POST\Usuario;

use Config\TelegramBot;
use Src\Database\Model\AcessoBarbeiro;
use Src\Services\Datas;
use Src\Services\Validate;

class solicitarAcessoBarbeiro {

    private Datas $datas;
    private AcessoBarbeiro $acesso;
    private Validate $validate;
    private string $nome;
    private string $mail;
    private string $celular;
    private string $uf;
    private string $cidade;
    private string $cep;
    private string $bairro;
    private string $endereco;
    private string $numero;
    private string $plano;

    public function __construct()
    {
       $this->datas = new Datas;
       $this->validate = new Validate;  
       $this->acesso = new AcessoBarbeiro;
       $this->nome = $_POST['nome'];  
       $this->mail = $_POST['email'];
       $this->celular = $_POST['celular'];
       $this->uf = $_POST['uf'];
       $this->cidade = $_POST['cidade'];
       $this->cep = $_POST['cep'];
       $this->bairro = $_POST['bairro'];
       $this->endereco = $_POST['endereco'];
       $this->numero = $_POST['numero'];
       $this->plano = $_POST['plano'];

    }

    public function result($data)
    {
        session_start();
        if(!$this->request() && !$this->verificaSeUsuarioJaFezSolicitacao($data['id'])){
            $this->create($data['id']);
        }
    }

    private function request()
    {
       $request = [
          "Nome" => $this->nome,
          "E-mail" => $this->mail,
          "Celular" => $this->celular,
          "Estado" => $this->uf,
          "Cidade" => $this->cidade,
          "Cep" => $this->cep,
          "Bairro" => $this->bairro,
          "Endereco" => $this->endereco,
          "Número da casa" => $this->numero,
          "Plano" => $this->plano,
       ]; 

      if($this->validate->validate($request) != false){
        setSession("MessageRegister", messageWarning($this->validate->validate($request)));
        redirectBack();

        return true;
      } 

       return false;
    }

    private function create($id)
    {

        $create = $this->acesso->create([
            "nome" => $this->nome,
            "fk" => $id,
            "email" => $this->mail,
            "celular" => $this->celular,
            "uf" => $this->uf,
            "cidade" => $this->cidade,
            "cep" => $this->cep,
            "bairro" => $this->bairro,
            "endereco" => $this->endereco,
            "numero" => $this->numero,
            "plano" => $this->plano,
            'data' => $this->datas->dataAtual(),
            "status" => 1
        ]);

        if($create > 0){
          $this->alertaBot($id);
          setSession("MessageRegister",sweetAlertSuccess("Sua Solicitação foi enviada, agora aguarde a equipe entrar em contato com você","Solicitação Enviada"));
          redirectBack();
        }else{
            setSession("MessageRegister", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
            redirectBack();
        }
    }

    private function verificaSeUsuarioJaFezSolicitacao($id)
    {
       $select = $this->acesso->findBy("fk", $id);

       if($select[0] > 0){
          $status = $select[1]->status;
          
          if($status == 1){
           setSession("MessageRegister", sweetAlertWarning("Parece que você já solicitou acesso ao plataforma como barbeiro", "Alerta")); 
           redirectBack();
           return true;
          }

       }

       return false;
    }


    private function alertaBot($id){
        
        $data = $this->datas->dataAtual();

        $message = "
          🧏 Nova solicitação Barbeiro:
          \n 🔢 Id: $id
          \n 📆 Data: $data
          \n 👨‍💻 Nome: {$this->nome}
          \n 📋 Plano: {$this->plano}
        ";

        $bot = new TelegramBot($_ENV['TELEGRAM_TOKEN'], $_ENV['TELEGRAM_ID_CHAT'], $message);

        return $bot->send();
    }
}