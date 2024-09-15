<?=$this->layout('themes/site', ['title' => $title]);?>



<style>
    body{margin-top:20px;}
.error-page .error-inner h1 {
	font-size: 60px;
	text-shadow: 3px 5px 2px #3333;
	color: #006DFE;
	font-weight: 700;
}
.error-page .error-inner h1 span {
	display: block;
	font-size: 25px;
	color: #333;
	font-weight: 600;
	text-shadow: none;
}
.error-page .error-inner p {
	padding: 20px 15px;
}
.error-page .search-form {
	width: 100%;
	position: relative;
}
.error-page .search-form input {
	width: 400px;
	height: 25px;
	padding: 0px 78px 0 30px;
	border: none;
	border-radius: 5px;
	display: inline-block;
	margin-right: 10px;
	font-weight:400;
	font-size:14px;
}

.error-page .search-form .btn {
	width: 80px;
	height: 50px;
	border-radius: 5px;
	cursor: pointer;
	background: #006DFE;
	display: inline-block;
	position: relative;
	top: -2px;
    color: #eee;
}
.error-page .search-form .btn i{
	font-size:16px;
}
.error-page .search-form .btn:hover{
	background:#333;
}
</style>

<section class="error-page section">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6 offset-lg-3 col-12">
				<!-- Error Inner -->
				<div class="error-inner">
					<h1>Avalie seu atendimento</h1>
					<?=validateSession("Avaliacao")?>
					<form class="search-form" id="confirmationForm" action="<?=routerConfig()?>/atendimento/publico/avaliar" method="POST">
                        <input type="hidden" name="codigo" value="<?=$codigo?>">
					    <label for="codigo">Codigo:&nbsp;&nbsp;</label>
						<input placeholder="Exemplo do codigo: 9CTKZ9U" type="text" class="form-control" value="<?=$codigo?>" disabled>
                        <hr>
                        <label for="nota">Nota:&nbsp;&nbsp;&nbsp;</label>
						<select name="nota" id="" class="form-control">
							<option value="">Selecione uma opção</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
                        <br>
                        <br>
						<button class="btn" id="submitButton" type="button" onclick="handleSubmit()">Avaliar</button>
					</form>
				</div>
				<!--/ End Error Inner -->
			</div>
		</div>
	</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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