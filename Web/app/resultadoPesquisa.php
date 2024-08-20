<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<style>
    .card-box {
    padding: 20px;
    border-radius: 3px;
    margin-bottom: 30px;
    background-color: #fff;
}

.social-links li a {
    border-radius: 50%;
    color: rgba(121, 121, 121, .8);
    display: inline-block;
    height: 30px;
    line-height: 27px;
    border: 2px solid rgba(121, 121, 121, .5);
    text-align: center;
    width: 30px
}

.social-links li a:hover {
    color: #797979;
    border: 2px solid #797979
}
.thumb-lg {
    height: 125px;
    width: 125px;
}
.img-thumbnail {
    padding: .25rem;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: .25rem;
    max-width: 100%;
    height: auto;
}
.text-pink {
    color: #ff679b!important;
}
.btn-rounded {
    border-radius: 2em;
}
.text-muted {
    color: #98a6ad!important;
}
h4 {
    line-height: 22px;
    font-size: 18px;
}
</style>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4"><a class="btn btn-custom waves-effect waves-light mb-4" data-animation="fadein" data-plugin="custommodal" data-overlayspeed="200" data-overlaycolor="#36404a"><i class="mdi mdi-plus"></i> Resultado da pesquisa: <?=$nomePesquisa?></a></div>
            <!-- end col -->
        </div>
        <div class="row">
        <div class="col-sm-4"><a class="btn btn-custom waves-effect waves-light mb-4" data-animation="fadein" data-plugin="custommodal" data-overlayspeed="200" data-overlaycolor="#36404a"><i class="mdi mdi-plus"></i> Total de itens achados: <?=$total?></a></div>
        </div>
        <!-- end row -->


        <div class="row">
        <?php 
         foreach($data as $dado):
        ?>
            <div class="col-lg-4">
                <div class="text-center card-box">
                    <div class="member-card pt-2 pb-2">
                        <div class="thumb-lg member-thumb mx-auto"><img src="https://bootdey.com/img/Content/avatar/avatar2.png" class="rounded-circle img-thumbnail" alt="profile-image"></div>
                        <div class="">
                            <h4><?=$dado->nomeBarbeiro?></h4>
                            <p class="text-muted"><?=$dado->cidade?> - <?=$dado->estado?></p>
                        </div>
                        <a href="<?=routerConfig()?>/app/barbeiro/perfil/<?=$dado->token?>" class="btn btn-primary mt-3 btn-rounded waves-effect w-md waves-light">Perfil</a>
                        <div class="mt-4">
                            <!--<div class="row">
                                <div class="col-4">
                                    <div class="mt-3">
                                        <h4>Cidade/UF</h4>
                                        <p class="mb-0 text-muted"></p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mt-3">
                                        <h4>Bairro</h4>
                                        <p class="mb-0 text-muted"></p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mt-3">
                                        <h4>Endereço</h4>
                                        <p class="mb-0 text-muted"></p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mt-3">
                                        <h4>Numero do estabelecimento</h4>
                                        <p class="mb-0 text-muted"></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="mt-3">
                                        <h4>1125</h4>
                                        <p class="mb-0 text-muted">Total Transactions</p>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
            <?php 
              endforeach;
            ?>
            <!-- end col -->
            <!-- end col -->
            <!-- end col -->
        </div>


    </div>
    <!-- container -->
</div>