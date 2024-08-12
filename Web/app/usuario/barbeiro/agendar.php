<?=$this->layout('themes/sistemas', ['title' => $title]);?>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css'>

<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js'></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<?php 
$dataAtual = date('l');
 diaSemanaEmPortugues($dataAtual)
?>

<?php 
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

    <div class="row">
    <form action="<?=routerConfig()?>/usuario/agendar/barbeiro/<?=$id?>" method="POST">    
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
                                    <h5 class="font-size-16 mb-1">Agendar</h5>
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
                                                            <input type="text" name="nome" class="form-control" id="billing-name" placeholder="Enter name" value="<?=$nome?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="billing-phone">Telefone para contato</label>
                                                            <input type="text" name="celular" class="form-control" id="celular"  value="<?=$celular?>">
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

                                                    <div class="col-lg-12" id="horarios-disponiveis">

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
                        <button class="btn btn-success" type="submit">Agendar</button>
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


    $('#celular').mask("+9999999999999");

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
        
</script>

<script>
        $(document).ready(function() {
            $('#data').on('change', function() {
                console.log('Evento de mudança detectado no input de data.');

                var dataSelecionada = $(this).val();
                console.log('Data selecionada:', dataSelecionada);

                $.ajax({
                    url: '<?=routerConfig()?>/barbeiro/agenda/consultar/<?=$id?>',
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








