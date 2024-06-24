<?=$this->layout('themes/sistemas', ['title' => $title]);?>


<?=$this->layout('themes/sistemas', ['title' => $title]);?>

<div class="container-fluid">
    <h2> Solicitar acesso para minha Barbearia </h2>


     
</div>

<style>
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
.pricing-price{}

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

<section id="pricing" class="pricing-content section-padding">
	<div class="container">					
		<div class="section-title text-center">
			<h2>Planos de contratação</h2>
		</div>				
		<div class="row text-center">									
			<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s" data-wow-offset="0" style="visibility: visible; animation-duration: 1s; animation-delay: 0.1s; animation-name: fadeInUp;">

                <div class="pricing_design">
					<div class="single-pricing">
						<div class="price-head">		
							<h2>Gratuito</h2>
							<h1>R$0</h1>
							<span>Sem cobrança</span>
						</div>
						<ul>
                            <li><b>Apenas 1</b> funcionario cadastrado</li>
                            <li><b>10</b> Agendamentos por dia</li>
							<li><b>20</b> Fotos na galeria</li>
                            <li><b> Sem Prioridade </b> Na listagem </li>
                            <li><b>Link </b> Para agendamento </li>
							<li><b>Suporte </b> Limitado</li>
						</ul>
						<div class="pricing-price">
							
						</div>
						
					</div>
				</div>


			</div><!--- END COL -->	
			<div class="col-lg-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" data-wow-offset="0" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
                <div class="pricing_design">
					<div class="single-pricing">
						<div class="price-head">		
							<h2>1 mês</h2>
							<h1>R$360.00</h1>
							<span>Plano mensal</span>
						</div>
						<ul>
                            <li><b>Sem limite</b> de funcionario</li>
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
							<h1 class="price">R$ 5.000 </h1>
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