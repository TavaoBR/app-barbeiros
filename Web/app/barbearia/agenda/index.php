<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<?php 
 $ganhos = [];
 $pedentes = [];
 $cancelados = [];
?>

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
        <div class="col-xl-8">

        <?php 
         foreach($array as $data):
            $fkUser = $data->fkUser;

            if($data->status == 5){
              $ganhos[] = $data->valorTotal;
            }

            if($data->status == 1 OR $data->status == 2 OR $data->status == 4){
                $pedentes[] = $data->valorTotal;
              }

            if($data->status == 3){
                $cancelados[] = $data->valorTotal;
              }

        ?>

            <div class="card border shadow-none">
                <div class="card-body">

                    <div class="d-flex align-items-start border-bottom pb-3">
                        <div class="me-4">
                            <img src="<?=Assests("img/avatar/$fkUser/")?><?=avatarUser($fkUser)?>" alt="" class="avatar-lg rounded">
                        </div>
                        <div class="flex-grow-1 align-self-center overflow-hidden">
                            <div>
                                <h5 class="text-truncate font-size-18"><a href="#" class="text-dark"><?=$data->nome?> </a></h5>
                                <p class="text-muted mb-0">
                                    Status: <?=statusAgendamento($data->status)?>
                                </p>
                                <p class="mb-0 mt-1">Codigo: <?=$data->codigo?> <i class="icofont-clock-time"></i> </p>
                                <p class="mb-0 mt-1">Celular: <?=$data->celular?></p>
                                <p class="mb-0 mt-1">Serviço(s): <?=$data->servicosSolicitados?></p>
                                <p class="mb-0 mt-1">Horário: <?=date("H:i", strtotime($data->horario))?></p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mt-3">
                                            <?php 
                                              if($data->status == 1):
                                            ?>
                                            <button class="btn btn-primary btn-sm" onclick="ConfirmarAtendimento('<?=$data->codigo?>')"> Confirmar </button>
                                            <button class="btn btn-danger btn-sm" onclick="CancelarAtendimento('<?=$data->codigo?>')"> Cancelar </button>
                                            <?php 
                                             endif;
                                            ?>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mt-3">
                                <?php 
                                             if($data->status == 2 OR $data->status == 4):
                                            ?>
                                              <button class="btn btn-danger btn-sm" onclick="CancelarAtendimento('<?=$data->codigo?>')"> Cancelar </button>
                                              <button class="btn btn-success btn-sm" onclick="ConcluirAtendimento('<?=$data->codigo?>')"> Concluir </button>
                                            <?php 
                                             endif;
                                            ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mt-3">
                                    <p class="text-muted mb-2">Total</p>
                                    <h5>R$<?=$data->valorTotal?></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <?php 
            endforeach;
            ?>
             <!-- end row-->
        </div>

        <div class="col-xl-4">
            <div class="mt-5 mt-lg-0">
                <div class="card border shadow-none">
                    <div class="card-header bg-transparent border-bottom py-3 px-4">
                        <h5 class="font-size-16 mb-0">Agenda  <span class="float-end"><?=$dia?></span></h5>
                    </div>
                    <div class="card-body p-4 pt-2">

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <tr class ="bg-success">
                                        <td class="text-white">Ganhos do dia :</td>
                                        <td class="text-end fw-bold text-white">R$ <?=array_sum($ganhos)?></td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="text-dark">Ganhos Pendentes : </td>
                                        <td class="text-end fw-bold text-dark">R$ <?=array_sum($pedentes)?></td>
                                    </tr>
                                    <tr class="bg-danger">
                                        <td class="text-white">Cancelados :</td>
                                        <td class="text-end fw-bold text-white">R$ <?=array_sum($cancelados)?></td>
                                    </tr>

                                    <tr class="bg-dark">
                                        <td class="text-white">Soma de todos :</td>
                                        <td class="text-end fw-bold text-white">R$ <?=array_sum($ganhos) + array_sum($pedentes) + array_sum($cancelados)?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    
</div>

<script>
  var url = "<?=routerConfig()?>";
</script>
<script src="<?=Assests("assets/js/barbeiro/Atendimento.js")?>"></script>