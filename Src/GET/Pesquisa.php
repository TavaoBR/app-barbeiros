<?php 

namespace Src\GET;

use Src\Database\Pagination;
use Src\Database\Filters;
use Src\Database\Model\Barbeiro;

class Pesquisa {
  private string $nome;

  public function __construct(string $nome)
  {
      $this->nome = $nome;
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
      return pesquisa($this->nome);
      
  }

}