<?php 

namespace Src\POST;

use Src\Database\Model\Usuario;

class UpdateInfo {

    protected $user;
    protected string $nome;
    protected string $usuario;
    protected string $mail;
    protected string $celular;
    protected string $uf;
    protected string $cidade;
    protected  $avatar;

    public function __construct()
    {
        $this->user = new Usuario;
        $this->nome = $_POST['nome'];
        $this->usuario = $_POST['usuario'];
        $this->mail = $_POST['email'];
        $this->celular = $_POST['celular'];
        $this->uf = $_POST['uf'];
        $this->cidade = $_POST['cidade'];
        $this->avatar = $_FILES['avatar'];
    }

     
    public function Result($data)
    {
       session_start();
       $this->request($data['id']);
    }

    private function request($id)
    {
        $select = $this->user->findBy("id", $id);
        $dados = $select[1];

        if(!$this->avatar['error']){
            $novosDados = [
                "nome" => $this->nome,
                "usuario" => $this->usuario,
                "email" => $this->mail,  
                "celular" => $this->celular,
                "uf" => $this->uf,
                "cidade" => $this->cidade,
                "avatar" => $this->avatar['name']
            ];

            $antigosDados = [
                "nome" => $dados->nome,
                "usuario" => $dados->usuario,
                "email" => $dados->email,  
                "celular" => $dados->celular,
                "uf" => $dados->uf,
                "cidade" => $dados->cidade,
                "avatar" => $dados->avatar
            ];
        }else{

            $novosDados = [
                "nome" => $this->nome,
                "usuario" => $this->usuario,
                "email" => $this->mail,  
                "celular" => $this->celular,
                "uf" => $this->uf,
                "cidade" => $this->cidade
            ];

            $antigosDados = [
                "nome" => $dados->nome,
                "usuario" => $dados->usuario,
                "email" => $dados->email,  
                "celular" => $dados->celular,
                "uf" => $dados->uf,
                "cidade" => $dados->cidade
            ];
            
        }


        


        /*echo "<pre>";
        print_r($novosDados);
        print_r($antigosDados);
        echo "</pre>";*/

        $html = "<ol>";
        $diferencasEncontradas = false;
        $html .= "<li> Alterações concluidas com sucesso </li>";
        foreach($novosDados as $campo => $valorNovo){
            if(isset($antigosDados[$campo]) && $antigosDados[$campo] != $valorNovo){
                $diferencasEncontradas = true;
                $valorAntigo = $antigosDados[$campo];
                $html .= "<li>O campo <strong>'$campo'</strong> foi atualizado de <strong>'$valorAntigo'</strong> para <strong>'$valorNovo'</strong>.<br></li>";
            }
        }

        
        $html .= "</ol>";


        if($diferencasEncontradas){
            
            if($this->atualizarDados($dados->id)){
                if(!$this->avatar['error']){
                    $this->createFolder($id);
                }
                setSession("MessageUpdate",messageSuccess($html));
                redirectBack();
            }else{
                setSession("MessageUpdate", messageError("Ocorreu algum erro, por favor tente mais tarde ou entre em contato com o suporte"));
                redirectBack();
            }

        }else{
           setSession("MessageUpdate", messageWarning("Altere pelo menos algum valor para alteração funcionar"));
           redirectBack();
        }
 
    }

    private function atualizarDados($id)
    {
       
        
        if($this->avatar['error']){
            $update = $this->user->update("id", $id, ["nome" => $this->nome, "usuario" => $this->usuario, "email" => $this->mail, "celular" => $this->celular, "uf" => $this->uf, "cidade" => $this->cidade]);
        }else{
            $foto = $this->avatar['name'];
            $update = $this->user->update("id", $id, ["nome" => $this->nome, "usuario" => $this->usuario, "email" => $this->mail, "celular" => $this->celular, "uf" => $this->uf, "cidade" => $this->cidade,"avatar" => $foto]);
        }
        


        if($update > 0){
          return true;
        }else{
          return false;
        } 
    }

    private function createFolder(int $id)
    {
        $file = $this->avatar['tmp_name'];
        $foto = $this->avatar['name'];
        $_UP['pasta'] = "Public/img/avatar/$id/";
        mkdir($_UP['pasta'], 0777);
        move_uploaded_file($file, $_UP['pasta'].$foto);
    }

}


