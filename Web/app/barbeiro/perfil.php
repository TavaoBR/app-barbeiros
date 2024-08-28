<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<?php 
    if($totalAvaliacao == 0){
        $nota .= "Nenhuma avaliação";    
     }else{
         $nota .= mediaNota($totalAvaliacao, $valorNotas);
     }
?>


<style>
    /*social */
.card-one {
    position: relative;
    width: 300px;
    background: #fff;
    box-shadow: 0 10px 7px -5px rgba(0, 0, 0, 0.4);
}
.card {
    margin-bottom: 35px;
    box-shadow: 0 10px 20px 0 rgba(26, 44, 57, 0.14);
    border: none;
}

.follower-wrapper li {
    list-style-type: none;
    color: #fff;
    display: inline-block;
    float: left;
    margin-right: 20px;
}

.social-profile {
    color: #fff;
}

.social-profile a {
    color: #fff;
}

.social-profile {
    position: relative;
    margin-bottom: 150px;
}

.social-profile .user-profile {
    position: absolute;
    bottom: -75px;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    left: 50px;
}

.social-nav {
    position: absolute;
    bottom: 0;
}

.social-prof {
    color: #333;
    text-align: center;
}

.social-prof .wrapper {
    width: 70%;
    margin: auto;
    margin-top: -100px;
}

.social-prof img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    margin-bottom: 20px;
    border: 5px solid #fff;
    /*border: 10px solid #70b5e6ee;*/
}

.social-prof h3 {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 0;
}

.social-prof p {
    font-size: 18px;
}

.social-prof .nav-tabs {
    border: none;
}

.card .nav>li {
    position: relative;
    display: block;
}

.card .nav>li>a {
    position: relative;
    display: block;
    padding: 10px 15px;
    font-weight: 300;
    border-radius: 4px;
}

.card .nav>li>a:focus,
.card .nav>li>a:hover {
    text-decoration: none;
    background-color: #eee;
}

.card .s-nav>li>a.active {
    text-decoration: none;
    background-color: #3afe;
    color: #fff;
}

.text-blue {
    color: #3afe;
}

ul.friend-list {
    margin: 0;
    padding: 0;
}

ul.friend-list li {
    list-style-type: none;
    display: flex;
    align-items: center;
}

ul.friend-list li:hover {
    background: rgba(0, 0, 0, .1);
    cursor: pointer;
}

ul.friend-list .left img {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    margin-right: 20px;
}

ul.friend-list li {
    padding: 10px;
}

ul.friend-list .right h3 {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 0;
}

ul.friend-list .right p {
    font-size: 11px;
    color: #6c757d;
    margin: 0;
}

.social-timeline-card .dropdown-toggle::after {
    display: none;
}

.info-card h4 {
    font-size: 15px;
}

.info-card h2 {
    font-size: 18px;
    margin-bottom: 20px;
}

.social-about .social-info {
    font-size: 16px;
    margin-bottom: 20px;
}

.social-about p {
    margin-bottom: 20px;
}

.info-card i {
    color: #3afe;
}

.card-one {
    position: relative;
    width: 300px;
    background: #fff;
    box-shadow: 0 10px 7px -5px rgba(0, 0, 0, 0.4);
}

.card-one .header {
    position: relative;
    width: 100%;
    height: 60px;
    background-color: #3afe;
}

.card-one .header::before,
.card-one .header::after {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: inherit;
}

.card-one .header::before {
    -webkit-transform: skewY(-8deg);
    transform: skewY(-8deg);
    -webkit-transform-origin: 100% 100%;
    transform-origin: 100% 100%;
}

.card-one .header::after {
    -webkit-transform: skewY(8deg);
    transform: skewY(8deg);
    -webkit-transform-origin: 0 100%;
    transform-origin: 0 100%;
}

.card-one .header .avatar {
    position: absolute;
    left: 50%;
    top: 30px;
    margin-left: -50px;
    z-index: 5;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    background: #ccc;
    border: 3px solid #fff;
}

.card-one .header .avatar img {
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    width: 100px;
    height: auto;
}

.card-one h3 {
    position: relative;
    margin: 80px 0 30px;
    text-align: center;
}

.card-one h3::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    margin-left: -15px;
    width: 30px;
    height: 1px;
    background: #000;
}

.card-one .desc {
    padding: 0 1rem 2rem;
    text-align: center;
    line-height: 1.5;
    color: #777;
}

.card-one .contacts {
    width: 200px;
    max-width: 100%;
    margin: 0 auto 3rem;
}

.card-one .contacts a {
    display: block;
    width: 33.333333%;
    float: left;
    text-align: center;
    color: #c8c;
}

.card-one .contacts a:hover {
    color: #333;
}

.card-one .contacts a:hover .fa::before {
    color: #fff;
}

.card-one .contacts a:hover .fa::after {
    width: 100%;
    height: 100%;
}

.card-one .contacts a .fa {
    position: relative;
    width: 40px;
    height: 40px;
    line-height: 39px;
    overflow: hidden;
    text-align: center;
    font-size: 1.3em;
}

.card-one .contacts a .fa:before {
    position: relative;
    z-index: 1;
}

.card-one .contacts a .fa::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    background: #c8c;
    transition: width .3s, height .3s;
}

.card-one .contacts a:last-of-type .fa {
    line-height: 36px;
}

.card-one .footer {
    position: relative;
    padding: 1rem;
    background-color: #3afe;
    text-align: center;
}

.card-one .footer a {
    padding: 0 1rem;
    color: #e2e2e2;
    transition: color .4s;
}

.card-one .footer a:hover {
    color: #c8c;
}

.card-one .footer::before {
    content: '';
    position: absolute;
    top: -27px;
    left: 50%;
    margin-left: -15px;
    border: 15px solid transparent;
    border-bottom-color: #3afe;
}

#gallery li {
    width: 24%;
    float: left;
    margin: 6px;
   
}


/*end social*/
</style>





<div class="container">

    <div class="img" style="background-image: linear-gradient(150deg, rgba(63, 174, 255, .3)15%, rgba(63, 174, 255, .3)70%, rgba(63, 174, 255, .3)94%), url();
    height: 150px;background-size: cover;"></div>
    <div class="card social-prof">
        <div class="card-body">
            <div class="wrapper">
                <img src="<?=Assests("img/barbeiro/$id/$avatar")?>" alt="" class="user-profile">
                <h3><?=$nome?></h3>
                <p>Whatsapp: <?=$celular?></p>
            </div>
            <div class="row ">
                <div class="col-lg-12">
                    <ul class=" nav nav-tabs justify-content-center s-nav">
                        <li><a >Editar</a></li>
                        <li><a class="active" >Perfil</a></li>
                        <li><a href="<?=routerConfig()?>/app/barbeiro/agenda/<?=$token?>/<?=dataAtual()?>">Agenda</a></li>
                        <li><a >Serviços</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body info-card social-about">
                    <h2 class="text-blue">Sobre</h2>
                    <h4 class="mb-3"><strong>Informações Pessoais</strong></h4>
                    <div class="row">
                        <div class="col-6">
                            <div class="social-info">
                                <i class="fas fa-regular fa-clock mr-2"></i>
                                <span>Atendimento: <?=date("H:i", strtotime($horaInicial))?> Às <?=date("H:i", strtotime($horaFinal))?></span>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="social-info">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <span>Cidade/Estado: <?=$cidade?>/<?=$estado?> </span>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                    <div class="col-6">
                            <div class="social-info">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <span>Bairro: <?=$bairro?></span>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="social-info">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                <span>Endereço: <?=$endereco?> - <?=$numero?></span>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card info-card">
                <div class="card-body">
                    <h2 class="text-blue">Avaliação</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Nota</h4>
                            <div class="mb-3">
                            <?=$nota?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="row">
    <div class="col-lg-6">
            <div class="card info-card">
                <div class="card-body">
                    <h2 class="text-blue">Comentários</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <h4><strong>Creative Arts - 2016-19</strong></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                        </div>
                        <div class="col-lg-6">
                            <h4><strong>Web Media - 2014-16</strong></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                        </div>
                        <div class="col-lg-6">
                            <h4><strong>Global Infosoft - 2012-14</strong></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                        </div>
                        <div class="col-lg-6">
                            <h4><strong>Freelancer - 2011-12</strong></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card info-card">
                <div class="card-body">
                    <h2 class="text-blue">Work</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <h4><strong>Creative Arts - 2016-19</strong></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                        </div>
                        <div class="col-lg-6">
                            <h4><strong>Web Media - 2014-16</strong></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                        </div>
                        <div class="col-lg-6">
                            <h4><strong>Global Infosoft - 2012-14</strong></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                        </div>
                        <div class="col-lg-6">
                            <h4><strong>Freelancer - 2011-12</strong></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--->
</div>