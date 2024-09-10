<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js'></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<?php 
$dataAtual = date('l');
 diaSemanaEmPortugues($dataAtual);

$nota = "";

    if($totalAvaliacao == 0){
       $nota .= "Nenhuma avaliação";    
    }else{
        $nota .= mediaNota($totalAvaliacao, $valorNotas);
    }

$diasDaSemana = [
    'Segunda-feira',
    'Terça-feira',
    'Quarta-feira',
    'Quinta-feira',
    'Sexta-feira',
    'Sábado',
    'Domingo'
];

// Mapear os dias da semana em português para os índices numéricos usados pelo PHP (0 para domingo, 1 para segunda, etc.)
$mapaDias = [
    
    'Segunda-feira' => 1,
    'Terça-feira' => 2,
    'Quarta-feira' => 3,
    'Quinta-feira' => 4,
    'Sexta-feira' => 5,
    'Sábado' => 6,
    'Domingo' => 7
];

// Obter o índice do dia atual (0-6, onde 0 é domingo)
$hojeIndice = date('w');
$hoje = date('Y-m-d'); // Data de hoje

$datasDaSemana = [];

foreach ($diasDaSemana as $dia) {
    $diaIndice = $mapaDias[$dia];
    $diferenca = $diaIndice - $hojeIndice;

    // Calcular a data do dia da semana atual
    $data = date('Y-m-d', strtotime("$diferenca days", strtotime($hoje)));

    // Se a diferença for negativa, ajustar para o dia correto na semana atual
    if ($diferenca < 0) {
        $data = date('Y-m-d', strtotime("$diferenca days", strtotime($hoje)));
    }

    $datasDaSemana[$dia] = [
        'nome' => $dia,
        'data' => $data
    ];
}


$data2 = [];

foreach($datasDaSemana as $d){
    $data2[] = $d['data'];
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





<div class="container-fluid">

    <div class="img" style="background-image: linear-gradient(150deg, rgba(63, 174, 255, .3)15%, rgba(63, 174, 255, .3)70%, rgba(63, 174, 255, .3)94%), url();
    height: 100px;background-size: cover;"></div>
    <div class="card social-prof">
        <div class="card-body">
            <div class="wrapper">
                <img src="<?=Assests("img/barbeiro/$id/$avatar")?>" alt="" class="user-profile">
                <h3><?=$nome?></h3>
                
                
            </div>
            <div class="row ">
                <div class="col-lg-12">
                <p>Avaliação: <?=$nota?></p>
                <p>Whatsapp: <?=$celular?></p>
                <p>Atendimento: <?=date("H:i", strtotime($horaInicial))?> Às <?=date("H:i", strtotime($horaFinal))?></p>
                <p>Bairro: <?=$bairro?>, Endereço: <?=$endereco?>, <?=$cidade?>/<?=$estado?></p>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
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
.activity-checkout {
    list-style: none
}

.activity-checkout .checkout-icon {
    position: absolute;
    top: -4px;
    left: -24px
}

.activity-checkout .checkout-item {
    position: relative;
    padding-bottom: 24px;
    padding-left: 35px;
    border-left: 2px solid #f5f6f8
}

.activity-checkout .checkout-item:first-child {
    border-color: #3b76e1
}

.activity-checkout .checkout-item:first-child:after {
    background-color: #3b76e1
}

.activity-checkout .checkout-item:last-child {
    border-color: transparent
}

.activity-checkout .checkout-item.crypto-activity {
    margin-left: 50px
}

.activity-checkout .checkout-item .crypto-date {
    position: absolute;
    top: 3px;
    left: -65px
}



.avatar-xs {
    height: 1rem;
    width: 1rem
}

.avatar-sm {
    height: 2rem;
    width: 2rem
}

.avatar {
    height: 3rem;
    width: 3rem
}

.avatar-md {
    height: 4rem;
    width: 4rem
}

.avatar-lg {
    height: 5rem;
    width: 5rem
}

.avatar-xl {
    height: 6rem;
    width: 6rem
}

.avatar-title {
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    background-color: #3b76e1;
    color: #fff;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    font-weight: 500;
    height: 100%;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 100%
}

.avatar-group {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    padding-left: 8px
}

.avatar-group .avatar-group-item {
    margin-left: -8px;
    border: 2px solid #fff;
    border-radius: 50%;
    -webkit-transition: all .2s;
    transition: all .2s
}

.avatar-group .avatar-group-item:hover {
    position: relative;
    -webkit-transform: translateY(-2px);
    transform: translateY(-2px)
}

.card-radio {
    background-color: #fff;
    border: 2px solid #eff0f2;
    border-radius: .75rem;
    padding: .5rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    display: block
}

.card-radio:hover {
    cursor: pointer
}

.card-radio-label {
    display: block
}

.edit-btn {
    width: 35px;
    height: 35px;
    line-height: 40px;
    text-align: center;
    position: absolute;
    right: 25px;
    margin-top: -50px
}

.card-radio-input {
    display: none
}

.card-radio-input:checked+.card-radio {
    border-color: #3b76e1!important
}


.font-size-16 {
    font-size: 16px!important;
}
.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

a {
    text-decoration: none!important;
}


.form-control {
    display: block;
    width: 100%;
    padding: 0.47rem 0.75rem;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #545965;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #e2e5e8;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.75rem;
    -webkit-transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
}

.edit-btn {
    width: 35px;
    height: 35px;
    line-height: 40px;
    text-align: center;
    position: absolute;
    right: 25px;
    margin-top: -50px;
}

.ribbon {
    position: absolute;
    right: -26px;
    top: 20px;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    color: #fff;
    font-size: 13px;
    font-weight: 500;
    padding: 1px 22px;
    font-size: 13px;
    font-weight: 500
}

</style>

<div class="container-fluid">

<h2>Agendar</h2>

    <div class="row">
    <form id="confirmationForm" action="<?=routerConfig()?>/agendar/barbearia/<?=$id?>" method="POST">    
        <div class="col-xl-12">
        <?=validateSession("MessageAgenda")?>
            <div class="card">
                <div class="card-body">
                    <ol class="activity-checkout mb-0 px-4 mt-3">
                        <li class="checkout-item">
                            <div class="avatar checkout-icon p-1">
                                <div class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bxs-receipt text-white font-size-20"></i>
                                </div>
                            </div>
                            <div class="feed-item-list">
                                <div>
                                    <h5 class="font-size-16 mb-1">Selecione um horário a partir de <?= horarioAtual();?></h5>
                                    <p class="text-muted text-truncate mb-4">Preencha e verifique se os dados estão corretos</p>
                                    <div class="mb-3">
                                        
                                            <input type="hidden" id="valorTotal" name="valorTotal" value="">
                                            <input type="hidden" id="itensEscolhidos" name="itensEscolhidos" value="">
                                            <input type="hidden" id="horarioEscolhidos" name="horarioEscolhidos" value="">
                                            
                                            <div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="billing-name">Nome</label>
                                                            <input type="text" name="nome" class="form-control" id="billing-name" placeholder="Enter name" value="<?=$nomeC?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="billing-phone">Telefone para contato</label>
                                                            <input type="text" name="celular" class="form-control" id="celular"  value="<?=$celularC?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="billing-phone">Serviço</label>
                                                            <select  id="itens" multiple class="form-control"> 
                                                                 <option value="" disabled> Selecione as opções de corte </option>
                                                                 <?php 
                                                                   foreach($servicos as $itens):
                                                                    if($itens->fk == $id):
                                                                 ?> 
                                                                     <option value="<?=$itens->valor?>" data-descricao="<?=$itens->nome?>">
                                                                         <?=$itens->nome?>
                                                                     </option>
                                                                 <?php 
                                                                   endif;
                                                                   endforeach;
                                                                 ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">



                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="billing-phone">Data</label>
                                                            <input type="date" name="data" id="data" class="form-control" min="<?=$hoje?>" >
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-16" id="horarios-disponiveis">

                                                    </div>

                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row my-4">
                <div class="col">
                    <a class=" text-muted">
                        <p>Valor Total: R$ <span id="total">0.00</span></p> 
                    </a>
                </div> <!-- end col -->
                <div class="col">
                    <div class="text-end mt-2 mt-sm-0">
                        <button class="btn btn-success" id="submitButton" onclick="handleSubmit()" type="submit">Agendar</button>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row-->
        </div>
    </form>
    </div>
    <!-- end row -->
    
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
        // JavaScript para garantir que o campo seja ajustado ao horário mínimo
        const inputTime = document.getElementById('horario');
        const minTime = inputTime.min;
        
        // Define o valor padrão para o horário mínimo
        inputTime.value = minTime;

        // Opcional: Você pode adicionar mais lógica para limitar a interface se necessário
    </script>

<script>


    $('#celular').mask("559999999999");

    $(document).ready(function() {

        $('#itens').select2();

            $('#itens').on('change', function() {
                let total = 0;
                let chosenItems = [];
                $('#itens option:selected').each(function() {
                    total += parseFloat($(this).val());
                    chosenItems.push($(this).data('descricao'));
                });
                $('#total').text(total.toFixed(2));
                $('#valorTotal').val(total.toFixed(2));
                
                $('#itensEscolhidos').val(chosenItems.join(', '));
            });
            

            
        });


        $(document).ready(function() {
            $('#data').on('change', function() {
                console.log('Evento de mudança detectado no input de data.');

                var dataSelecionada = $(this).val();
                console.log('Data selecionada:', dataSelecionada);

                $.ajax({
                    url: '<?=routerConfig()?>/barbearia/agenda/consultar/<?=$id?>',
                    type: 'POST',
                    data: { data: dataSelecionada },
                    dataType: 'html',
                    success: function(response) {
                        console.log('Resposta do servidor:', response); // Verificar a resposta recebida
                        $('#horarios-disponiveis').html(response);
                        console.log('Horários disponíveis atualizados na interface.');
                    },
                    error: function(xhr, status, error) {
                        console.error('Erro na requisição: Status ' + xhr.status);
                        console.error('Detalhes do erro:', error);
                    }
                });
            });
        });
        
</script>




<script>
    function handleSubmit() {

        const submitButton = document.getElementById('submitButton');
        submitButton.setAttribute('disabled', 'disabled');

        // Exibe o SweetAlert de carregamento
        Swal.fire({
            title: 'Enviando Requisição',
            text: 'Por favor, aguarde.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Aguarda 2 segundos antes de enviar o formulário
        setTimeout(() => {
            // Fecha o SweetAlert
            Swal.close();

            // Envia o formulário manualmente
            const form = document.getElementById('confirmationForm');
            form.submit();
        }, 2000); // 2000 milissegundos = 2 segundos
    }
</script>