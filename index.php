<!DOCTYPE html>
<?php
Error_reporting (E_ALL);

include ("assets/php/conexao.php");
include ("assets/php/navigation.php");
$pdo = conectar ();

header ( "Content-Type: text/html; charset=UTF-8", true );

$listaAnimal = $pdo->query ( " select 	e.nom_estado,
								e.sg_uf,
								c.nom_cidade,
								a.cod_usuario,
								u.nom_usuario,
								a.cod_animal,
								a.nom_animal,
								f.cod_foto,
								f.nom_foto,
							  case
							  when esp.cod_especie = 1 then 'cao'
							  when esp.cod_especie = 2 then 'gato'
								end as cod_especie,
								a.cor,
								a.idade,									
								case
									when a.ind_porte = 1 then 'pequeno'
									when a.ind_porte = 2 then 'medio'
									when a.ind_porte = 3 then 'grande'
									else 'indefinido'
								end as ind_porte,									
								case
									when a.ind_sexo = 1 then 'macho'
									when a.ind_sexo = 2 then 'femea'
								end as ind_sexo										
							from 
								tb_animal a inner join tb_estado  e   on(a.cod_estado  = e.cod_estado)
											inner join tb_cidade  c   on(a.cod_cidade  = c.cod_cidade)
											inner join tb_especie esp on(a.cod_especie = esp.cod_especie) 
											inner join tb_foto    f   on(a.cod_animal  = f.cod_animal)
											inner join tb_usuario u   on(a.cod_usuario = u.cod_usuario)
							where
								f.id_foto_pri = 's'" );

$listaEstado = $pdo->query ( "select  distinct a.cod_estado,
										         e.sg_uf,
												 e.cod_estado,
												 e.nom_estado
								  from  tb_animal a inner join tb_estado e
								  on  (a.cod_estado = e.cod_estado)" );

?>
<html lang="en">
<head>
<?php include 'shared/_header.php';?>
</head>

<body id="body">
	<?php include 'shared/_menu.php';
	      include 'assets/php/fundador.php';	
	?>

	<!-- Div master mostra conteÃºdo daspÃ¡ginas -->

	<div id="conteudo" class="clear spacer fix grid row" style ="padding-top:6em;">
		<div id="inicio-header" class="col-md-6 col-md-offset-3" style="">
			<ul class="nav nav-pills nav-justified navigation">
				<li><a href="index.php?page=destaques" class="menu-topo" 	  id="destaques"  data-link='destaques'>Destaques</a></li>
				<li><a href="index.php?page=recem_adotados" class="menu-topo" id="recem_adotados"  data-link='adotados'>Recem Adotados</a></li>
			</ul>
		</div>
	
		<div id="conteudo-sub" class="col-md-10 col-md-offset-1 scroll" style="min-height:800px">
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
			<ul class="filtros cs-style-3">
						<?php
						if ($listaAnimal) {
							while ( $row = $listaAnimal->fetch ( PDO::FETCH_ASSOC ) ) {
								echo "<li class='mix " . $row ["nom_animal"] . " " . $row ["cor"] . " " . $row ["cod_especie"] . " " . $row ["idade"] . "a " . $row ["ind_porte"] . " " . $row ["ind_sexo"] . " " . $row ["sg_uf"] . " " . ltrim ( $row ["nom_cidade"] ) . "'>
									<div class='imgHolder'>
										<figure>										
										<img id='animal-filtro' data-value='" . $row ['cod_animal'] . "'  src='images/profile/user_" . $row ['cod_usuario'] . "/pet_" . $row ['cod_animal'] . "/book/" . $row ['nom_foto'] . ".jpg' >								
										<hr>
										<p>
											" . $row ['nom_animal'] . " 
										</p>
										<figcaption>
											<h3>" . utf8_encode ( $row ['nom_cidade'] ) . " - " . $row ['sg_uf'] . "</h3>
											<span>" . $row ["ind_sexo"] . ", " . $row ["idade"] . " ano(s)</span> 
											<a href='#conteudo' id='animal-filtro' data-value='" . $row ['cod_animal'] . "'>Perfil</a>
										</figcaption>	
										</figure>
									</div> 
								</li>";
							}
						}
						?>
				<li class="gap"></li>
				<li class="gap"></li>
				<li class="gap"></li>
			</ul>
			<div class="cd-fail-message">Desculpe-nos, mas não encontramos
				nenhum animalzinho com este perfil...</div>
		</section>

		<!-- cd-gallery -->

		<div class="cd-filter">
			<form>
				<div class="cd-filter-block">
					<h4>Filtrar</h4>

					<div class="cd-filter-content">
						<input type="search" placeholder="Buscar por...">
					</div>
				</div>
				<div class="cd-filter-block">
					<h4>Estado</h4>
					<div class="cd-filter-content">
						<div id="cod_estado" class="cd-select cd-filters">
							<select class="filter" name="selectThis" id="selectThis">
								<option value="">Selecione o estado ...</option>
									<?php
									error_reporting ( E_ALL );
									while ( $rowEstado = $listaEstado->fetch ( PDO::FETCH_ASSOC ) ) {
										echo "<option value='." . $rowEstado ["sg_uf"] . "'>" . utf8_encode ( $rowEstado ["nom_estado"] ) . "</option>";
									}
									?>
									</select>
						</div>
					</div>
				</div>

				<div class="cd-filter-block">
					<h4>Cidade</h4>

					<div class="cd-filter-content">
						<div class="cd-select cd-filters">
							<select id="cod_cidade" class="filter" name="selectThis"
								id="selectThis">
								<option value="">Selecione a cidade ...</option>
							</select>
						</div>

					</div>

				</div>


				<div class="cd-filter-block">
					<h4>Porte</h4>

					<ul class="cd-filter-content cd-filters list">
						<li><input class="filter" data-filter=".pequeno" type="checkbox"
							id="cbpequeno"> <label class="checkbox-label" for="checkbox1">Pequeno</label></li>

						<li><input class="filter" data-filter=".medio" type="checkbox"
							id="cbmedio"> <label class="checkbox-label" for="checkbox2">Medio</label></li>

						<li><input class="filter" data-filter=".grande" type="checkbox"
							id="cbgrande"> <label class="checkbox-label" for="checkbox3">Grande</label></li>
					</ul>

				</div>


				<div class="cd-filter-block">
					<h4>Raça</h4>

					<div class="cd-filter-content">
						<div class="cd-select cd-filters">
							<select class="filter" name="selectThis" id="selectThis">
								<option value="">Escolha uma raça</option>
								<option value=".srd">Tomba-lata</option>
								<option value=".bulldog">Bulldog</option>
								<option value=".boxer">Boxer</option>
								<option value=".rotweiller">Rotweiller</option>
								<option value=".labrador">Labrador</option>
								<option value=".yorkshire">Yorkshire</option>
								<option value=".fold">Scottish Fold</option>
								<option value=".bobtail">Bob Tail</option>
							</select>
						</div>

					</div>

				</div>


				<div class="cd-filter-block">
					<h4>Sexo</h4>
					<ul class="cd-filter-content cd-filters list">
						<li><input class="filter" data-filter="" type="radio"
							name="radioButton" id="radio1" checked> <label
							class="radio-label" for="radio1">Todos</label></li>

						<li><input class="filter" data-filter=".macho" type="radio"
							name="radioButton" id="radio2"> <label class="radio-label"
							for="radio2">Macho</label></li>

						<li><input class="filter" data-filter=".femea" type="radio"
							name="radioButton" id="radio3"> <label class="radio-label"
							for="radio3">Fêmea</label></li>
					</ul>

				</div>

				<div class="cd-filter-block">
					<h4>Idade</h4>

					<div class="cd-filter-content">
						<div class="cd-select cd-filters">
							<select class="filter" name="selectThis" id="selectThis">
								<option value="">Idade</option>
								<option value=".0-1">0-1</option>
								<option value=".1-3">1-3</option>
								<option value=".3-7">3-7</option>
								<option value="7-10">7-10</option>
								<option value=".+10">+10</option>
							</select>
						</div>
					</div>
				</div>
				<div class="cd-filter-block">
					<h4>Peso</h4>

					<div class="cd-filter-content">
						<div class="cd-select cd-filters">
							<select class="filter" name="selectThis" id="selectThis">
								<option value="">Peso</option>
								<option value=".0-5kg">1 a 5kg</option>
								<option value=".6-10kg">6 a 10kg</option>
								<option value=".10-20kg">10 a 20 kg</option>
								<option value=".99kg">mais de 20kg</option>
							</select>
						</div>

					</div>

				</div>

			</form>

			<a href="#0" class="cd-close">Fechar</a>
		</div>
		<a href="#0" id="filtro-menu" class="cd-filter-trigger">Filtros</a> </main>
	</div>
	<!--<div id="search" class="clearfix grid row scroll">
		<div id="menu-search" class="col-md-2"></div>

		<div id="result-search" class="col-md-8 class"
			style="min-height: 400px;"></div>
	</div>
	<!-- Cirlce Starts -->
	<div id="about" class="container spacer about">
		<hr>
		<h2 class="text-center wowload fadeInUp">Quem Somos</h2>
		<div class="row">
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
		</div>
	</div>
	<!-- #Cirlce Ends -->
	<hr>
	<div id="partners" class="container spacer "></div>

	

	<?php 
	include 'shared/_footer.php';
	
	include 'shared/_scripts.php';?>

</body>
</html>
