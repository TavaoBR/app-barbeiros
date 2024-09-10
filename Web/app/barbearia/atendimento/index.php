<?=$this->layout('themes/sistemas', ['title' => $title]);?>




<div class="container-fluid">
  <h2>Horários de atendimento</h2>
  <a href="<?=routerConfig()?>/app/barbearia/atendimento/cadastro/horarios/<?=$token?>" class="btn btn-success btn-sm">Cadastrar</a>
  <button class="btn btn-danger btn-sm" onclick="Horarios(<?=$fk?>)">Deletar todos os horarios</button>

  <br>
  <br>

<div class="table-responsive-sm">
<table class="table table-sm">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">Hora</th>
      <th scope="col">Deletar</th>
    </tr>
  </thead>
  <tbody>
  <?php 
    foreach($dados as $hora):
   ?>
    <tr>
      <th scope="row"><?=$hora->id?></th>
      <td><?=date("H:i", strtotime($hora->hora))?></td>
      <td><button class="btn btn-danger btn-sm" onclick="Horario(<?=$hora->id?>)"><i class="fa-solid fa-trash-can"></i></td>
    </tr>
    <?php 
     endforeach;
    ?>
  </tbody>
</table>
</div>

<?=$pages?>
</div>

<script>
  var url = "<?=routerConfig()?>";
</script>
<script src="<?=Assests("assets/js/barbeiro/Deletar.js")?>"></script>

