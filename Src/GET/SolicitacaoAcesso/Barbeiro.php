<?php 

namespace Src\GET\SolicitacaoAcesso;

use Src\Database\Filters;
use Src\Database\Model\AcessoBarbeiro;
use Src\Database\Pagination;

class Barbeiro {
    private $all;
    private string $pages;
    private int $id;
    private int $conta;
    private ?int $fk = null;

    public function __construct(int $id = null){
        
        $select =  new AcessoBarbeiro;
        
        if($id === null){
           $filter =  new Filters;
           $pagination =  new Pagination;
           
           $filter->orderBy("id", "desc");
           $pagination->setItemsPerPage(20);
           $select->setFilters($filter);
           $select->setPagination($pagination);
           $data = $select->fetchAll();
           $this->conta = $data[0];
           $this->all = $data[1];
           $this->pages = $pagination->links();
        }else{

        }
    }

    public function conta()
    {
       return $this->conta;
    }

    public function pagination()
    {
      return $this->pages;
    }

    public function getAll()
    {
      return  $this->all;
    }

}