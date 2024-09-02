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

    }

    private function Request(int $id)
    {

    }

    private function Null(): bool
    {
        $avatarValue = isset($this->avatar['error']) && $this->avatar['error'] === UPLOAD_ERR_NO_FILE ? null : $this->avatar;
        
        $data = [
          "Nome" => $this->nome,
          "Celular" => $this->celular,
          "Status" => $this->status,
          "Avatar" => $avatarValue
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
       $data = [
          
       ];

       return $data;
    }

    private function dadosAntigos(int $id): array
    {
        $select = $this->profissional->findBy("id", $id);
        $dados = $select[1];

        $data = [

        ];

        return $data;
    }

    private function update(int $id): bool
    {
        if($this->avatar['error']){
           $update = $this->profissional->update("id", $id, []);
        }else{
            $foto = $this->avatar['name'];
            $update = $this->profissional->update("id", $id, []);
        }

        return true;
    }
}