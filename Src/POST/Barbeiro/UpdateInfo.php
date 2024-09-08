<?php

namespace Src\POST\Barbeiro;
use Src\Database\Model\ServicoBarbeiro;
use Src\Database\Model\Barbeiro;
use Src\Services\Validate;

class UpdateInfo
{
    private Barbeiro $barbeiro;  
    private Validate $validate;
    private string $nome;
    private string $celular;
    private string $uf;
    private string $cidade;
    private string $bairro;
    private string $endereco;
    private $avatar;

    public function __construct()
    {
        $this->barbeiro = new Barbeiro;
        $this->validate = new Validate;
        $this->nome = $_POST['nome'];  
        $this->celular = $_POST['celular'];
        $this->uf = $_POST['uf'];
        $this->cidade = $_POST['cidade'];
        $this->bairro = $_POST['bairro'];
        $this->endereco = $_POST['endereco'];
        $this->avatar = $_FILES['avatar'];
    }

    public function Result($data)
    {
        session_start();
        if(!$this->Null()){
            $id = $data['id'];
            $this->request($id);
        }
    }

    private function request(int $id): void
    {
        $html = "<ol>";
        $diferencasEncontradas = false;
        $html .= "<li> Alterações concluídas com sucesso </li>";

        $dadosAntigos = $this->dadosAntigos($id);
        $dadosNovos = $this->dadosNovos();

        foreach ($dadosNovos as $campo => $valorNovo) {
            if (isset($dadosAntigos[$campo]) && $dadosAntigos[$campo] !== $valorNovo) {
                $diferencasEncontradas = true;
                $valorAntigo = $dadosAntigos[$campo];
                $html .= "<li><strong>'$campo'</strong> foi atualizado de <strong>'$valorAntigo'</strong> para <strong>'$valorNovo'</strong>.<br></li>";
            }
        }
    
       $html .= "</ol>";

       if($diferencasEncontradas){
         $this->update($id, $html);
       }else{
        setSession("UpdatePerfilBarbearia", sweetAlertWarning("Altere pelo menos menos algum valor para alteração funcionar"));
        redirectBack();
       }
    }

    private function Null(): bool
    {
        $data = [
            "Nome Barbearia" => $this->nome,
            "Celular Barbearia" => $this->celular,
            "Estado" => $this->uf,
            "Cidade" => $this->cidade,
            "Bairro" => $this->bairro,
            "Endereco" => $this->endereco 
        ]; 

        if($this->validate->validate($data) != false){
 
            setSession("UpdatePerfilBarbearia", messageWarning($this->validate->validate($data)));
            redirectBack();
            return true;
           }
    
           return false;
    }

    private function dadosNovos(): array
    {

      if($this->avatar['error']){
        $data = [
         "Nome Barbearia" => $this->nome,
         "Celular Barbearia" => $this->celular,
         "Estado" => $this->uf,
         "Cidade" => $this->cidade,
         "Bairro" => $this->bairro,
         "Endereço" => $this->endereco,
        ];
      }else{
        $data = [
            "Nome Barbearia" => $this->nome,
            "Celular Barbearia" => $this->celular,
            "Estado" => $this->uf,
            "Cidade" => $this->cidade,
            "Bairro" => $this->bairro,
            "Endereço" => $this->endereco,
            "Avatar" => $this->avatar['name']
        ];
      }
       
       
       return $data;
    }

    private function dadosAntigos(int $id): array
    {
       $select = $this->barbeiro->findBy("id", $id);
       $dados = $select[1];

       $data = [
         "Nome Barbearia" => $dados->nomeBarbeiro,
         "Celular Barbearia" => $dados->celular,
         "Estado" => $dados->estado,
         "Cidade" => $dados->cidade,
         "Bairro" => $dados->bairro,
         "Endereço" => $dados->endereco,
         "Avatar" => $dados->avatarBarbeiro
       ];

       return $data;
    }

    private function update(int $id, $html): void
    {
       if($this->avatar['error']){
         $update = $this->barbeiro->update("id", $id, ["nomeBarbeiro" => $this->nome, "celular" => $this->celular, "estado" => $this->uf, "cidade" => $this->cidade, "bairro" => $this->bairro, "endereco" => $this->endereco]);
       }else{
        $foto = $this->avatar['name'];
        $update = $this->barbeiro->update("id", $id, ["nomeBarbeiro" => $this->nome, "celular" => $this->celular, "estado" => $this->uf, "cidade" => $this->cidade, "bairro" => $this->bairro, "endereco" => $this->endereco, "avatarBarbeiro" => $foto]);
       }

       if($update > 0){
         !$this->folder($id);
         setSession("UpdatePerfilBarbearia",messageSuccess($html));
         redirectBack();
       }else{
        setSession("UpdatePerfilBarbearia", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
        redirectBack();
       }
    }

    private function folder(int $id): bool
    {
       if(!$this->avatar["error"]){
          $file = $this->avatar['tmp_name'];
          $foto = $this->avatar['name'];
          move_uploaded_file($file, "Public/img/barbeiro/$id/$foto");
          return true;
       }

       return false;
    }
}