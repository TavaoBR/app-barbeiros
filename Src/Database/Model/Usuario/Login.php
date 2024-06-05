<?php 

namespace Src\Database\Model\Usuario;

use Src\Database\Model\Usuario;

class Login {

    protected string $usuario;
    protected string $senha;
    
    protected $user;

    public function __construct()
    {
        $this->usuario = $_POST['usuario'];
        $this->senha = $_POST['senha'];
        $this->user = new Usuario;
    }

}