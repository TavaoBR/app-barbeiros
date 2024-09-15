<?php 

namespace Src\Controller\App;
use Config\TemplateConfig;
use Src\Database\Filters;
use Src\Database\Model\Barbeiro;
use Src\Database\Model\ServicoBarbeiro;
use Src\GET\Usuario;
use Src\GET\Pesquisa;

class IndexController extends TemplateConfig{
    
    private Barbeiro $barbeiro;
    private ServicoBarbeiro $servicos;

    public function __construct()
    {
      $this->barbeiro = new Barbeiro;
      $this->servicos = new ServicoBarbeiro;
    }

    public function index()
    {
      echo "aqui";
    }

    public function acessoNegado()
    {
       session_start();
       $this->view("error/AcessoNegado", ["title" => "Acesso Negado"]);
    }

    public function perfil()
    {
        session_start();
        $get = new Usuario();
        
        $this->view("app/usuario/perfil", 
        ["title" => "Perfil", 
        "id" => $get->id(), "avatar" => $get->avatar(),
        "usuario" => $get->usuario(), "email" => $get->mail(), "nome" => $get->nome(), "celular" => $get->celular(), "senha" => $get->viewSenha(), "uf" => $get->uf(), "cidade" => $get->cidade()]);
        
    }

    public function trocarSenha()
    {

      session_start();
      $get = new Usuario();
      $this->view("app/usuario/trocarsenha", ["title" => "Trocar Senha", "id" => $get->id()]);

    }

    public function perfilPublico($data)
    {

    }

    public function cadastrarPerfilBarbearia()
    {
      session_start();
      $get = new Usuario();
      $this->view("app/criarPerfilBarbearia", ["title" => "Criar Perfil Barbearia", "token" => $get->token(), "id" => $get->id()]);
    } 

    public function Barbeiroagendarhoje($data)
    {
       session_start();
       $get = new Usuario();
       $token = $data['token'];
       $barbeiro = $this->barbeiro->findBy("token", $token);
       $id = $barbeiro[1]->id; 
       $servico = $this->servicos->fetchAll();
       $nome = $get->nome();
       $celular = $get->celular(); 

       $this->view("app/usuario/barbearia/agendar", ["title" => "Agendar", "id" => $id, "servicos" => $servico[1], "celular" => $celular, "nome" => $nome]);
         
    }

    public function historicoAgendaBarbeiro()
    {
        session_start();
        $get = new Usuario();
        $agenda = HistoricoAgendaUsuarioBarbeiro($get->id());
        $this->view("app/usuario/barbearia/historico", ["title" => "Historico Agendamento Barbeiro"]);
    }

    public function resultaPesquisa($data)
    {
        session_start();
    
        // Mantém os espaços e substitui os hífens por espaços
        $cleanString = preg_replace('/[^a-zA-Z0-9-]/', '', $data['nome']); // Mantém hífens e remove outros caracteres especiais
        $cleanString = str_replace('-', ' ', $cleanString); // Substitui hífens por espaços
        $nome = trim($cleanString); // Remove espaços no início e no fim
        $get = new Usuario();
        $uf = $get->uf();
        $cidade = $get->cidade();
        $pesquisa = new Pesquisa($nome, $uf, $cidade);
        $result = $pesquisa->Result();
    
        if($result[0] > 0){
            $this->view("app/resultadoPesquisa", ["title" => "Resultado", "result" => $result[1], "nomePesquisa" => $nome, "total" => $result[0]]);
        }else{
            $this->view("error/PesquisaNaoEncontrada", ["title" => "Pesquisa não encontrada"]);
        }
    }

    public function telaProcurar()
    {
        session_start();
        $get = new Usuario();
        $uf = $get->uf();
        $cidade = $get->cidade();
        $pesquisa = pesquisaTelaProcura($uf, $cidade);

        if($pesquisa[0] > 0){
          $this->view("app/resultadoPesquisa", ["title" => "Tela Procurar", "result" => $pesquisa[1], "total" => $pesquisa[0]]);
        }else{
          $this->view("error/Procura", ["title" => "Pesquisa não encontrada"]);
        }
    }


    public function confirmarPresenca()
    {
      session_start();
      $this->view("app/usuario/barbearia/confirmarPresenca", ["title" => "Confirmar Presença"]);
    }

    public function cancelarPresenca()
    {
      session_start();
      $this->view("app/usuario/barbearia/CancelarPresenca", ["title" => "Cancelar Presença"]);
    }


    public function AvaliarAtendimento()
    {
      session_start();
      $this->view("app/usuario/barbearia/avaliar", ["title" => "Avaliar Atendimento"]);
    }



}