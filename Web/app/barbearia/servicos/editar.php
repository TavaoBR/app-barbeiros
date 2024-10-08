<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<style>
    body{margin-top:20px;
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
			<div class="my-5">
				<h3>Editar</h3>
				<hr>
			</div>
			<!-- Form START -->
			<form class="file-upload" id="confirmationForm" action="<?=routerConfig()?>/barbearia/servico/atualizar/<?=$dados->id?>" method="POST">
				<div class="row mb-5 gx-5">
                    <?=validateSession("UpdateService")?>
					<!-- Contact detail -->
					<div class="col-xxl-8 mb-5 mb-xxl-0">
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								<!-- First Name -->
								<div class="col-md-6">
									<label class="form-label">Serviço *</label>
									<input type="text" name="nome" class="form-control" placeholder="" aria-label="First name" value="<?=$dados->nome?>">
								</div>
								<!-- Last name -->
								<div class="col-md-6">
									<label class="form-label">Valor *</label>
									<input type="number" name="valor" class="form-control" placeholder="Exemplo: 30.5" value="<?=$dados->valor?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')">
								</div>
							</div> <!-- Row END -->
						</div>
					</div>
                    <div class="gap-3 d-md-flex justify-content-md-start text-center">
					    <button type="submit" id="submitButton" class="btn btn-primary btn-lg" onclick="handleSubmit()">Salvar</button>
				    </div>
					<!-- Upload profile -->
				</div> <!-- Row END -->
			</form> <!-- Form END -->
		</div>
	</div>
	</div>

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
        }, 2000);

        // 2000 milissegundos = 2 segundos
        }
    </script>