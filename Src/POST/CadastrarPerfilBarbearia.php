<?php 

namespace Src\POST;

use Src\Services\Whatsapp\Message;
use Src\Services\Datas;
use Src\Services\Validate;
use Src\Database\Model\Barbeiro;
use Src\Database\Model\Usuario;

class CadastrarPerfilBarbearia {

    private Usuario $usuario;
    private Barbeiro $barbeiro;
    private Datas $datas;
    private Validate $validate;
    private string $nome;
    private string $celular;
    private string $uf;
    private string $cidade;
    private string $cep;
    private string $bairro;
    private string $endereco;
    private string $numero;
    private string $token;
    private int $id;
    private  $avatar;

    public function __construct()
    {
        $this->usuario = new Usuario;
        $this->barbeiro = new Barbeiro;
        $this->datas = new Datas;
        $this->validate = new Validate;  
        $this->nome = $_POST['nome'];  
        $this->celular = $_POST['celular'];
        $this->uf = $_POST['uf'];
        $this->cidade = $_POST['cidade'];
        $this->cep = $_POST['cep'];
        $this->bairro = $_POST['bairro'];
        $this->endereco = $_POST['endereco'];
        $this->avatar = $_FILES['avatar'];
        $this->token = $_POST['token'];
        $this->id = $_POST['id'];
    }

    public function Result()
    {
       session_start();
       if(!$this->request() && !$this->compararTelefone()){
           $this->create();
       }
    }

    private function request()
    {

        $avatarValue = isset($this->avatar['error']) && $this->avatar['error'] === UPLOAD_ERR_NO_FILE ? null : $this->avatar;

       $request = [
          "Nome" => $this->nome,
          "Celular" => $this->celular,
          "Estado" => $this->uf,
          "Cidade" => $this->cidade,
          "Cep" => $this->cep,
          "Bairro" => $this->bairro,
          "Endereco" => $this->endereco,
          "Logo Barbearia" => $avatarValue,
       ]; 

      if($this->validate->validate($request) != false){
        setSession("CriarPerfilBarbearia", messageWarning($this->validate->validate($request)));
        redirectBack();

        return true;
      } 

       return false;
    }


    private function compararTelefone()
    {
       $select = $this->barbeiro->findBy("celular", $this->celular);
       if($select[0] > 0){
        setSession("CriarPerfilBarbearia", sweetAlertWarning("Telefone já cadastro", "Alerta"));
        redirectBack();
        return true;
       }

       return false;
    }

    private function create()
    {
       $create = $this->barbeiro->create([
        "fk" => $this->id,
        "token" => $this->token,
        "nomeBarbeiro" => $this->nome,
        "celular" => $this->celular,
        "estado" => $this->uf,
        "cidade" => $this->cidade,
        "bairro" => $this->bairro,
        "endereco" => $this->endereco,
        "avatarBarbeiro" => $this->avatar['name'],
        "status" => 1,
       ]); 
       if($create > 0){
        $this->createFolder();
        $this->updateStatusUsuario();
        $this->alertWhatsapp();
        $this->alerta($this->celular);
        setSession("CriarPerfilBarbearia", sweetAlertSuccess("Seu perfil foi criado com sucesso, você tem 30 dias para testar", "Sucesso"));
        redirectBack();
       }else{
        setSession("CriarPerfilBarbearia", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
        redirectBack();
       }
    }

    private function updateStatusUsuario()
    {
        $update = $this->usuario->update("id", $this->id, ["nivel" => 3]);
        return $update;
    }

    private function createFolder()
    {

        $select = $this->barbeiro->findBy("fk", $this->id);
        $id = $select[1]->id;
        $file = $this->avatar['tmp_name'];
        $foto = $this->avatar['name'];
        $_UP['pasta'] = "Public/img/barbeiro/$id/";
        mkdir($_UP['pasta'], 0777);
        move_uploaded_file($file, $_UP['pasta'].$foto);
    }


    private function dataAtual()
    {
       $data = $this->datas->dataAtual();
       return date("d/m/Y", strtotime($data));
    }

    private function data30dias()
    {
       $atual = $this->datas->dataAtual();
       $vencimento = $this->datas->proximoMesOuAnoCobranca($atual, 1);
       return date("d/m/Y", strtotime($vencimento));
    }


    private function alertWhatsapp()
    {

        $atual = $this->dataAtual();
        $vencimento = $this->data30dias();

        $message = "
         🚨 Alerta
         \n ✅ Barbearia Match tem um novo cliente
         \n 💈 Barbearia: {$this->nome}
         \n 🗓️ Data Inicio: $atual
         \n 🗓️ Data vencimento: $vencimento
        ";
        $zap = new Message("557991917634", $message);
        $zap->send();
    }

    private function alerta($to)
    {
       $message = "
        *Barberia Match*, Parabéns perfil *Barbearia* foi criada com *sucesso*,
         Estamos enviando essa mensagem para avisar que esse será número que irá notificar sobre a plataforma ";
       $zap = new Message($to, $message);
       $zap->send();
    }
}