<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?php 



$pontos = 15236;
$pontosFormatados = formatarNumero($pontos);


?>

<style>
    body{
    margin-top:20px;
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


<div class="container-fluid">
    <div class="main-body">
    
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?=Assests("img/avatar/$id/$avatar")?>" id="imagePreview" alt="Sem avatar" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?=$nome?></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            

            <div class="col-md-8">
              <?=validateSession("MessageUpdate")?>
            <form action="<?=routerConfig()?>/atualizar/info/<?=getSession("id")?>" id="confirmationForm" method="POST" enctype="multipart/form-data">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nome de usuario</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" name="usuario" class="form-control" value="<?=$usuario?>" required>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nome</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" name="nome" class="form-control" value="<?=$nome?>" required>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Estado</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <select name="uf" id="estadoSelect" onchange="carregarMunicipios()" class="form-control mySelect2">
                        <option value="<?=$uf?>"><?=$uf?></option>
                      </select>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Cidade</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <select name="cidade" id="municipioSelect" class="form-control mySelect2">
                        <option value="<?=$cidade?>"><?=$cidade?></option>
                      </select>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Senha <i class="fa-solid fa-eye text-primary" id="visualizarSenha" onclick="toggleSenhaVisibility()" style="cursor:pointer"></i></h6>
                    </div>
                    <div class="col-sm-9 text-secondary">  
                      <input type="password"  class="form-control" value="<?=$senha?>" id="senha" readonly>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="email" name="email" class="form-control" value="<?=$email?>" required> 
                    </div>
                  </div>

                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Celular</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" name="celular" id="celular" class="form-control" value="<?=$celular?>" required>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Avatar</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="file" name="avatar" class="form-control" accept="image/*" id="fileInput">
                    </div>
                  </div>

                  <hr>

                  <div class="row">
                    <div class="col-sm-12">
                      <button class="btn btn-info" id="submitButton" onclick="handleSubmit()"  type="submit">Salvar</button>
                      <a class="btn btn-danger " href="<?=routerConfig()?>/app/perfil/trocar/senha">Trocar senha</a>
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

        $('#celular').mask("559999999999");

        $('.mySelect2').select2();

        // Aqui está a solução
        $('.mySelect2').on('select2:unselect', function(evt) {
        console.log(evt.params.data);
        })

        document.getElementById('fileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imagePreview = document.getElementById('imagePreview');
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });


        function toggleSenhaVisibility() {
        var senhaInput = document.getElementById("senha");
        var visualizarSenhaIcon = document.getElementById("visualizarSenha");

        if (senhaInput.type === "password") {
            senhaInput.type = "text";
            visualizarSenhaIcon.classList.remove("fa-eye");
            visualizarSenhaIcon.classList.add("fa-eye-slash");
        } else {
            senhaInput.type = "password";
            visualizarSenhaIcon.classList.remove("fa-eye-slash");
            visualizarSenhaIcon.classList.add("fa-eye");
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



