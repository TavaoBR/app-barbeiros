<?=$this->layout('themes/site', ['title' => $title]);?>
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
				<h3>Cadastro</h3>
			</div>
			<!-- Form START -->
			<form class="file-upload" id="confirmationForm" action="<?=routerConfig()?>/cadastrar" method="POST" enctype="multipart/form-data">
				<div class="row mb-5 gx-5">
					<!-- Contact detail -->
					<div class="col-xxl-8 mb-5 mb-xxl-0">
          <?=validateSession("MessageRegister")?>
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								<h4 class="mb-4 mt-0">Informações</h4>
								<!-- First Name -->
								<div class="col-md-6">
									<label class="form-label">Nome </label>
									<input type="text" name="nome" class="form-control"  >
								</div>
								<!-- Last name -->
								<div class="col-md-6">
									<label class="form-label">Nome de usuario</label>
									<input type="text" name="usuario" class="form-control" >
								</div>
								<!-- Phone number -->
								<div class="col-md-6">
									<label class="form-label">E-mail</label>
									<input type="email" name="email" class="form-control" > 
								</div>
								<!-- Mobile number -->
								<div class="col-md-6">
									<label class="form-label">Celular</label>
                                    <input type="text" name="celular" id="celular" class="form-control" placeholder="DDD + Numero" >
								</div>

                                <div class="col-md-6">
									                  <label class="form-label">Estado</label>
                                        <select name="uf" id="estadoSelect" onchange="carregarMunicipios()" class="form-control mySelect2">
                                        <option value="">Selecione...</option>
                                      </select>
								                </div>

                                <div class="col-md-6">
								                    	<label class="form-label">Cidade</label>
                                        <select name="cidade" id="municipioSelect" class="form-control mySelect2">
                                          <option value="">Selecione um estado primeiro</option>
                                        </select>
								                </div>

                                <div class="col-md-6">
									<label for="exampleInputPassword1" class="form-label">Senha </label>
									<input type="password" name="senha" pattern=".*[-].*" class="form-control" onkeyup="validaSenha(this.value)" id="senha">
								</div>
								<!-- Confirm password -->
								<div class="col-md-6">
									<label for="exampleInputPassword3" class="form-label">Confirma Senha </label>
									<input type="password" name="confirmaSenha" pattern=".*[-].*" class="form-control" id="confirmaSenha" >
								</div>
                                 <div class="col-md-12">
                                        <label for="exampleInputPassword1" class="form-label">Regras da Senha </label>
                                      <ul style="list-style:none;">
                                            <li ><i class="fa-solid fa-xmark text-danger" id="minimoChar"></i> Precisa conter no minimo 8 caracteres </li>
                                            <li ><i class="fa-solid fa-xmark text-danger" id="numero"></i> Precisa conter número de 1 até 9</li>
                                            <li ><i class="fa-solid fa-xmark text-danger" id="maiuscula"></i> Precisa conter uma letra Maiúscula (A ... Z)</li>
                                            <li ><i class="fa-solid fa-xmark text-danger" id="minuscula"></i> Precisa conter letras Minúsculas (a ... z)</li>
                                            <li ><i class="fa-solid fa-xmark text-danger" id="simbolo"></i> Precisa conter caracter especial (@ ou ! ou & ou ?)</li>
                                        </ul>
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

        $('#celular').mask("559999999999");

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


    let minimoChar = document.getElementById("minimoChar");
    let numero = document.getElementById("numero");
    let maiuscula = document.getElementById("maiuscula");
    let minuscula = document.getElementById("minuscula");
    let simbolo =   document.getElementById("simbolo");

    function validaSenha(password){
       
        const caracteres = new RegExp('^(?=.*.{8,})');
        const number = new RegExp('(?=.*[0-9])');
        const upper = new RegExp('(?=.*[A-Z])');
        const lower = new RegExp('(?=.*[a-z])');
        const symbol = new RegExp('(?=.*[!@#\$%\^&\*\-\/])');

        if(caracteres.test(password)){
           minimoChar.classList.remove("fa-xmark", "text-danger");
           minimoChar.classList.add("fa-circle-check", "text-success");
        }else{
          minimoChar.classList.add("fa-xmark", "text-danger");
          minimoChar.classList.remove("fa-circle-check", "text-success");
        }

        if(lower.test(password)){
            minuscula.classList.remove("fa-xmark", "text-danger");
            minuscula.classList.add("fa-circle-check", "text-success");
        }else{
            minuscula.classList.add("fa-xmark", "text-danger");
            minuscula.classList.remove("fa-circle-check", "text-success");
        }

        if(number.test(password)){
            numero.classList.remove("fa-xmark", "text-danger");
            numero.classList.add("fa-circle-check", "text-success");
        }else{
            numero.classList.add("fa-xmark", "text-danger");
            numero.classList.remove("fa-circle-check", "text-success");
        }

        if(upper.test(password)){
            maiuscula.classList.remove("fa-xmark", "text-danger");
            maiuscula.classList.add("fa-circle-check", "text-success");
        }else{
            maiuscula.classList.add("fa-xmark", "text-danger");
            maiuscula.classList.remove("fa-circle-check", "text-success");
        }

        if(symbol.test(password)){
          simbolo.classList.remove("fa-xmark", "text-danger");
          simbolo.classList.add("fa-circle-check", "text-success");
        }else{
          simbolo.classList.add("fa-xmark", "text-danger");
          simbolo.classList.remove("fa-circle-check", "text-success");
        }

      }


    const estadoSelect = document.getElementById('estadoSelect');
    const municipioSelect = document.getElementById('municipioSelect');

    // Carregar estados ao carregar a página
    window.onload = carregarEstados;

    function carregarEstados() {
      // Faz a requisição para obter a lista de estados
      fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
        .then(response => response.json())
        .then(estados => {
          // Preenche o select de estados
          estados.forEach(estado => {
            const option = document.createElement('option');
            option.value = estado.sigla;
            option.textContent = estado.nome;
            estadoSelect.appendChild(option);
          });
        })
        .catch(error => console.error('Erro ao carregar estados:', error));
    }

    function carregarMunicipios() {
      const uf = estadoSelect.value;

      // Limpa o select de municípios
      municipioSelect.innerHTML = '<option value="">Carregando...</option>';

      if (uf) {
        // Faz a requisição para obter a lista de municípios do estado selecionado
        fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/municipios`)
          .then(response => response.json())
          .then(municipios => {
            // Limpa o select de municípios
            municipioSelect.innerHTML = '<option value="">Selecione...</option>';

            // Preenche o select de municípios
            municipios.forEach(municipio => {
              const option = document.createElement('option');
              option.value = municipio.nome;
              option.textContent = municipio.nome;
              municipioSelect.appendChild(option);
            });
          })
          .catch(error => console.error('Erro ao carregar municípios:', error));
      } else {
        // Se nenhum estado estiver selecionado, exibe uma mensagem no select de municípios
        municipioSelect.innerHTML = '<option value="">Selecione um estado primeiro</option>';
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

    </script>