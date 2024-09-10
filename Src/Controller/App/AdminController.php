<?php 

namespace Src\Controller\App;
use Config\TemplateConfig;
use Src\GET\Usuario;

class AdminController extends TemplateConfig {

  
    private function verificarNivel()
    {
      $get = new Usuario();
      if($get->nivel() != 1){
        redirect(routerConfig()."/app/acesso/negado");
      }
    }

    public function index()
    {
      session_start();
      $this->verificarNivel();
    }

    public function barbearias()
    {
      session_start();
      $this->verificarNivel();

    }


}