<?=$this->layout('themes/sistemas', ['title' => $title]);?>



<style>
    .profile-info-list {
    padding: 0;
    margin: 0;
    list-style-type: none;
    }
    .friend-list,
    .img-grid-list {
        margin: -1px;
        list-style-type: none;
    }
    .profile-info-list > li.title {
        font-size: 0.625rem;
        font-weight: 700;
        color: #8a8a8f;
        padding: 0 0 0.3125rem;
    }
    .profile-info-list > li + li.title {
        padding-top: 1.5625rem;
    }
    .profile-info-list > li {
        padding: 0.625rem 0;
    }
    .profile-info-list > li .field {
        font-weight: 700;
    }
    .profile-info-list > li .value {
        color: #666;
    }
    .profile-info-list > li.img-list a {
        display: inline-block;
    }
    .profile-info-list > li.img-list a img {
        max-width: 2.25rem;
        -webkit-border-radius: 2.5rem;
        -moz-border-radius: 2.5rem;
        border-radius: 2.5rem;
    }
    .coming-soon-cover img,
    .email-detail-attachment .email-attachment .document-file img,
    .email-sender-img img,
    .friend-list .friend-img img,
    .profile-header-img img {
        max-width: 100%;
    }
    .table.table-profile th {
        border: none;
        color: #000;
        padding-bottom: 0.3125rem;
        padding-top: 0;
    }
    .table.table-profile td {
        border-color: #c8c7cc;
    }
    .table.table-profile tbody + thead > tr > th {
        padding-top: 1.5625rem;
    }
    .table.table-profile .field {
        color: #666;
        font-weight: 600;
        width: 25%;
        text-align: right;
    }
    .table.table-profile .value {
        font-weight: 500;
    }
    .profile-header {
        position: relative;
        overflow: hidden;
    }
    .profile-header .profile-header-cover {
        background: url() center no-repeat;
        background-size: 100% auto;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
    }
    .profile-header .profile-header-cover:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.25) 0, rgba(0, 0, 0, 0.85) 100%);
    }
    .profile-header .profile-header-content,
    .profile-header .profile-header-tab,
    .profile-header-img,
    body .fc-icon {
        position: relative;
    }
    .profile-header .profile-header-tab {
        background: #fff;
        list-style-type: none;
        margin: -1.25rem 0 0;
        padding: 0 0 0 8.75rem;
        border-bottom: 1px solid #c8c7cc;
        white-space: nowrap;
    }
    .profile-header .profile-header-tab > li {
        display: inline-block;
        margin: 0;
    }
    .profile-header .profile-header-tab > li > a {
        display: block;
        color: #000;
        line-height: 1.25rem;
        padding: 0.625rem 1.25rem;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.75rem;
        border: none;
    }
    .profile-header .profile-header-tab > li.active > a,
    .profile-header .profile-header-tab > li > a.active {
        color: #007aff;
    }
    .profile-header .profile-header-content:after,
    .profile-header .profile-header-content:before {
        content: "";
        display: table;
        clear: both;
    }
    .profile-header .profile-header-content {
        color: #fff;
        padding: 1.25rem;
    }
    body .fc th a,
    body .fc-ltr .fc-basic-view .fc-day-top .fc-day-number,
    body .fc-widget-header a {
        color: #000;
    }
    .profile-header-img {
        float: left;
        width: 7.5rem;
        height: 7.5rem;
        overflow: hidden;
        z-index: 10;
        margin: 0 1.25rem -1.25rem 0;
        padding: 0.1875rem;
        -webkit-border-radius: 0.25rem;
        -moz-border-radius: 0.25rem;
        border-radius: 0.25rem;
        background: #fff;
    }
    .profile-header-info h4 {
        font-weight: 500;
        margin-bottom: 0.3125rem;
    }
    .profile-container {
        padding: 1.5625rem;
    }
    @media (max-width: 967px) {
        .profile-header-img {
            width: 5.625rem;
            height: 5.625rem;
            margin: 0;
        }
        .profile-header-info {
            margin-left: 6.5625rem;
            padding-bottom: 0.9375rem;
        }
        .profile-header .profile-header-tab {
            padding-left: 0;
        }
    }
    @media (max-width: 767px) {
        .profile-header .profile-header-cover {
            background-position: top;
        }
        .profile-header-img {
            width: 3.75rem;
            height: 3.75rem;
            margin: 0;
        }
        .profile-header-info {
            margin-left: 4.6875rem;
            padding-bottom: 0.9375rem;
        }
        .profile-header-info h4 {
            margin: 0 0 0.3125rem;
        }
        .profile-header .profile-header-tab {
            white-space: nowrap;
            overflow: scroll;
            padding: 0;
        }
        .profile-container {
            padding: 0.9375rem 0.9375rem 3.6875rem;
        }
        .friend-list > li {
            float: none;
            width: auto;
        }
    }
    .profile-info-list {
        padding: 0;
        margin: 0;
        list-style-type: none;
    }
    .friend-list,
    .img-grid-list {
        margin: -1px;
        list-style-type: none;
    }
    .profile-info-list > li.title {
        font-size: 0.625rem;
        font-weight: 700;
        color: #8a8a8f;
        padding: 0 0 0.3125rem;
    }
    .profile-info-list > li + li.title {
        padding-top: 1.5625rem;
    }
    .profile-info-list > li {
        padding: 0.625rem 0;
    }
    .profile-info-list > li .field {
        font-weight: 700;
    }
    .profile-info-list > li .value {
        color: #666;
    }
    .profile-info-list > li.img-list a {
        display: inline-block;
    }
    .profile-info-list > li.img-list a img {
        max-width: 2.25rem;
        -webkit-border-radius: 2.5rem;
        -moz-border-radius: 2.5rem;
        border-radius: 2.5rem;
    }
    .coming-soon-cover img,
    .email-detail-attachment .email-attachment .document-file img,
    .email-sender-img img,
    .friend-list .friend-img img,
    .profile-header-img img {
        max-width: 100%;
    }
    .table.table-profile th {
        border: none;
        color: #000;
        padding-bottom: 0.3125rem;
        padding-top: 0;
    }
    .table.table-profile td {
        border-color: #c8c7cc;
    }
    .table.table-profile tbody + thead > tr > th {
        padding-top: 1.5625rem;
    }
    .table.table-profile .field {
        color: #666;
        font-weight: 600;
        width: 25%;
        text-align: right;
    }
    .table.table-profile .value {
        font-weight: 500;
    }

    .friend-list,
    .img-grid-list {
        margin: -1px;
        list-style-type: none;
    }
    .img-grid-list {
        padding: 0;
    }
    .img-grid-list > li {
        float: left;
        width: 20%;
        padding: 1px;
    }
    .img-grid-list > li a {
        position: relative;
        overflow: hidden;
        padding-top: 75%;
        display: block;
    }
    .img-grid-list > li a img {
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        left: 0;
        max-width: 100%;
    }
</style>

<div id="content" class="container-fluid p-0">
    <h2> Perfil Barbeiro</h2>
    <div class="profile-header">
        <div class="profile-header-cover"></div>
        <div class="profile-header-content">
            <div class="profile-header-img">
                <img src="<?=Assests("img/avatar/$fk/$avatar")?>" alt="" />
            </div>
            <div class="profile-header-info">
                <h4 class="m-t-sm"><?=$nome?></h4>
                <a href="<?=routerConfig()?>/app/agendar/barbeiro/<?=$token?>" class="btn btn-xs btn-primary mb-4">Agendar Agora</a>   
                <a href="#" class="btn btn-xs btn-warning mb-4">Avaliar</a>
            </div>
        </div>

    </div>

    <div class="profile-container">
        <div class="row row-space-20">
            <div class="col-md-8">
                <div class="tab-content p-0">
                    <div class="tab-pane active show" id="profile-photos">
                        <div class="m-b-10"><b>Galeria (Total de fotos: <?=totalGaleria($fk)?>)</b>    
                        </div>
                    </div>                    
                </div>
            </div>

            <div class="col-md-4 hidden-xs hidden-sm">
                <ul class="profile-info-list">
                    <li class="title">Informações</li>
                    <li>
                        <div class="field">Cidade/Estado:</div>
                        <div class="value"><?=$cidade?>/<?=$estado?></div>
                    </li>
                    <li>
                        <div class="field">Endereço</div>
                        <div class="value">
                           <b>Bairro: </b> <?=$bairro?>
                           <br>
                           <b>Rua: </b> <?=$endereco?>
                           <br>
                           <b>Número: </b> <?=$numero?>
                        </div>
                    </li>
                    <li>
                    <div class="field">Horário de atendimento</div>
                    <div class="value"><?=date("H:i", strtotime($horaInicial))?> Às <?=date("H:i", strtotime($horaFinal))?></div>
                    </li>
                    <li>
                        <div class="field">Telefone Contato</div>
                        <div class="value"><?=$celular?></div>
                    </li>
                    <li>
                        <div class="field">E-Mail Contato</div>
                        <div class="value"><?=$email?></div>
                    </li>
                   
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    var url = "<?=routerConfig()?>";
</script>

<script src="<?=Assests("assets/js/barbeiro/OnOff.js")?>"></script>