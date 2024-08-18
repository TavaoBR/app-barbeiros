<?php 

namespace Src\Controller\App;
use Config\TemplateConfig;
use League\Plates\Template\Func;
use Src\Database\Filters;
use Src\Database\Model\HorarioAtendimento;
use Src\GET\Barbeiro\Barbeiro;
use Src\GET\Usuario\Usuario;

class BarbeiroController  extends TemplateConfig{

    protected HorarioAtendimento $atendimento;
    protected Filters $filter;

    public function __construct()
    {
       $this->atendimento = new HorarioAtendimento;
       $this->filter = new Filters;
    }

    private function horarioInicial(int $id)
    {
       $filter = $this->filter;
       $filter->orderBy("id", "asc");
       $filter->limit(1);
       $this->atendimento->setFilters($filter);
       $select = $this->atendimento->findBy("fk", $id);
       return $select[1];
    }

    private function horariofinal(int $id)
    {
      $filter = $this->filter;
      $filter->orderBy("id", "desc");
      $filter->limit(1);
      $this->atendimento->setFilters($filter);
      $select = $this->atendimento->findBy("fk", $id);
      return $select[1];
    }

    private function contaRegistroHorarios(int $id)
    {
      $select = $this->atendimento->findBy("fk", $id);
      return $select[0];
    }
    
    private function verificarNivel()
    {
      $get = new Usuario();
      if($get->nivel() != 3){
        redirect(routerConfig()."/app/acesso/negado");
      }
    }

    private function verificaPeril(string $token)
    {
        $get = new Usuario();
        if($get->token() != $token){
          $this->perfilPublico($token);
          return true;
        }

        return false;
    }



    public function perfil($data)
    {
        session_start();
        
        if(!$this->verificaPeril($data['token'])){
          $this->verificarNivel();
          $barbeiro = new Barbeiro($data['token']);
          $this->view("app/barbeiro/perfil", 
          ["title" => "Perfil", "id" => $barbeiro->id(),"fk" => $barbeiro->fk(), "token" => $barbeiro->token(), "celular" => $barbeiro->celular(), "avatar" => $barbeiro->avatar(), "nome" => $barbeiro->nome(),
          "endereco" => $barbeiro->endereco(), "bairro" => $barbeiro->bairro(), "numero" => $barbeiro->numero(), "cidade" => $barbeiro->cidade(), "estado" => $barbeiro->estado(), "online" => $barbeiro->online(), 
          "horaInicial" => $this->horarioInicial($barbeiro->id())->hora, "horaFinal" => $this->horariofinal($barbeiro->id())->hora
        ]);
        }
        
    }

    public function addAvatar($data)
    {
      session_start();
      if(!$this->verificaPeril($data['token'])){
         $this->verificarNivel();
         $barbeiro = new Barbeiro($data['token']);
         $id = $barbeiro->id();
         $this->view("app/barbeiro/addAvatar",["title" => "Adicionar Foto de perfil", "id" => $id]);
      }
    }


    public function agenda($data)
    {
      session_start();
      if(!$this->verificaPeril($data['token'])){
        $this->verificarNivel();
        $this->view("app/barbeiro/agenda/index", ["title" => "Agenda {$data['data']}"]);
      }
     
    }

    public function cadastrarHorarios($data)
    {
        session_start();
        if(!$this->verificaPeril($data['token'])){
          $this->verificarNivel();
          $barbeiro = new Barbeiro($data['token']);
          $this->view("app/barbeiro/atendimento/cadastrarHorarios", 
          ["title" => "Cadastrar Horarios", "id" => $barbeiro->id(), "conta" => $barbeiro->conta(), "contaHorario" => $this->contaRegistroHorarios($barbeiro->id())]);
        }
        
    }

    public function perfilPublico($token)
    {
      session_start();
        $barbeiro = new Barbeiro($token);
        $this->view("app/barbeiro/perfilPublico", 
        ["title" => "Perfil", "id" => $barbeiro->id(),"fk" => $barbeiro->fk(), "token" => $barbeiro->token(), "celular" => $barbeiro->celular(), "avatar" => $barbeiro->avatar(), "nome" => $barbeiro->nome(),
        "endereco" => $barbeiro->endereco(), "bairro" => $barbeiro->bairro(), "numero" => $barbeiro->numero(), "cidade" => $barbeiro->cidade(), "estado" => $barbeiro->estado(), "online" => $barbeiro->online(), 
        "horaInicial" => $this->horarioInicial($barbeiro->id())->hora, "horaFinal" => $this->horariofinal($barbeiro->id())->hora
      ]);
    }

    public function cadastrarServicos($data)
    {
      session_start();
      $this->verificarNivel();
      $barbeiro = new Barbeiro($data['token']);
      $this->view("app/barbeiro/servicos/cadastro", ["title" => "Cadastro", "conta" => $barbeiro->conta(), "id" => $barbeiro->id()]); 
    }

    public function configuracao($data)
    {
      session_start();
      if(!$this->verificaPeril($data['token'])){
        $this->verificarNivel();
        $this->view("app/barbeiro/configuracao", ["title" => "Index", "token" => $data['token']]);
      }
    }

}