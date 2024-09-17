<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<?php 
 $ganhos = [];
 $pedentes = [];
 $cancelados = [];


 foreach($array as $soma){

    if($soma->status == 5){
        $ganhos[] = $soma->valorTotal;
      }

      if($soma->status == 1 OR $soma->status == 2 OR $soma->status == 4){
          $pedentes[] = $soma->valorTotal;
        }

      if($soma->status == 3){
          $cancelados[] = $soma->valorTotal;
        }


 }

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
    
    <div class="py-3 px-4">
        <h3 class="font-size-16 mb-0">Agenda  <?=$dia?></h3>
        <hr>
        <div class="p-8">
            <input type="date" id="date" class="form-control w-auto" onchange="redirectToPage()">
         </div>
        
        <hr>

      <div style="display: flex; gap: 10px;">
        <form action="<?=routerConfig()?>/barbearia/agenda/confirmar/todos" method="POST" id="confirmationForm1">
            <input type="hidden" name="data" value="<?=$data?>">
            <input type="hidden" name="fk" value="<?=$id?>"> 
            <button class="btn btn-secondary" id="submitButton1" onclick="handleSubmit1()"  type="submit">Confirmar Todos</button>
        </form>

        <form action="<?=routerConfig()?>/barbearia/agenda/cancelar/todos" method="POST" id="confirmationForm2">
            <input type="hidden" name="data" value="<?=$data?>">
            <input type="hidden" name="fk" value="<?=$id?>"> 
            <button class="btn btn-danger" id="submitButton2" onclick="handleSubmit2()" type="submit">Cancelar Todos</button>
        </form>

        <form action="<?=routerConfig()?>/barbearia/agenda/concluir/todos" method="POST" id="confirmationForm">
            <input type="hidden" name="data" value="<?=$data?>">
            <input type="hidden" name="fk" value="<?=$id?>"> 
            <button class="btn btn-success" id="submitButton" onclick="handleSubmit()" type="submit">Concluir Todos</button>
        </form>
      </div>


        <hr>
        <div style="display: flex; gap: 10px;">
        <h2><span class="badge text-bg-secondary">R$<?=array_sum($pedentes)?></span></h2>
       <h2><span class="badge text-bg-success">R$ <?=array_sum($ganhos)?></span></h2>
       <h2><span class="badge text-bg-danger">R$ <?=array_sum($cancelados)?></span></h2>
        </div>
      
</div>

    <div class="row">

    <?=validateSession("ConcluidosAgenda")?>

<div class="col-xl-8">
<div class="row">
    <?php 
     foreach($array as $data):
      $fkUser = $data->fkUser;
    ?>
  <div class="col-xl-6 mb-4">
    <div class="card">
      <div class="card-body" style="<?=statusAgendamentoColor($data->status)?>">
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <div class="ms-3">
             <p class="fw-bold mb-0"><?=$data->nome?></p>
              <p class="fw-bold mb-0">Status: <?=statusAgendamento($data->status)?></p>
              <p class="mb-0">Celular: <?=$data->celular?></p>
              <p class="mb-0">Serviço(s): <?=$data->servicosSolicitados?></p>
              <p class="mb-0">Horário: <?=date("H:i", strtotime($data->horario))?></p>
              <p class="fw-bold mb-0">Valor: R$<?=$data->valorTotal?></p>
            </div>
          </div>
          
        </div>
      </div>
      <div class="card-footer border-0 bg-body-tertiary p-2 d-flex justify-content-around">
      <?php 
                                              if($data->status == 1):
                                            ?>
                                            <button class="btn btn-primary " onclick="ConfirmarAtendimento('<?=$data->codigo?>')"> Confirmar </button>
                                            <button class="btn btn-danger " onclick="CancelarAtendimento('<?=$data->codigo?>')"> Cancelar </button>
                                            <?php 
                                             endif;
                                            ?>
    <?php 
                                             if($data->status == 2 OR $data->status == 4):
                                            ?>
                                              <button class="btn btn-danger " onclick="CancelarAtendimento('<?=$data->codigo?>')"> Cancelar </button>
                                              <button class="btn btn-success" onclick="ConcluirAtendimento('<?=$data->codigo?>')"> Concluir </button>
                                            <?php 
                                             endif;
                                            ?>

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
  var url = "<?=routerConfig()?>";
  
  function redirectToPage(){
    const selectedDate = document.getElementById('date').value;

    // Verifique se uma data foi selecionada
    if (selectedDate) {
        // Construa a URL com a data escolhida (exemplo de como passar o valor)
        const link = `${url}/app/barbearia/agenda/<?=$token?>/${selectedDate}`;

        // Redireciona para a página com a data
        window.location.href = link;
    }   
  }

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

function handleSubmit1() {

const submitButton = document.getElementById('submitButton1');
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
    const form = document.getElementById('confirmationForm1');
    form.submit();
}, 2000); // 2000 milissegundos = 2 segundos
}

function handleSubmit2() {

const submitButton = document.getElementById('submitButton2');
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
    const form = document.getElementById('confirmationForm2');
    form.submit();
}, 2000); // 2000 milissegundos = 2 segundos
}


</script>
<script src="<?=Assests("assets/js/barbeiro/Atendimento.js")?>"></script>