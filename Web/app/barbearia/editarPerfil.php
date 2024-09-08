<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
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

<div class="container">
    <div class="main-body">
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?=Assests("img/barbeiro/$dados->id/$dados->avatarBarbeiro")?>" id="imagePreview" alt="Admin" class="rounded-circle" width="150">
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-md-8">
            <?=validateSession("UpdatePerfilBarbearia")?>
            <form method="POST" action="<?=routerConfig()?>/barbearia/perfil/editar/<?=$dados->id?>" id="confirmationForm" enctype="multipart/form-data">
              <input type="hidden" name="uf" id="ufHidden" value="<?=$dados->estado?>">
              <input type="hidden" name="cidade" id="cidadeHidden" value="<?=$dados->cidade?>">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nome Barbearia</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" name="nome" class="form-control" value="<?=$dados->nomeBarbeiro?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Celular Comercial</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" id="celular" name="celular" class="form-control" value="<?=$dados->celular?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Estado</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?=$dados->estado?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Cidade</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?=$dados->cidade?>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Alterar Estado</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <select  id="estadoSelect" onchange="carregarMunicipios()" class="form-control mySelect2">
                        <option value="">Selecione...</option>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Alterar Cidade</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <select  id="municipioSelect" onchange="atualizarHidden()" class="form-control mySelect2">
                        <option value="">Selecione um estado primeiro</option>
                      </select>
                    </div>
                  </div>
                  <hr>

                  
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Bairro</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" class="form-control" value="<?=$dados->bairro?>" name="bairro">
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Endereço Completo</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" class="form-control" value="<?=$dados->endereco?>" name="endereco">
                    </div>
                  </div>

                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Avatar Novo</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="file" class="form-control" id="customFile" accept="image/*" name="avatar">
                    </div>
                  </div>

                  <hr>

                  <div class="row">
                    <div class="col-sm-12">
                      <button class="btn btn-success" onclick="handleSubmit()"  type="submit">Salvar</button>
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


    function atualizarHidden() {
      var estadoSelect = document.getElementById('estadoSelect');
      var municipioSelect = document.getElementById('municipioSelect');

      var estadoHidden = document.getElementById('ufHidden');
      var cidadeHidden = document.getElementById('cidadeHidden');

      // Se houver uma seleção válida, atribuí-la ao campo hidden
      estadoHidden.value = estadoSelect.value || "<?=$dados->estado?>";
      cidadeHidden.value = municipioSelect.value || "<?=$dados->cidade?>";
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