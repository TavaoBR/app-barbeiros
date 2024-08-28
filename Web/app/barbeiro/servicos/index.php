<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<div class="container">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Serviço</th>
      <th scope="col">Valor</th>
      <th scope="col">Editar</th>
      <th scope="col">Deletar</th>
    </tr>
  </thead>
  <tbody>
    <?php 
     foreach($dados as $servico):
    ?>
    <tr>
      <th scope="row"><?=$servico->id?></th>
      <td><?=$servico->nome?></td>
      <td><?=$servico->valor?></td>
      <td>
        <a href="<?=routerConfig()?>/app/barbeiro/servicos/editar/<?=$token?>/<?=$servico->id?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
      </td>
      <td>
        <a href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
      </td>
    </tr>
    <?php 
    endforeach;
    ?>
  </tbody>
</table>
</div>
