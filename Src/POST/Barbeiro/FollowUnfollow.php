<?php

namespace Src\POST\Barbeiro;

use Src\Database\Model\Barbeiro;
use Src\Database\Model\Seguidores;
use Src\Services\Whatsapp;

class FollowUnfollow {

    private Seguidores $seguidores;
    private Barbeiro $barbeiro;

    public function __construct()
    {
       $this->seguidores = new Seguidores;
       $this->barbeiro = new Barbeiro;
    }

    public function seguir()
    {

    }

    public function naoSeguir()
    {

    }

    private function AddSeguidorTotal()
    {

    }

    private function RemoveSeguidorTotal()
    {
        
    }
}