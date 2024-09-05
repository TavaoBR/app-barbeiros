<?php 

namespace Src\POST\ProfissionalBarbearia;

use Src\Database\Model\ProfissionalBarbearia;
use Src\Services\Validate;

class Editar 
{
    private Validate $validate;
    private ProfissionalBarbearia $profissional;

    private string $nome;
    private string $celular;
    private int $status;
    private $avatar;

    public function __construct()
    {
        $this->validate = new Validate;
        $this->profissional = new ProfissionalBarbearia;
        $this->nome = $_POST['nome'];
        $this->celular = $_POST['celular'];
        $this->status = $_POST['status'];
        $this->avatar = $_FILES['avatar'];
    }

    public function Result($data)
    {
        session_start();
        if(!$this->Null()){
           $id = $data['id'];
           $this->Request($id);
        }
    }

    private function Request(int $id)
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
           if($this->update($id)){
            setSession("UpdateBarbeiro",messageSuccess($html));
            redirectBack();
           }else{
            setSession("UpdateBarbeiro", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
            redirectBack();
           }
       }else{
         setSession("UpdateBarbeiro", sweetAlertWarning("Altere pelo menos menos algum valor para alteração funcionar"));
         redirectBack();
       }
    }

    private function Null(): bool
    {
        //$avatarValue = isset($this->avatar['error']) && $this->avatar['error'] === UPLOAD_ERR_NO_FILE ? null : $this->avatar;
        
        $data = [
          "Nome" => $this->nome,
          "Celular" => $this->celular,
          "Status" => $this->status
        ]; 

        if($this->validate->validate($data) != false){
 
            setSession("UpdateBarbeiro", messageWarning($this->validate->validate($data)));
            redirectBack();
            return true;
           }
    
           return false;
    }

    private function dadosNovos(): array
    {
       if($this->avatar['error']){
        $data = [
          "nome" => $this->nome,
          "celular" => $this->celular,
          "status" => $this->status
        ];
       }else{
        $data = [
            "nome" => $this->nome,
            "celular" => $this->celular,
            "status" => $this->status,
            "avatar" => $this->avatar['name']
        ];

       } 
      

       return $data;
    }

    private function dadosAntigos(int $id): array
    {
        $select = $this->profissional->findBy("id", $id);
        $dados = $select[1];

        $data = [
          "nome" => $dados->nome,
          "celular" => $dados->celular,
          "avatar" => $dados->avatar,
          "status" => $dados->status,
        ];

        return $data;
    }

    private function update(int $id): bool
    {
        if($this->avatar['error']){
           $update = $this->profissional->update("id", $id, [
                "nome" => $this->nome,
                "celular" => $this->celular,
                "status" => $this->status 
           ]);
        }else{
            $foto = $this->avatar['name'];
            $update = $this->profissional->update("id", $id, [
                "nome" => $this->nome,
                "celular" => $this->celular,
                "status" => $this->status,
                "avatar" => $foto 
            ]);
        }

        if($update > 0){
            if(!$this->avatar['error']){
               $this->folder($id);
            }
            return true;
        }else{
            return false;
        }
        
    }

    private function folder(int $id)
    {
        $file = $this->avatar['tmp_name'];
        $foto = $this->avatar['name'];
        move_uploaded_file($file, "Public/img/barbeiro/profissional/$id/$foto");
    }
}