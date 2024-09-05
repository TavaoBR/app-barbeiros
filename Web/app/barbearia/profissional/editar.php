<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
  body{
    margin-top:40px;
    color: #9b9ca1;
    }
  .bg-secondary-soft {
    background-color: rgba(208, 212, 217, 0.1) !important;
}
.rounded {
    border-radius: 5px !important;
}
.py-5 {
    padding-top: 3rem !important;
    padding-bottom: 3rem !important;
}
.px-4 {
    padding-right: 1.5rem !important;
    padding-left: 1.5rem !important;
}
.file-upload .square {
    height: 250px;
    width: 250px;
    margin: auto;
    vertical-align: middle;
    border: 1px solid #e5dfe4;
    background-color: #fff;
    border-radius: 5px;
}
.text-secondary {
    --bs-text-opacity: 1;
    color: rgba(208, 212, 217, 0.5) !important;
}
.btn-success-soft {
    color: #28a745;
    background-color: rgba(40, 167, 69, 0.1);
}
.btn-danger-soft {
    color: #dc3545;
    background-color: rgba(220, 53, 69, 0.1);
}
.form-control {
    display: block;
    width: 100%;
    padding: 0.5rem 1rem;
    font-size: 0.9375rem;
    font-weight: 400;
    line-height: 1.6;
    color: #29292e;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #e5dfe4;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 5px;
    -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
}
</style>





    <div class="container">

    
   
<div class="row">
		<div class="col-12">
			<!-- Page title -->
			<div class="my-5 ">
				<h3>Editar</h3>
			</div>
			<!-- Form START -->
			<form class="file-upload" id="confirmationForm" action="<?=routerConfig()?>/barbeiro/editar/<?=$dados->id?>" method="POST" enctype="multipart/form-data">
				<div class="row mb-5 gx-5">
					<!-- Contact detail -->
					<div class="col-xxl-8 mb-5 mb-xxl-0">
                        <?=validateSession("UpdateBarbeiro")?>
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								<h4 class="mb-4 mt-0">Informações</h4>
								<!-- First Name -->
								<div class="col-md-6">
									<label class="form-label">Nome </label>
									<input type="text" name="nome" class="form-control"  value="<?=$dados->nome?>">
								</div>
								<!-- Mobile number -->
								<div class="col-md-6">
									<label class="form-label">Celular</label>
                                    <input type="text" name="celular" id="celular" class="form-control" placeholder="DDD + Numero" value="<?=$dados->celular?>">
								</div>

                                <div class="col-md-6">
									<label class="form-label">Status</label>
                                        <select name="status" id="" class="form-control">
                                        <option value="<?=$dados->status?>"><?=statusBarbeiro($dados->status)?></option>
                                        <option value="0">Selecione</option>
                                        <option value="1">Ativo</option>
                                        <option value="2">Inativo</option>
                                        <option value="3">Folga</option>
                                    </select>
								</div>

                                <div class="col-md-6">
                                <label class="form-label">Avatar Atual</label>
                                <br>
                                <img src="<?=Assests("img/barbeiro/profissional/$dados->id/$dados->avatar")?>"  alt="Sem avatar"  width="250" height="250">
                                </div>
							</div> <!-- Row END -->
						</div>
					</div>

					<!-- Upload profile -->
					<div class="col-xxl-4">
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								<h4 class="mb-4 mt-0">Avatar</h4>
								<div class="text-center">
									<!-- Image upload -->
									<div class="square position-relative display-2 mb-3">
                    <img src="" id="imagePreview" alt="Sem avatar"  width="250" height="250">
									</div>
									<!-- Button -->
									<input type="file" id="customFile" accept="image/*" name="avatar" hidden="">
                  <label class="btn btn-success-soft btn-block" for="customFile">Procurar imagem</label>
									<!-- Content -->
									<p class="text-muted mt-3 mb-0">De preferência uma foto sua</p>
								</div>
							</div>
						</div>
					</div>

                    

				</div> <!-- Row END --> <!-- Row END -->
				<!-- button -->
				<div class="gap-3 d-md-flex justify-content-md-start text-center">
					<button class="btn btn-success btn-lg" id="submitButton" onclick="handleSubmit()">Salvar</button>
				</div>
			</form> <!-- Form END -->
		</div>
	</div>
	</div>

  <br>


    <script>

        $('#celular').mask("5599999999999");

        $('.mySelect2').select2();

        // Aqui está a solução
        $('.mySelect2').on('select2:unselect', function(evt) {
        console.log(evt.params.data);
        })

        document.getElementById('customFile').addEventListener('change', function(event) {
          const file = event.target.files[0];
          if (file) {
              // Verifica o tamanho do arquivo
              const maxSizeInMB = 2;
              const maxSizeInBytes = maxSizeInMB * 1024 * 1024;
              
              if (file.size > maxSizeInBytes) {
                  alert('O arquivo é muito grande. O tamanho máximo permitido é de 2 MB.');
                  return;
              }

              const reader = new FileReader();
              reader.onload = function(e) {
                  const imagePreview = document.getElementById('imagePreview');
                  imagePreview.src = e.target.result;
                  imagePreview.style.display = 'block';
              }
              reader.readAsDataURL(file);
          }
      });


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