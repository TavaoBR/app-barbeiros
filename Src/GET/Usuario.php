<?php 

namespace Src\GET;

use Src\Database\Model\Usuario as ModelUsuario;

class Usuario {

    private ModelUsuario $user;
    private int $id;
    private int $conta;
    private ?string $usuario = '';
    private ?string $mail = '';
    private ?string $senha = '';
    private ?string $viewSenha = '';
    private ?string $token = ''; 
    private ?string $nivel = '';
    private ?string $avatar = '';
    //private ?int $pontos = '';

    public function __construct(int $id = null)
    {
        if($id === null){
            $this->id = getSession("id");
        }else{
            $this->id = $id;
        }
 
        
        $this->user = new ModelUsuario;
        $data = $this->user->findBy("id", $this->id);
        $this->conta = $data[0];
        $this->usuario = $data[1]->usuario;
        $this->mail = $data[1]->email;
        $this->senha = $data[1]->senha;
        $this->viewSenha = $data[1]->viewSenha;
        $this->token = $data[1]->token;
        $this->nivel = $data[1]->nivel;
        $this->avatar = $data[1]->avatar;
           
    }

    public function conta()
    {
        return $this->conta;
    }

    public function usuario() 
    {
        return $this->usuario; 
    }


    public function mail()
    {
       return $this->mail;
    }

    public function senha()
    {
        return $this->senha;
    }

    public function Viewsenha()
    {
       return $this->viewSenha;
    }

    public function token()
    {
        return $this->token;
    }

    public function avatar()
    {
        return $this->avatar;
    }

    public function nivel()
    {
        return $this->nivel;
    }



}