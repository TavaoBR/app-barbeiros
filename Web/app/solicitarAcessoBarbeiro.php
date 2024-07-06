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

.pricing-content{position:relative;}
.pricing_design{
    position: relative;
    margin: 0px 15px;
}
.pricing_design .single-pricing{
    background:#554c86;
    padding: 60px 40px;
    border-radius:30px;
    box-shadow: 0 10px 40px -10px rgba(0,64,128,.2);
    position: relative;
    z-index: 1;
}
.pricing_design .single-pricing:before{
    content: "";
    background-color: #fff;
    width: 100%;
    height: 100%;
    border-radius: 18px 18px 190px 18px;
    border: 1px solid #eee;
    position: absolute;
    bottom: 0;
    right: 0;
    z-index: -1;
}
.price-head{}
.price-head h2 {
	margin-bottom: 20px;
	font-size: 26px;
	font-weight: 600;
}
.price-head h1 {
	font-weight: 600;
	margin-top: 30px;
	margin-bottom: 5px;
}
.price-head span{}

.single-pricing ul{list-style:none;margin-top: 30px;}
.single-pricing ul li {
	line-height: 36px;
}
.single-pricing ul li i {
	background: #554c86;
	color: #fff;
	width: 20px;
	height: 20px;
	border-radius: 30px;
	font-size: 11px;
	text-align: center;
	line-height: 20px;
	margin-right: 6px;
}

.price_btn {
	background: #554c86;
	padding: 10px 30px;
	color: #fff;
	display: inline-block;
	margin-top: 20px;
	border-radius: 2px;
	-webkit-transition: 0.3s;
	transition: 0.3s;
}
.price_btn:hover{background:#0aa1d6;}
a{
text-decoration:none;    
}

.section-title {
    margin-bottom: 60px;
}
.text-center {
    text-align: center!important;
}

.section-title h2 {
    font-size: 45px;
    font-weight: 600;
    margin-top: 0;
    position: relative;
    text-transform: capitalize;
}
</style>

<div class="container-fluid">
    <h2> Solicitar acesso como barbeiro </h2>
    
	<div class="main-body">
    
    
	<div class="row gutters-sm">
	
	  <div class="col-lg-12">
		<?=validateSession("MessageRegister")?>
	  <form action="<?=routerConfig()?>/usuario/solicitacao/acesso/barbeiro/<?=$id?>" method="POST" enctype="multipart/form-data">
		<div class="card mb-3">
		  <div class="card-body">

			<div class="row">
			  <div class="col-sm-3">
				<h6 class="mb-0">Nome</h6>
			  </div>
			  <div class="col-sm-9 text-secondary">
				<input type="text" name="nome" class="form-control"  value="<?=$nome?>">
			  </div>
			</div>
			<hr>

			<div class="row">
			  <div class="col-sm-3">
				<h6 class="mb-0">Email Para contato</h6>
			  </div>
			  <div class="col-sm-9 text-secondary">
				<input type="email" name="email" class="form-control" value="<?=$email?>"> 
			  </div>
			</div>

			<hr>

			<div class="row">
			  <div class="col-sm-3">
				<h6 class="mb-0">Celular para Contato</h6>
			  </div>
			  <div class="col-sm-9 text-secondary">
				<input type="text" name="celular" id="celular" class="form-control" value="<?=$celular?>">
			  </div>
			</div>

			<hr>

			<div class="row">
			  <div class="col-sm-3">
				<h6 class="mb-0">Estado</h6>
			  </div>
			  <div class="col-sm-9 text-secondary">
			  <select name="uf" id="estadoSelect" onchange="carregarMunicipios()" class="form-control mySelect2">
                   <option value="">Selecione...</option>
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
                    <option value="">Selecione um estado primeiro</option>
                </select>
			  </div>
			</div>


			<hr>

			<div class="row">
			  <div class="col-sm-3">
				<h6 class="mb-0">Cep</h6>
			  </div>
			  <div class="col-sm-9 text-secondary">
				<input type="text" name="cep" class="form-control"  id="cep">
			  </div>
			</div>


			<hr>

			<div class="row">
			  <div class="col-sm-3">
				<h6 class="mb-0">Bairro</h6>
			  </div>
			  <div class="col-sm-9 text-secondary">
				<input type="text" name="bairro" class="form-control"  id="bairro">
			  </div>
			</div>


			<hr>

			<div class="row">
			  <div class="col-sm-3">
				<h6 class="mb-0">Endereço</h6>
			  </div>
			  <div class="col-sm-9 text-secondary">
				<input type="text" name="endereco" class="form-control"  id="endereco">
			  </div>
			</div>

			<hr>

			<div class="row">
			  <div class="col-sm-3">
				<h6 class="mb-0">Número da casa</h6>
			  </div>
			  <div class="col-sm-9 text-secondary">
				<input type="text" name="numero" class="form-control" >
			  </div>
			</div>


			<hr>



			<div class="row">
			  <div class="col-sm-3">
				<h6 class="mb-0">Plano</h6>
			  </div>
			  <div class="col-sm-9 text-secondary">
				<select name="plano" id="" class="form-control">
                   <option value="">Selecione uma opção</option>
				   <option value="Mensal R$180,00">Mensal</option>
				   <option value="Vitalicio R$2000,00">Vitalicio</option>
				</select>
			  </div>
			</div>

			<hr>

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



<section id="pricing" class="pricing-content section-padding">
	<div class="container">					
		<div class="section-title text-center">
			<h2>Planos de contratação</h2>
		</div>				
		<div class="row text-center">									
		   <div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
                <div class="pricing_design">
					<div class="single-pricing">
						<div class="price-head">		
							<h2>1 mês</h2>
							<h1>R$180</h1>
							<span>Plano mensal</span>
						</div>
						<ul>
							<li><b>Sem Limite </b> de Agendamentos</li>
							<li><b>100</b> Fotos na galeria</li>
                            <li><b>Prioridade</b> Na listagem</li>
							<li><b>Link </b> Para agendamento </li>
                            <li><b>Suporte </b> Ilimitado </li>
						</ul>
						<div class="pricing-price">
							
						</div>
						
					</div>
				</div>
			</div><!--- END COL -->	
			<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s" data-wow-offset="0" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s; animation-name: fadeInUp;">
				<div class="pricing_design">
					<div class="single-pricing">
						<div class="price-head">		
							<h2>Vitalício</h2>
							<h1 class="price">R$ 2.000</h1>
							<span>Plano para resto da vida</span>
						</div>
						<ul>
                            <li><b>Sem </b> cobrança</li>
                            <li><b>Sem Limite </b> de Agendamentos</li>
							<li><b>100</b> Fotos na galeria</li>
                            <li><b>Prioridade</b> Na listagem</li>
							<li><b>Link </b> Para agendamento </li>
                            <li><b>Suporte </b> Ilimitado </li>
						</ul>
						<div class="pricing-price">
							
						</div>
						
					</div>
				</div>
			</div><!--- END COL -->			  
		</div><!--- END ROW -->
	</div><!--- END CONTAINER -->
</section>



<script>

		$('#celular').mask("+9999999999999");
		$('#cep').mask("99999-999");

		$('.mySelect2').select2();

		// Aqui está a solução
		$('.mySelect2').on('select2:unselect', function(evt) {
		console.log(evt.params.data);
		})


	
		$(document).ready(function () {
            $("#cep").blur(function () {
                const cep = $(this).val().replace(/\D/g, ''); // Remove caracteres não numéricos

                if (cep.length !== 8) {
                    alert("CEP inválido. Certifique-se de inserir 8 números.");
                    return;
                }

                $.get(`https://viacep.com.br/ws/${cep}/json/`, function (data) {
                    $("#endereco").val(data.logradouro);
                    $("#bairro").val(data.bairro);
                })
                .fail(function () {
                    console.error("Erro ao buscar CEP.");
                });
            });
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
  </script>
