<?=$this->layout('themes/sistemas', ['title' => $title]);?>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css'>

<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js'></script>



<style>
    body{
        margin-top:20px;
        background:#eee;
    }
    .payments-item img.mr-3 {
        width: 47px;
    }
    .order-list .btn {
        border-radius: 2px;
        min-width: 121px;
        font-size: 13px;
        padding: 7px 0 7px 0;
    }
    .osahan-account-page-left .nav-link {
        padding: 18px 20px;
        border: none;
        font-weight: 600;
        color: #535665;
    }
    .osahan-account-page-left .nav-link i {
        width: 28px;
        height: 28px;
        background: #535665;
        display: inline-block;
        text-align: center;
        line-height: 29px;
        font-size: 15px;
        border-radius: 50px;
        margin: 0 7px 0 0px;
        color: #fff;
    }
    .osahan-account-page-left .nav-link.active {
        background: #f3f7f8;
        color: #282c3f !important;
    }
    .osahan-account-page-left .nav-link.active i {
        background: #282c3f !important;
    }
    .osahan-user-media img {
        width: 90px;
    }
    .card offer-card h5.card-title {
        border: 2px dotted #000;
    }
    .card.offer-card h5 {
        border: 1px dotted #daceb7;
        display: inline-table;
        color: #17a2b8;
        margin: 0 0 19px 0;
        font-size: 15px;
        padding: 6px 10px 6px 6px;
        border-radius: 2px;
        background: #fffae6;
        position: relative;
    }
    .card.offer-card h5 img {
        height: 22px;
        object-fit: cover;
        width: 22px;
        margin: 0 8px 0 0;
        border-radius: 2px;
    }
    .card.offer-card h5:after {
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-bottom: 4px solid #daceb7;
        content: "";
        left: 30px;
        position: absolute;
        bottom: 0;
    }
    .card.offer-card h5:before {
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 4px solid #daceb7;
        content: "";
        left: 30px;
        position: absolute;
        top: 0;
    }
    .payments-item .media {
        align-items: center;
    }
    .payments-item .media img {
        margin: 0 40px 0 11px !important;
    }
    .reviews-members .media .mr-3 {
        width: 56px;
        height: 56px;
        object-fit: cover;
    }
    .order-list img.mr-4 {
        width: 70px;
        height: 70px;
        object-fit: cover;
        box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075)!important;
        border-radius: 2px;
    }
    .osahan-cart-item p.text-gray.float-right {
        margin: 3px 0 0 0;
        font-size: 12px;
    }
    .osahan-cart-item .food-item {
        vertical-align: bottom;
    }

    .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
        color: #000000;
    }

    .shadow-sm {
        box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
    }

    .rounded-pill {
        border-radius: 50rem!important;
    }
    a:hover{
        text-decoration:none;
    }
</style>
	

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="osahan-account-page-left shadow-sm bg-white h-100">
                <div class="border-bottom p-4">
                    <div class="osahan-user text-center">
                        <div class="osahan-user-media">
                            <img class="mb-3 rounded-pill shadow-sm mt-1" src="<?=Assests("img/barbeiro/$id/$avatar")?>" alt="gurdeep singh osahan">
                            <div class="osahan-user-media-body">
                                <h6 class="mb-2"><?=$nome?></h6>
                                <p class="mb-0 text-black font-weight-bold">Açoes</p>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs flex-column border-0 pt-4 pl-4 pb-4" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="icofont-food-cart"></i> Orders</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="osahan-account-page-right shadow-sm bg-white p-4 h-100">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane  fade  active show" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                        <h4 class="font-weight-bold mt-0 mb-4">Agenda <?=$dia?></h4>
                        <?php 
                        	foreach($array as $data):
                          $fkUser = $data->fkUser;
                        ?>
                        <div class="bg-white card mb-4 order-list shadow-sm">
                            <div class="gold-members p-4">
                                <div class="media">
                                    <a >
                                        <img class="mr-4 rounded-pill" src="<?=Assests("img/avatar/$fkUser/")?><?=avatarUser($fkUser)?>" alt="Generic placeholder image">
                                    </a>
                                    <div class="media-body">
                                         <a href="#">
                                            <span class="float-right text-info">Status:  <?=statusAgendamento($data->status)?></span>
                                        </a>
                                        <h6 class="mb-2">
                                            <a ></a>
                                            <a class="text-primary"><?=$data->nome?></a>
                                        </h6>
                                        <p class="text-dark mb-1"> Codigo <?=$data->codigo?> <i class="icofont-clock-time"></i> </p>
                                        <p class="text-dark mb-1">Celular : <?=$data->celular?></p>
                                        <p class="text-dark mb-1">Serviço(s) : <?=$data->servicosSolicitados?></p>
                                        <p class="text-dark mb-1">Data / Horário : <?=date("d/m/Y", strtotime($data->data))?>, <?=date("H:i", strtotime($data->horario))?></p>
                                        <p class="mb-0 text-black text-primary pt-2"><span class="text-black font-weight-bold"> Valor total:</span> R$<?=$data->valorTotal?>
                                        </p>
                                        <hr>
                                        <div class="float-right">
                                            <?php 
                                              if($data->status == 1):
                                            ?>
                                            <button class="btn btn-primary btn-sm" onclick="ConfirmarAtendimento('<?=$data->codigo?>')"> Confirmar </button>
                                            <button class="btn btn-danger btn-sm" onclick="CancelarAtendimento('<?=$data->codigo?>')"> Cancelar </button>
                                            <?php 
                                             endif;
                                            ?>

                                            <?php 
                                             if($data->status == 2):
                                            ?>
                                              <button class="btn btn-danger btn-sm" onclick="CancelarAtendimento('<?=$data->codigo?>')"> Cancelar </button>
                                              <button class="btn btn-success btn-sm" onclick="ConcluirAtendimento('<?=$data->codigo?>')"> Concluir </button>
                                            <?php 
                                             endif;
                                            ?>
                                            
                                        </div>
                                        
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php 
                          endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
  var url = "<?=routerConfig()?>";
</script>
<script src="<?=Assests("assets/js/barbeiro/Atendimento.js")?>"></script>