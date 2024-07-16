<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<?php 
 if($conta > 0):
?>
<style>
    body{
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
</style>
<?php 
 if($contaHorario < 1):
?>

<div class="container-fluid">
  <h2> Cadastrar Horários de atendimento</h2>
    <div class="main-body">
    
    
          <div class="row gutters-sm">

            <div class="col-md-8">
              <?=validateSession("Message")?>
            <form action="<?=routerConfig()?>/barbeiro/atendimento/cadastro/horarios/<?=$id?>" method="POST" enctype="multipart/form-data">
              <div class="card mb-3">
                <div class="card-body">

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Horário de abertura</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="time" name="inicial" id="start-time" class="form-control"  >
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Horário de fechamento</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="time" name="final" id="end-time" class="form-control" >
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                       <button class="btn btn-success"  type="submit">Salvar</button>
                     </div>
                  </div>
                </div>
              </div>
              </form>
            </div>

            

          </div>

        </div>
    </div>


    <script>
        // Remove as opções de tempo com "30" minutos
        function removeHalfHourOptions(inputId) {
            const timeInput = document.getElementById(inputId);
            const dataList = document.createElement('datalist');
            dataList.id = inputId + '-list';
            for (let hour = 0; hour < 24; hour++) {
                for (let minute of [0, 30]) {
                    if (minute === 30) continue;
                    const option = document.createElement('option');
                    option.value = `${String(hour).padStart(2, '0')}:${String(minute).padStart(2, '0')}`;
                    dataList.appendChild(option);
                }
            }
            timeInput.setAttribute('list', dataList.id);
            document.body.appendChild(dataList);
        }

        document.addEventListener('DOMContentLoaded', () => {
            removeHalfHourOptions('start-time');
            removeHalfHourOptions('end-time');
        });
    </script>

<?php 
else:
?>

<h2> Você ja cadastrou seus horarios de atendimento</h2>

<?php 
endif;
?>



<?php 
else:
?>
 <h2> Nenhum dado encontrado</h2>
<?php 
 endif;
?>

