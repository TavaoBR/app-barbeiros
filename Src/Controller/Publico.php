<?php

namespace Src\Controller;
use Config\TemplateConfig;
use Src\Database\Model\AgendaBarbeiro;
use Src\Database\Model\Barbeiro;
use Src\Services\Whatsapp\Message;

class Publico extends TemplateConfig
{
    private Barbeiro $barbeiro;
    private AgendaBarbeiro $agenda;

    public function __construct()
    {
        $this->barbeiro = new Barbeiro;
        $this->agenda = new AgendaBarbeiro;
    }

    public function BarbeariaConfirmar($data)
    {
       $codigo = $data['codigo'];
       $this->view("site/barbearia/confirma", ["tilte" => "Confirmar", "codigo" => $codigo]);
       
       
    }

    public function BarbeariaCancelar($data)
    {
      $codigo = $data['codigo'];
      $this->view("site/barbearia/cancelar", ["tilte" => "Cancelar", "codigo" => $codigo]);
    }


    public function ClienteConfirmar($data)
    {
      $codigo = $data['codigo'];
      $this->view("site/usuario/confirma", ["tilte" => "Confirmar", "codigo" => $codigo]);
    }

    public function ClienteCancelar($data)
    {
      $codigo = $data['codigo'];
      $this->view("site/usuario/cancelar", ["tilte" => "Cancelar", "codigo" => $codigo]);
    }

    private function getCodigo($codigo)
    {
      $codigo = $this->agenda->findBy("codigo", $codigo);
      return $codigo;
    }

    
} 