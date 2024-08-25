<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<style>
body{padding-top:20px;
background:#f5f5f5;
}
.img-fluid {
    max-width: 100%;
    height: auto;
}

.card {
    margin-bottom: 30px;
}

.overflow-hidden {
    overflow: hidden!important;
}

.p-0 {
    padding: 0!important;
}

.mt-n5 {
    margin-top: -3rem!important;
}

.linear-gradient {
    background-image: linear-gradient(#50b2fc,#f44c66);
}

.rounded-circle {
    border-radius: 50%!important;
}

.align-items-center {
    align-items: center!important;
}

.justify-content-center {
    justify-content: center!important;
}

.d-flex {
    display: flex!important;
}

.rounded-2 {
    border-radius: 7px !important;
}

.bg-light-info {
    --bs-bg-opacity: 1;
    background-color: rgba(235,243,254,1)!important;
}

.card {
    margin-bottom: 30px;
}

.position-relative {
    position: relative!important;
}

.shadow-none {
    box-shadow: none!important;
}

.overflow-hidden {
    overflow: hidden!important;
}

.border {
    border: 1px solid #ebf1f6 !important;
}

.fs-6 {
    font-size: 1.25rem!important;
}

.mb-2 {
    margin-bottom: 0.5rem!important;
}

.d-block {
    display: block!important;
}

a {
    text-decoration: none;
}

.user-profile-tab .nav-item .nav-link.active {
    color: #5d87ff;
    border-bottom: 2px solid #5d87ff;
}

.mb-9 {
    margin-bottom: 20px!important;
}

.fw-semibold {
    font-weight: 600!important;
}
.fs-4 {
    font-size: 1rem!important;
}

.card, .bg-light {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
}

.fs-2 {
    font-size: .75rem!important;
}

.rounded-4 {
    border-radius: 4px !important;
}

.ms-7 {
    margin-left: 30px!important;
}
</style>


<div class="container-fluid">

  <div class="tab-content" id="pills-tabContent">

    <div class="tab-pane fade show active" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab" tabindex="0">
      <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
        <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Resultado <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2"><?=$total?></span></h3>
      </div>
      <div class="row">
      <?php 
         foreach($result as $dado):
            $id = $dado->id;
            $avatar = $dado->avatarBarbeiro;
        ?>
        <div class=" col-md-6 col-xl-4">
          <div class="card">
            <div class="card-body p-4 d-flex align-items-center gap-3">
              <img src="<?=Assests("img/barbeiro/$id/$avatar")?>" alt="" class="rounded-circle" width="40" height="40">
              <div>
                <h5 class="fw-semibold mb-0"><?=$dado->nomeBarbeiro?></h5>
                    <span class="fs-2 d-flex align-items-center"><i class="ti ti-map-pin text-dark fs-3 me-1"></i>Nota: 8.5</span>
                    <span class="fs-2 d-flex align-items-center"><i class="ti ti-map-pin text-dark fs-3 me-1"></i><?=$dado->cidade?> - <?=$dado->estado?></span>
              </div>
              <a href="<?=routerConfig()?>/app/barbeiro/perfil/<?=$dado->token?>" class="btn btn-primary py-1 px-2 ms-auto">Perfil</a>
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