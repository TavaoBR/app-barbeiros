<?php 

namespace Src\Controller\App;
use Config\TemplateConfig;
use Src\Database\Filters;
use Src\Database\Model\AgendaBarbeiro;
use Src\Database\Model\HorarioAtendimento;
use Src\Database\Model\ProfissionalBarbearia;
use Src\Database\Model\ServicoBarbeiro;
use Src\GET\Barbeiro\Barbeiro;
use Src\GET\Usuario;

class BarbeiroController  extends TemplateConfig{

    protected HorarioAtendimento $atendimento;
    protected Filters $filter;
    protected ServicoBarbeiro $servicos;

    public function __construct()
    {
       $this->atendimento = new HorarioAtendimento;
       $this->servicos = new ServicoBarbeiro;
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
          $this->view("app/barbearia/perfil", 
          ["title" => "Perfil", "id" => $barbeiro->id(),"fk" => $barbeiro->fk(), "token" => $barbeiro->token(), "celular" => $barbeiro->celular(), "avatar" => $barbeiro->avatar(), "nome" => $barbeiro->nome(),"endereco" => $barbeiro->endereco(), 
          "bairro" => $barbeiro->bairro(), "numero" => $barbeiro->numero(), "cidade" => $barbeiro->cidade(), "estado" => $barbeiro->estado(), "totalAvaliacao" => $barbeiro->totalAvalicao(), "valorNotas" => $barbeiro->valorTotalNotas(), 
          "online" => $barbeiro->online(), "horaInicial" => $this->horarioInicial($barbeiro->id())->hora, "horaFinal" => $this->horariofinal($barbeiro->id())->hora
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
         $this->view("app/barbearia/addAvatar",["title" => "Adicionar Foto de perfil", "id" => $id]);
      }
    }

    public function cadastrarHorarios($data)
    {
        session_start();
        if(!$this->verificaPeril($data['token'])){
          $this->verificarNivel();
          $barbeiro = new Barbeiro($data['token']);
          $this->view("app/barbearia/atendimento/cadastrarHorarios", 
          ["title" => "Cadastrar Horarios", "id" => $barbeiro->id(), "conta" => $barbeiro->conta(), "contaHorario" => $this->contaRegistroHorarios($barbeiro->id())]);
        }
        
    }

    public function perfilPublico($token)
    {
      session_start();
        $barbeiro = new Barbeiro($token);
        $get = new Usuario();
        $servico = $this->servicos->fetchAll();
        $nome = $get->nome();
        $celular = $get->celular();
        $this->view("app/barbearia/perfilPublico", 
        ["title" => "Perfil", "id" => $barbeiro->id(),"fk" => $barbeiro->fk(), "token" => $barbeiro->token(), "celular" => $barbeiro->celular(), "avatar" => $barbeiro->avatar(), "nome" => $barbeiro->nome(),
        "endereco" => $barbeiro->endereco(), "bairro" => $barbeiro->bairro(), "numero" => $barbeiro->numero(), "cidade" => $barbeiro->cidade(), "estado" => $barbeiro->estado(), "online" => $barbeiro->online(),
        "totalAvaliacao" => $barbeiro->totalAvalicao(), "valorNotas" => $barbeiro->valorTotalNotas(), "servicos" => $servico[1], "celularC" => $celular, "nomeC" => $nome, 
        "horaInicial" => $this->horarioInicial($barbeiro->id())->hora, "horaFinal" => $this->horariofinal($barbeiro->id())->hora
      ]);
    }

    public function cadastrarServicos($data)
    {
      session_start();
      $this->verificarNivel();
      $barbeiro = new Barbeiro($data['token']);
      $this->view("app/barbearia/servicos/cadastro", ["title" => "Cadastro", "conta" => $barbeiro->conta(), "id" => $barbeiro->id()]); 
    }

    public function configuracao($data)
    {
      session_start();
      if(!$this->verificaPeril($data['token'])){
        $this->verificarNivel();
        $this->view("app/barbearia/configuracao", ["title" => "Index", "token" => $data['token']]);
      }
    }

    public function agenda($data)
    {
      session_start();
      if(!$this->verificaPeril($data['token'])){
        $this->verificarNivel();
        $barbeiro = new Barbeiro($data['token']);
        $id = $barbeiro->id();
        $dados = agendaBarbeiroDataOrderDesc($id, $data['data']);
        $this->view("app/barbearia/agenda/index", ["title" => "Agenda {$data['data']}", "array" => $dados[1], "conta" => $dados[1], "dia" => date("d/m/Y", strtotime($data['data'])), "nome" => $barbeiro->nome(), "avatar" => $barbeiro->avatar(), "id" => $id]);
      }
     
    }

    public function servicos($data)
    {
      session_start();
      if(!$this->verificaPeril($data['token'])){
        $this->verificarNivel();
        $barbeiro = new Barbeiro($data['token']);
        $id = $barbeiro->id();
        $servico = servicoBarbeiro($id);
        $this->view("app/barbearia/servicos/index", ["title" => "Serviços", "dados" => $servico[1], "token" => $barbeiro->token()]);
      }

    }


    public function editarServico($data)
    {
      session_start();
      if(!$this->verificaPeril($data['token'])){
        $this->verificarNivel();
        $barbeiro = new Barbeiro($data['token']);
        $id = $barbeiro->id();
        $servico = servicoIdFk($data['id'],$id);
        $this->view("app/barbearia/servicos/editar",["title" => "Editar Serviço", "dados" => $servico[1], "conta" => $servico[0]]);
      }  
    }

    public function excluirServico($data)
    {
      session_start();
      if(!$this->verificaPeril($data['token'])){
        $this->verificarNivel();
        $this->view("app/barbearia/servicos/delete",["title" => "Editar Serviço"]);
      }
    }

    public function cadastroProfissional($data)
    {
      session_start();
      if(!$this->verificaPeril($data['token'])){
        $this->verificarNivel();
        $barbeiro = new Barbeiro($data['token']);
        $id = $barbeiro->id();
        $this->view("app/barbearia/profissional/cadastrar",["title" => "Cadastrar", "id" => $id]);
      }
    }

    public function profissionais($data)
    {
      session_start();
      if(!$this->verificaPeril($data['token'])){
        $this->verificarNivel();
        $barbearia = new Barbeiro($data['token']);
        $id = $barbearia->id();
        $barbeiros = new ProfissionalBarbearia;
        $select = $barbeiros->findBy("fk", $id, false);
        $this->view("app/barbearia/profissional/index",["title" => "Barbeiros","conta" => $select[0], "dados" => $select[1], "token" => $barbearia->token()]);
      }
    }

    public function editarProfissional($data)
    {
      session_start();
      if(!$this->verificaPeril($data['token'])){
        $this->verificarNivel();
        $barbeiro = new ProfissionalBarbearia;
        $select = $barbeiro->findBy("id", $data['id']);
        $this->view("app/barbearia/profissional/editar", ["title" => "Editar", "conta" => $select[0], "dados" => $select[1]]);
      }  
    }

    public function editarPerfilBarbearia($data)
    {
      session_start();
      if(!$this->verificaPeril($data['token'])){
         $this->verificarNivel();
         $barbeiro = new \Src\Database\Model\Barbeiro;
         $select = $barbeiro->findBy('token', $data['token']);
         $this->view("app/barbearia/editarPerfil", ["title" => "Editar Perfil", "dados" => $select[1]]); 
      }
    }

    public function horarios($data)
    {
      session_start();
      if(!$this->verificaPeril($data['token'])){
         $this->verificarNivel();
         $barbeiro = new \Src\Database\Model\Barbeiro;
         $select = $barbeiro->findBy('token', $data['token']);
         $id = $select[1]->id;
         $horarios = new HorarioAtendimento;
         $selectH = $horarios->findBy('fk', $id, false);
         $this->view("app/barbearia/atendimento/index", ["title" => "Horarios de atendimento", "dados" => $selectH[1]]); 
      }
    }
}