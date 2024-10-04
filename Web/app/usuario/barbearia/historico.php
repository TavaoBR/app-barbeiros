<?=$this->layout('themes/sistemas', ['title' => $title]);?>


<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css'>


<style>
    body{
    margin-top:20px;
    background-color: #f1f3f7;
}

.avatar-lg {
    height: 5rem;
    width: 5rem;
}

.font-size-18 {
    font-size: 18px!important;
}

.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

a {
    text-decoration: none!important;
}

.w-xl {
    min-width: 160px;
}

.card {
    margin-bottom: 24px;
    -webkit-box-shadow: 0 2px 3px #e4e8f0;
    box-shadow: 0 2px 3px #e4e8f0;
}

.card {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid #eff0f2;
    border-radius: 1rem;
}
</style>

<div class="container">



<div class="row">
    
    <div class="py-3 px-4">
        <h3 class="font-size-16 mb-0">Seu Historico</h3>
        <hr>
   </div>

    <div class="row">

    <?=validateSession("ConcluidosAgenda")?>

<div class="col-xl-8">
<div class="row">
    <?php 
     foreach($dados as $data):
      $fkBarbearia = $data->fkBarbeiro;
      $barbearia = perfilBarberio($fkBarbearia);
      $nomeBarbearia = $barbearia[1]->nomeBarbeiro; 
    ?>
  <div class="col-xl-6 mb-4">
    <div class="card">
      <div class="card-body" style="<?=statusAgendamentoColor($data->status)?>">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <div class="ms-3">
             <p class="fw-bold mb-0">Barbearia: <?=$nomeBarbearia?></p>
              <p class="fw-bold mb-0">Status: <?=statusAgendamento($data->status)?></p>
              <p class="mb-0">Serviço(s): <?=$data->servicosSolicitados?></p>
              <p class="mb-0">Data: <?=date("d/m/Y", strtotime($data->data))?></p>
              <p class="mb-0">Horário: <?=date("H:i", strtotime($data->horario))?></p>
              <p class="fw-bold mb-0">Valor: R$<?=$data->valorTotal?></p>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  <?php 
   endforeach;
  ?>
</div>


             <!-- end row-->
        </div>


    </div>
    <!-- end row -->
    
</div>

<script>



</script>