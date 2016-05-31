<!DOCTYPE html>
<?php
Error_reporting ( E_ALL );

include ("assets/php/conexao.php");
include ("assets/php/navigation.php");
$pdo = conectar ();

$listaEstado = $pdo->query ( "select  distinct	e.cod_estado,
												e.sg_uf,
												e.cod_estado,
												e.nom_estado
							from  tb_animal a inner join tb_cidade c on 
													(a.cod_cidade = c.cod_cidade) 
											  inner join tb_estado e
													on  (c.cod_estado = e.cod_estado)" );

$listaCidade = $pdo->query ( "select distinct c.cod_cidade, 
											  c.nom_cidade 
								from tb_animal a inner join tb_cidade c on
													(a.cod_cidade = c.cod_cidade)" );
?>
<html lang="en">
<head>
<?php include 'shared/_header.php';?>
</head>

<body id="body">
<div class="topbar animated fadeInLeftBig"></div>
	<?php
	
	include 'shared/_menu.php';
	include 'assets/php/fundador.php';
	?>

	<!-- Div master mostra conteÃºdo daspÃ¡ginas -->

	<div id="conteudo" class="clear spacer fix grid row"
		style="padding-top: 6em;">
		<div id="inicio-header" class="col-md-6 col-md-offset-3" style="">
			<ul class="nav nav-pills nav-justified navigation">
				<li><a href="index.php?page=destaques" class="menu-topo" id="destaques" data-link='destaques'>Destaques</a></li>
				<li><a href="index.php?page=recem_adotados" class="menu-topo"id="recem_adotados" data-link='adotados'>Recem Adotados</a></li>
			</ul>
		</div>

		<div id="conteudo-sub" class="col-md-10 col-md-offset-1 scroll"	style="min-height: 800px">
			<?php navigation()?>
		</div>
	</div>

	<div id="filtro" class="clearfix filtros row scroll"
		style="padding-top: 90px;">
		<main class="cd-main-content">
		<div class="cd-tab-filter-wrapper">
			<div class="cd-tab-filter">
				<ul class="cd-filters">
					<li class="placeholder"><a data-type="todos" href="#0">Todos</a></li>
					<li class="filter"><a class="selected" href="#0" data-type="todos">Todos</a></li>
					<li class="filter" data-filter=".cao"><a href="#0" data-type="cao">Cães</a></li>
					<li class="filter" data-filter=".gato"><a href="#0"
						data-type="gato">Gatos</a></li>
				</ul>
			</div>
		</div>
		<section id="galery-perfil" class="cd-gallery">
			<div class="cd-success-message">Apenas os 20 primeiros resultados serão exibidos, utilize o filtro para melhorar a busca...</div><br /><br />
			<ul id="cfiltro" class="filtros cs-style-3">
				<!--  Resultado do filtro vem aqui -->
				<li class="gap"></li>
				<li class="gap"></li>
				<li class="gap"></li>
			</ul>			
			<div class="cd-fail-message">Desculpe-nos, mas não encontramos nenhum
				animalzinho com este perfil...</div>
		</section>

		<!-- cd-gallery -->

		<div class="cd-filter">
			<form>
				<div class="cd-filter-block">
					<h4>Nome</h4>

					<div class="">
						<input id="fnome" type="search" placeholder="Buscar por...">
					</div>
				</div>
				
				<div class="cd-filter-block">
					<h4>Estado</h4>
					<div class="">
						<div id="cod_estado" class="cd-select cd-filters">
							<select id="festado" class="" name="selectThis" id="selectThis">
								<option value="">Selecione o estado ...</option>
									<?php
									//error_reporting ( E_ALL );
									while ( $rowEstado = $listaEstado->fetch ( PDO::FETCH_ASSOC ) ) {
										echo "<option value='" . $rowEstado ["sg_uf"] . "'>" . utf8_encode ( $rowEstado ["nom_estado"] ) . "</option>";
									}
									?>
									</select>
						</div>
					</div>
				</div>

				<div class="cd-filter-block">
					<h4>Cidade</h4>
					<div class="">
						<div class="cd-select cd-filters">
							<select id="fcidade" class="" name="selectThis" id="selectThis">
								<option value="">Selecione uma cidade...</option>
								<?php
								while ($rowCidade = $listaCidade->fetch ( PDO::FETCH_ASSOC ) ) {
									if ($rowCidade["nom_cidade"] !== 'Belo Horizonte' )
									{
										echo "<option value='" . $rowCidade["cod_cidade"] . "'>" . utf8_encode ( $rowCidade["nom_cidade"] ) . "</option>";
									}
								}
								?>
							</select>
						</div>
					</div>
				</div>


				<div class="cd-filter-block">
					<h4>Porte</h4>
					<ul class="cd-filter-content cd-filters list">
						<li><input class="" data-filter=".pequeno" type="checkbox"
							id="cbpequeno"> <label class="checkbox-label" for="checkbox1">Pequeno</label></li>

						<li><input class="" data-filter=".medio" type="checkbox"
							id="cbmedio"> <label class="checkbox-label" for="checkbox2">Medio</label></li>

						<li><input class="" data-filter=".grande" type="checkbox"
							id="cbgrande"> <label class="checkbox-label" for="checkbox3">Grande</label></li>
					</ul>
				</div>

				<div class="cd-filter-block">
					<h4>Sexo</h4>
					<ul class="cd-filter-content cd-filters list">
						<li><input class="" data-filter="" type="radio"
							name="radioButton" id="radio1" checked> <label
							class="radio-label" for="radio1">Todos</label></li>

						<li><input id="fmacho" class="" data-filter=".macho" type="radio"
							name="radioButton" id="radio2"> <label class="radio-label"
							for="radio2">Macho</label></li>

						<li><input id="ffemea" class="" data-filter=".femea" type="radio"
							name="radioButton" id="radio3"> <label class="radio-label"
							for="radio3">Fêmea</label></li>
					</ul>
				</div>

				<div class="cd-filter-block">
					<h4>Idade</h4>
					<div class="cd-filter-content">
						<div class="cd-select cd-filters">
							<select id="fidade" class="" name="selectThis" id="selectThis">
								<option value="">Selecione uma idade...</option>
								<option value="1">até 1 ano</option>
								<option value="2">de 1 a 2 anos</option>
								<option value="3">de 2 a 3 anos</option>
								<option value="4">maior que 3 anos</option>								
							</select>
						</div>
					</div>
				</div>			
				
				<input id="btnBusca" class="btn-pesquisa" type="button" value="Pesquisa" />								
			</form>

			<a id="linkfechar" href="#0" class="cd-close">Fechar</a>
		</div>
		<a href="#0" id="filtro-menu" class="cd-filter-trigger">Filtros</a> </main>
	</div>
	<!--<div id="search" class="clearfix grid row scroll">
		<div id="menu-search" class="col-md-2"></div>

		<div id="result-search" class="col-md-8 class"
			style="min-height: 400px;"></div>
	</div>
	<!-- Inicio quem somos -->

	<div id="about" class="container spacer about">

		<hr>
		<h2 class="text-center wowload fadeInUp">Quem Somos</h2>
		<!-- <div class="row">
			<div class="col-sm-6 wowload fadeInLeft">
				</br>
				<p align="justify">O projeto InformaCão surgiu do esforço conjunto
					de professores do curso de Medicina Veterinária, preocupados com o
					crescente números de cães abandonados e os problemas sociais e de
					saúde pública ocasionados desse fato. Ambicionavam ainda, um modo
					de transmitir as comunidades informações e dicas de cuidados gerais
					para com seu animal de estimação, com enfoque especial em doenças
					parasitárias, principalmente zoonoses (doenças naturalmente
					transmissíveis do animal ao homem), além é claro, da posse
					responsável de animais domésticos. Para isso reuniram um grupo de
					alunos, previamente selecionados, do curso de Medicina Veterinária,
					liderados e treinados por professores tidos como referencia nos
					temas propostos.</p>


			</div>
			<div class="col-sm-6 wowload fadeInRight">
				</br>
				<p align="justify">Desse modo o projeto atuará em parceria com as
					comunidades visando sensibilizar seus membros quanto à posse
					responsável de animais domésticos, cuidados com sua saúde,
					evidenciando o grande problema causado pelo abandono desses
					animais. A importância no cuidado e tratamento de doenças que a
					maioria da população tem pouco conhecimento do assunto, é também um
					dos principais objetivos do projeto, que buscará desse modo
					contribuir de forma efetiva, não apenas com o bem-estar animal, mas
					também com a saúde e bem-estar das comunidades.</p>
				</br>
				<h4>
					<i class="fa fa-graduation-cap" aria-hidden="true">Apoio: Newton</i>
				</h4>
			</div>
		</div>-->
	</div>
	<!-- Final quem somos -->
	<!-- Inicio como adotar -->
	<div id="comoAdotar" class="container spacer about">
		<hr>
		<h2 class="text-center wowload fadeInUp">Como adotar</h2>
		<div class="row">
			<div class="col-sm-6 wowload fadeInLeft">
				</br>
				<p align="justify">Do ponto de vista de muitas pessoas, adotar um
					animal é um conceito estranho, pois em sua visão comprar é o mais
					normal, entretanto é importante esclarecermos que estranho é
					justamente o contrário. Nossos amigos de quatro patas são seres
					vivos assim como nós humanos, e da mesma maneira possuem vontade,
					sentimentos, tem necessidade de amar e serem amados. Se não
					compramos amigos humanos, por que haveríamos de comprar um animal?

					Alguns cuidados, contudo, devem ser levados em consideração antes
					de escolher um amigo peludo. Adote um animal já castrado ou
					comprometa-se a castrá-lo assim que atingir a idade apropriada.Cães
					e gatos podem viver quinze anos ou mais, e ao adotar um animal você
					será responsável por cuidar dele durante todo esse tempo e arcar
					com todas as despesas provenientes desse cuidado, animais não são
					brinquedos.</p>
			</div>
			<div class="col-sm-6 wowload fadeInRight">
				</br>
				<p align="justify">Antes de tomar a decisão leve em consideração que
					você deverá estar disposto a ceder tempo, paciência, dedicação e
					amor. Além disso, haverá custos envolvidos na adoção de um animal,
					como por exemplo a ração e o vermífugo. Nunca abandone um animal
					pois cães e gatos se apegam aos amigos humanos, e ao serem
					abandonados entram em depressão profunda, além de ficarem exposto
					às ruas onde há doenças e perigos. A adoção é um dos atos mais
					nobres que um ser humano pode demonstrar e como recompensa terá
					sempre um amigo que te amará incondicionalmente..</p>


				<h4>
					<a href="documents/TERMO_DE_RESPONSABILIDADE.pdf">Adoção
						Legal</a>
				</h4>

				</br>
			</div>
		</div>
	</div>
	<!-- Final Como Adotar -->
	<hr>
	

	<?php
	include 'shared/_footer.php';
	
	include 'shared/_scripts.php';
	?>

</body>
<script>
/* Carrega filtros primeira visita */
$(document).ready(function(){
	$.ajax({
    	type: "POST",
    	url: "./assets/php/filtro.php",
    	data: "load=true",    		  
    	dataType: 'html',    	 
    	success: function(data){
    		$("#cfiltro").html(data);  
    		document.getElementById('linkfechar').click();    		  		   			    		
    	},
    	error: function(){			    	
    	},
    	complete: function(){			    	
    	}
    });
});

/* Carrega filtros clique Buscar */
$(function() {
    $('#btnBusca').click(function (){
        // Nome Animal
		var fnome = document.getElementById("fnome").value;

        // Estado
		var e = document.getElementById("festado");		
		var festado = e.options[e.selectedIndex].value;

        // Cidade
		var c = document.getElementById("fcidade");		
		var fcidade = c.options[c.selectedIndex].value;

		// Porte
		if (document.getElementById('cbpequeno').checked) {		
			var fpequeno = 'x';
		} else {
			var fpequeno = null;
		}

		if (document.getElementById('cbmedio').checked) {
			var fmedio = 'x';
		} else {
			var fmedio = null;
		}

		if (document.getElementById('cbgrande').checked) {
			var fgrande = 'x';
		} else {
			var fgrande = null;
		}

		// Sexo
		if (document.getElementById('fmacho').checked) {
			var fmacho = 'x';
		} else {
			var fmacho = null;
		}

		if (document.getElementById('ffemea').checked) {
			var ffemea = 'x';
		} else {
			var ffemea = null;
		}

		// Estado
		var i = document.getElementById("fidade");		
		var fidade = i.options[i.selectedIndex].value; 
        
    	$.ajax({
	    	type: "POST",
	    	url: "./assets/php/filtro.php",
	    	data: {load: "false",
	    		  fnome: fnome,
	    		  festado: festado,
	    		  fcidade: fcidade,
	    		  fpequeno: fpequeno,
	    		  fmedio: fmedio,
	    		  fgrande: fgrande,
	    		  fmacho: fmacho,
	    		  ffemea: ffemea,
	    		  fidade: fidade},	    		   	    	
	    	dataType: 'html',	    	
	    	success: function(data){
	    		$("#cfiltro").html(data);
	    		document.getElementById('linkfechar').click();	    			    		
	    	},
	    	error: function(){			    	
	    	},
	    	complete: function(){			    	
	    	}
	    });
	});
});
</script>
</html>
