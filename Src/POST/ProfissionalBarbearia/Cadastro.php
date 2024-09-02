<?php

namespace Src\POST\ProfissionalBarbearia;

use Src\Database\Model\ProfissionalBarbearia;
use Src\Services\Validate;

class Cadastro {

    private ProfissionalBarbearia $profissional;
    private Validate $validate;
    private string $nome;
    private string $celular;
    private int $status;
    private $avatar;

    public function __construct()
    {
        $this->profissional = new ProfissionalBarbearia;
        $this->validate = new Validate;
        $this->nome = $_POST['nome'];
        $this->celular = $_POST['celular'];
        $this->status = $_POST['status'];
        $this->avatar = $_FILES['avatar'];
    }

    public function Result($data)
    {
        session_start();
        if(!$this->request() && !$this->profissionalCadastrado()){
            $this->create($data['id']);
        }
    }

    private function request()
    {

        $avatarValue = isset($this->avatar['error']) && $this->avatar['error'] === UPLOAD_ERR_NO_FILE ? null : $this->avatar;
        
        $data = [
          "Nome" => $this->nome,
          "Celular" => $this->celular,
          "Status" => $this->status,
          "Avatar" => $avatarValue
        ]; 

        if($this->validate->validate($data) != false){
           setSession("CadastroPro", messageWarning($this->validate->validate($data)));
           redirectBack();
           return true;
        }

        return false;

    }

    private function create(int $id)
    {
        $create = $this->profissional->create([
           "fk" => $id,
           "nome" => $this->nome,
           "celular" => $this->celular,
           "avatar" => $this->avatar['name'],
           "status" => $this->status
        ]);

        if($create > 0){
          $idPro = $this->select()->id;
          $this->createFolderAvatar($idPro);
          setSession("CadastroPro", sweetAlertSuccess("Profissional cadastro, faça o cadastro de outro profissional, caso tenha", "Cadastro realizado"));
          redirectBack();
        }else{
            setSession("CadastroPro", sweetAlertError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
            redirectBack();
        }
    }

    private function select()
    {
      $select = $this->profissional->findBy("celular", $this->celular);
      return $select[1];
    }

    private function profissionalCadastrado()
    {
        $select = $this->profissional->findBy("celular", $this->celular);
        
        if($select[0] > 0){
           setSession("CadastroPro", sweetAlertError("Profissional já cadastrado"));
           redirectBack(); 
          return true;
        }

        return false;
    }

    private function createFolderAvatar(int $id)
    {
        $file = $this->avatar['tmp_name'];
        $foto = $this->avatar['name'];
        $_UP['pasta'] = "Public/img/barbeiro/profissional/$id/";
        mkdir($_UP['pasta'], 0777);
        move_uploaded_file($file, $_UP['pasta'].$foto);
    }

}