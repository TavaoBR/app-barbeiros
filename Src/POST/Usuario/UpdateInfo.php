<?php 

namespace Src\POST\Usuario;

use Src\Database\Model\Usuario;

class UpdateInfo {

    protected $user;
    protected string $nome;
    protected string $usuario ;
    protected string $mail ;
    protected string $celular ;

    public function __construct()
    {
        $this->user = new Usuario;
        $this->nome = $_POST['nome'];
        $this->usuario = $_POST['usuario'];
        $this->mail = $_POST['email'];
        $this->celular = $_POST['celular'];
    }

     
    public function Request($data)
    {
       session_start();
       $this->comparar($data['id']);
    }

    private function comparar($id)
    {
        $select = $this->user->findBy("id", $id);
        $dados = $select[1];

        $novosDados = [
            "nome" => $this->nome,
            "usuario" => $this->usuario,
            "email" => $this->mail,  
            "celular" => $this->celular,
        ];

        $antigosDados = [
            "nome" => $dados->nome,
            "usuario" => $dados->usuario,
            "email" => $dados->email,  
            "celular" => $dados->celular
        ];

        /*echo "<pre>";
        print_r($novosDados);
        print_r($antigosDados);
        echo "</pre>";*/


        $html = "<ol>";
        $diferencasEncontradas = false;

        foreach($novosDados as $campo => $valorNovo){
            if(isset($antigosDados[$campo]) && $antigosDados[$campo] != $valorNovo){
                $diferencasEncontradas = true;
                $valorAntigo = $antigosDados[$campo];
                $html .= "<li>O campo <strong>'$campo'</strong> foi atualizado de <strong>'$valorAntigo'</strong> para <strong>'$valorNovo'</strong>.<br></li>";
            }
        }

        $html .= "</ol>";


        if($diferencasEncontradas){
            echo $html;
        }else{
            echo "Nenhum dado está diferente";
        }

        

        

    }

    private function atualizarDados($id)
    {
       $update = $this->user->update("id", $id, ["nome" => $this->nome, "usuario" => $this->usuario, 
          
        ]);

        if($update > 0){
          return true;
        }else{
          return false;
        } 
    }


}