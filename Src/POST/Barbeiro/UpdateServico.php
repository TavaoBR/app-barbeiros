<?php

namespace Src\POST\Barbeiro;
use Src\Database\Model\ServicoBarbeiro;
use Src\Services\Validate;


class UpdateServico
{
    private ServicoBarbeiro $servico;
    private Validate $validate;
    private string $nome;
    private float $valor;

    public function __construct()
    {
       $this->servico = new ServicoBarbeiro; 
       $this->validate = new Validate;
       $this->nome = $_POST['nome'];
       $this->valor = (float)$_POST['valor'];
    }


    public function Result($data)
    {
       session_start(); 
       if(!$this->Null()){
           $this->request($data['id']);
       }
    }

    private function request(int $id)
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
    
        if ($diferencasEncontradas) {
            if($this->update($id)){
               setSession("UpdateService", messageSuccess($html));
               redirectBack();
            }else{
               setSession("UpdateService", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
               redirectBack();
            } 
        }else {
            setSession("UpdateService", messageWarning("Altere pelo menos algum valor para alteração funcionar"));
           redirectBack();
        }
    }

    private function Null()
    {
        $data = [
            "Nome do Serviço" => $this->nome,
            "Valor do Serviço" => $this->valor 
        ];

        if($this->validate->validate($data) != false){
 
            setSession("UpdateService", messageWarning($this->validate->validate($data)));
            redirectBack();
            return true;
           }
    
           return false;

        
    }

    private function dadosNovos(): array
    {
        $data = [
            "nome" => $this->nome,
            "valor" => $this->valor,
        ];

        return $data;
    }

    private function dadosAntigos(int $id): array
    {
        $select = $this->servico->findBy("id", $id);
        $dados = $select[1];

        $data = [
          "nome" => $dados->nome,
          "valor" => $dados->valor
        ];

        return $data;
    }

    private function update(int $id): bool
    {
       $update = $this->servico->update("id", $id, ["nome" => $this->nome, "valor" => $this->valor]);

       if($update > 0){
          return true;
       }else{
        return false;
       }
    }

}