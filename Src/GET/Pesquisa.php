<?php 

namespace Src\GET;

use Src\Database\Pagination;
use Src\Database\Filters;
use Src\Database\Model\Barbeiro;

class Pesquisa {
  private string $nome;
  private string $uf;
  private string $cidade;

  public function __construct(string $nome, string $uf, string $cidade)
  {
      $this->nome = $nome;
      $this->uf = $uf;
      $this->cidade = $cidade;
  }

  public function Result()
  {
      return $this->query();   
  }

  private function query()
  {

      /*$nome = $this->nome; 
      $filter = new Filters;
      $filter->where("nomeBarbeiro", "like", "%$nome%");
      $barbeiro = new Barbeiro;
      $barbeiro->setFilters($filter);
      return $barbeiro->fetchAll();*/
      return pesquisa($this->nome, $this->uf, $this->cidade);
      
  }

}