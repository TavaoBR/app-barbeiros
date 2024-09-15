<?=$this->layout('themes/site', ['title' => $title]);?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<style>
    body{
        margin-top: 80px;
    }
    .card {
    box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
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
    border-radius: 1rem;
}

.card-body {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.5rem 1.5rem;
}
</style>


<div class="container-fluid">

<div class="container">

<p>Atenção:</p>
<p>Escolha seu estado e depois a cidade para a busca ser eficiente</p>

  <!-- Title -->

  <!-- Main content -->
  <div class="row">
    <!-- Left side -->
    <div class="col-lg-8">
      <!-- Basic information -->
      <div class="card mb-4">
        <div class="card-body">
          <h3 class="h6 mb-4">Filtro</h3>
          <div class="row">
            <div class="col-lg-6">
              <div class="mb-3">
              <label class="form-label">Estado</label>
                <select name="uf" id="estadoSelect" onchange="carregarMunicipios()" class="form-control mySelect2">
                  <option value="">Selecione...</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
              <label class="form-label">Cidade</label>
                <select name="cidade" id="municipioSelect"  class="form-control mySelect2">
                  <option value="">Selecione um estado primeiro</option>
                </select>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="mb-3">
                <button id="procurarButton" class="btn btn-primary">Procurar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Address -->
    </div>
    <!-- Right side -->
  </div>

  <div class="row">
    <!-- Anuncios -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-1671016207258131"
     data-ad-slot="8404082786"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
  </div>
</div>

</div>

<script>

$('.mySelect2').select2();

// Aqui está a solução
$('.mySelect2').on('select2:unselect', function(evt) {
console.log(evt.params.data);
})

// Função para adicionar o evento de redirecionamento
function setupRedirect() {
    const estadoSelect = document.getElementById('estadoSelect');
    const municipioSelect = document.getElementById('municipioSelect');
    const procurarButton = document.getElementById('procurarButton');

    procurarButton.addEventListener('click', function() {
        const municipio = municipioSelect.value;
        const uf = estadoSelect.value;

        console.log(`UF: ${uf}, Município: ${municipio}`); // Verifique se isso aparece

        if (municipio && uf) {
            // Certifique-se de que '<?=routerConfig()?>' esteja correto no contexto do seu ambiente
            window.location.href = `<?=routerConfig()?>/resultado/${uf}/${municipio.replace(/\s+/g, '-')}`;
        } else {
            console.error('UF ou Município não selecionado!');
        }
    });
}

// Carregar estados e adicionar eventos ao carregar a página
window.onload = function() {
    carregarEstados();
    setupRedirect();
};

// Função para carregar estados
function carregarEstados() {
    fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
        .then(response => response.json())
        .then(estados => {
            const estadoSelect = document.getElementById('estadoSelect');
            estados.forEach(estado => {
                const option = document.createElement('option');
                option.value = estado.sigla;
                option.textContent = estado.nome;
                estadoSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Erro ao carregar estados:', error));
}

// Função para carregar municípios
function carregarMunicipios() {
    const uf = estadoSelect.value;
    const municipioSelect = document.getElementById('municipioSelect');

    municipioSelect.innerHTML = '<option value="">Carregando...</option>';

    if (uf) {
        fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/municipios`)
            .then(response => response.json())
            .then(municipios => {
                municipioSelect.innerHTML = '<option value="">Selecione...</option>';
                municipios.forEach(municipio => {
                    const option = document.createElement('option');
                    option.value = municipio.nome;
                    option.textContent = municipio.nome;
                    municipioSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Erro ao carregar municípios:', error));
    } else {
        municipioSelect.innerHTML = '<option value="">Selecione um estado primeiro</option>';
    }
}
</script>

