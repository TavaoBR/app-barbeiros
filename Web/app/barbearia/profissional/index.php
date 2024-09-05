<?=$this->layout('themes/sistemas', ['title' => $title]);?>


<div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
    <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Barbeiros: &nbsp; <button class="btn btn-secondary btn-sm"><?=$conta?></button> </h3>
</div>

<div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
    <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center"><a href="<?=routerConfig()?>/app/barbearia/barbeiro/cadastrar/<?=$token?>" class="btn btn-success">Cadastrar</a> </h3>
</div>



<table class="table">
  <thead>
    <t>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Status</th>
      <th scope="col">Horarios</th>
      <th scope="col">Editar</th>
      <th scope="col">Excluir</th>
    </tr>
  </thead>
  <tbody>
  <?php 
    foreach($dados as $data):
   ?>
    <tr>
      <th scope="row"><?=$data->id?></th>
      <td><?=$data->nome?></td>
      <td><?=statusBarbeiro($data->status)?></td>
      <td><a href="#" class="btn btn-secondary btn-sm"><i class="fa-solid fa-user-clock"></i></a></i></td>
      <td><a href="<?=routerConfig()?>/app/barbearia/barbeiros/editar/<?=$token?>/<?=$data->id?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
      <td><button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button></td>
    </tr>
    <?php 
     endforeach;
    ?>
  </tbody>
</table>

</div>




