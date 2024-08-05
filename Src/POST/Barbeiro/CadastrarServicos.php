<?php 

namespace Src\POST\Barbeiro;

use Src\Database\Model\ServicoBarbeiro;
use Src\Services\Validate;

class CadastrarServicos {
    
    private ServicoBarbeiro $servico;
    private Validate $validate;
    private string $nome;
    private float $valor;
    private string $descricao;

    public function __construct()
    {
       $this->servico = new ServicoBarbeiro; 
       $this->validate = new Validate;
       $this->nome = $_POST['nome'];
       $this->valor = (float)$_POST['valor'];
       $this->descricao = $_POST['descricao'];
    }

    public function Result($data)
    {
         session_start();
         if(!$this->request()){
            $this->create($data['id']);
         }
    }

    private function request()
    {
        $request = [
            "Nome do serviço" => $this->nome,
            "Valor do serviço" => $this->valor,
            "Descrição do serviço" => $this->descricao 
          ];

          if($this->validate->validate($request) != false){
             setSession("Message", messageWarning($this->validate->validate($request)));
             redirectBack();
            return true;
         }
         return false;
    }


    private function create($id)
    {
         $create = $this->servico->create([
            "fk" => $id,
            "nome" => $this->nome,
            "valor" => $this->valor,
            "descricao" => $this->descricao,
         ]);

         if($create > 0){
            setSession("Message", sweetAlertSuccess("Serviço Cadastrado", "Sucesso"));
            redirectBack();
         }else{
            setSession("Message", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
            redirectBack();
         }
    }
}