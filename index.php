<!DOCTYPE html>
<?php
	Error_reporting(0);
	
	include("assets/php/conexao.php");
	$pdo = conectar();
	
	header("Content-Type: text/html; charset=UTF-8", true);
	
	$listaAnimal =$pdo->query(" select 	e.nom_estado,
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
								f.id_foto_pri = 's'");
	/*					
	if ($listaAnimal == 0){
			echo "Sem animais listados";
	};*/
						
	$listaEstado = $pdo->query("select  distinct a.cod_estado,
										         e.sg_uf,
												 e.cod_estado,
												 e.nom_estado
								  from  tb_animal a inner join tb_estado e
								  on  (a.cod_estado = e.cod_estado)");
								  
						
?>
<html lang="en">
	<head>
		<!--<meta charset="UTF-8" />-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
		<meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1, user-scalable=no">
		
		<!--<link rel="stylesheet" href="assets/css/jquery-ui.css">-->
		<title>Miaudote</title>

		<!-- Google fonts -->
		<link rel="stylesheet" href="assets/css/fontGoogle.css">
		
		<!-- bootstrap -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />

		<!-- animate.css -->
		<link rel="stylesheet" href="assets/css/animate.css" />
		<link rel="stylesheet" href="assets/css/normalize.min.css" />
		<link rel="stylesheet" href="assets/css/set.css">

		<!-- gallery --->
		<!--<link rel="stylesheet" href="assets/gallery/blueimp-gallery.min.css">

		<!-- favicon -->
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="assets/css/style.css">
		
		<!-- Filtro -->
		<link rel="stylesheet" href="assets/css/reset.css"> <!-- CSS reset -->
		<link rel="stylesheet" href="assets/css/style-filtro.css"> <!-- Resource style -->		
	</head>

	<body id="body">	
		<div class="topbar animated fadeInLeftBig"></div>

		<!-- Header Starts -Header e menus de inicialização-->
		<div class="navbar-wrapper">
			  <div class="container">
				<div class="navbar navbar-default navbar-fixed-top" role="navigation" id="top-nav">
				  <div class="container">
					<div class="navbar-header">
					  <!-- Logo Starts -->
					  <a class="navbar-brand" href="#home"><img src="images/logo2.png" alt="logo"></a>
					  <!-- #Logo Ends -->
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					</div>

					<!-- Nav Starts -->
					<div class="navbar-collapse  collapse">
					  <ul class="nav navbar-nav navbar-right scroll">
						 <li class="active"	>
						 	<a href="#body"	class="menu-topo"	id="menu-topo-inicio">Inicio</a>
						 </li>
						 <li>
						 	<a href="#filtro" 	class="menu-topo"	id="menu-topo-buscar">Busca</a>
						 </li>
						 <li>
						 	<a href="#body"	class="menu-topo"	id="menu-topo-quem-somos">Quem Somos</a>
						 </li>
						 <li>
						 	<a href="#body"	class="menu-topo"	id="menu-topo-adote-um-animal">Adote um animal</a>
						 </li>
						 <li>
						 	<a href="#contact"	class="menu-topo"	id="menu-topo-fale-conosco">Fale Conosco</a>
						 </li>
						 <!--<li ><a href="#dev">Desenvolvedores</a></li>-->
					  </ul>			  
					</div>
					<!-- #Nav Ends -->
				  </div>
				</div>
			  </div>
		</div>
		<!-- #Header Starts -->

		<!-- Div master mostra conte�do dasp�ginas -->
		<div id="master"></div>
		
		
		<input type='hidden' id='current_page'/>  
		<input type='hidden' id='show_per_page'/>
		<!-- Galeria de destaques-->
		<div id="galery"  class=" clearfix grid row"> 
			<div id="galery-image" class="scroll col-md-8 col-md-offset-2">
				
			</div>
		</div>
		<div id='page_navigation' class="nav-pagination"></div>  
		<hr>

		<div id="filtro" class="clearfix filtros row scroll" style="padding-top:90px;">
			<main class="cd-main-content">
				<div class="cd-tab-filter-wrapper">
					<div class="cd-tab-filter">
						<ul class="cd-filters">
							<li class="placeholder"><a data-type="todos"  href="#0">Todos</a></li>
							<li class="filter"><a class="selected"        href="#0" data-type="todos">Todos</a></li>
							<li class="filter" data-filter=".cao">     <a href="#0" data-type="cao">Cães</a></li>
							<li class="filter" data-filter=".gato">    <a href="#0" data-type="gato">Gatos</a></li>
						</ul>
					</div>
				</div>				
				<section id="galery-perfil" class="cd-gallery">		
					<ul class="filtros cs-style-3">
						<?php
						if($listaAnimal){
							while ($row = $listaAnimal->fetch(PDO::FETCH_ASSOC)) {
								echo"<li class='mix ".$row["nom_animal"]. " ".$row["cor"]. " ".$row["cod_especie"]. " ".$row["idade"]. "a ".$row["ind_porte"]." " .$row["ind_sexo"]." ".$row["sg_uf"]." ".ltrim($row["nom_cidade"])."'>
									<div class='imgHolder'>
										<figure>										
										<img id='animal-filtro' data-value='".$row['cod_animal']."'  src='images/profile/user_".$row['cod_usuario']."/pet_".$row['cod_animal']."/book/".$row['nom_foto'].".jpg' >								
										<hr>
										<p>
											" .$row['nom_animal']." 
										</p>
										<figcaption>
											<h3>" .utf8_encode($row['nom_cidade'])." - ".$row['sg_uf']."</h3>
											<span>" .$row["ind_sexo"]. ", " .$row["idade"]. " ano(s)</span> 
											<a href='#search' id='animal-filtro' data-value='" .row['cod_animal']. "'>Perfil</a>
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
										error_reporting(E_ALL);
										while($rowEstado = $listaEstado->fetch(PDO::FETCH_ASSOC))  {
											echo "<option value='.".$rowEstado["sg_uf"].															   
																   "'>" .utf8_encode($rowEstado["nom_estado"]). "</option>";
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
									<select id="cod_cidade" class="filter" name="selectThis" id="selectThis">
										<option value="">Selecione a cidade ...</option>
									</select>
								</div>

							</div>

						</div>
	

						<div class="cd-filter-block">
							<h4>Porte</h4>

							<ul class="cd-filter-content cd-filters list">
								<li><input class="filter" data-filter=".pequeno"
									type="checkbox" id="cbpequeno"> <label
									class="checkbox-label" for="checkbox1">Pequeno</label></li>

								<li><input class="filter" data-filter=".medio"
									type="checkbox" id="cbmedio"> <label
									class="checkbox-label" for="checkbox2">Medio</label></li>

								<li><input class="filter" data-filter=".grande"
									type="checkbox" id="cbgrande"> <label
									class="checkbox-label" for="checkbox3">Grande</label></li>
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
									class="radio-label" for="radio1">Todos</label>
								</li>

								<li><input class="filter" data-filter=".macho" type="radio"
									name="radioButton" id="radio2"> <label
									class="radio-label" for="radio2">Macho</label>
								</li>

								<li><input class="filter" data-filter=".femea" type="radio"
									name="radioButton" id="radio3"> <label
									class="radio-label" for="radio3">Fêmea</label>
								</li>
							</ul>

						</div>

						<div class="cd-filter-block">
							<h4>Idade</h4>

							<div class="cd-filter-content">
								<div class="cd-select cd-filters">
									<select class="filter" name="selectThis" id="selectThis">
										<option value="">Idade</option>
										<option value="filhote">Filhote</option>
										<option value="jovem">Jovem</option>
										<option value="adulto">Adulto</option>
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
				<a href="#0" id="filtro-menu" class="cd-filter-trigger">Filtros</a>
			</main>
		</div>	

		<div id="search" class="clearfix grid row scroll">
			<div id="menu-search" class="col-md-2">
			</div>

			<div id="result-search" class="col-md-8 class"style="min-height:400px;">

			</div>
		</div>

		<hr>
		<div id="partners" class="container spacer ">
		</div>

		<!--Contato-->
		<div id="contact" class="spacer">
			<div class="container contactform center">
			<h2 class="text-center  wowload fadeInUp">Fale conosco</h2>
				<div class="col-sm-offset-4"> 
					<div id="opt-contact">
						<div class="img-contact" style="float:left;margin-top:30px">
							<img src="images/icon-phone.png"><span>(31)2516-2305</span><br>
							<img src="images/icon-whats.png"><span>(31)99358-6958</span><br>
							<img src="images/icon-email.png"/><span>valhalla@ong.com</span>
						</div>
					</div>
				</div>
				<!--
				<div class="row wowload fadeInLeftBig">
					<form id="contactForm" action="" method="Post">
						<div class="col-sm-6 col-sm-offset-3 col-xs-12">      
							<input type="text" name="name" placeholder="Nome" required>
							<input type="text" name="email"placeholder="E-mail" required>
							<textarea rows="5" name="comment" placeholder="Mensagem" required></textarea>
							<button id="enviarEmail" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Enviar </button>
						</div>
					</form>
				</div>-->
				
				<div class="ReturnUser col-sm-6 col-sm-offset-3 col-xs-12">
				<!-- Exibe mensagens ao usuario em tempo de execução -->
																	
				</div>
			</div>
		</div>
		<!--Contact Ends-->

	<!-- Footer Starts -->
		<div class="footer text-center spacer">
		<p class="wowload flipInX"><a href="#"><i class="fa fa-facebook fa-2x"></i></a> <a href="#"><i class="fa fa-instagram fa-2x"></i></a> <a href="#"><i class="fa fa-twitter fa-2x"></i></a> <a href="#"><i class="fa fa-flickr fa-2x"></i></a> </p>
		Copyright 2016 Miaudote. All rights reserved.
		</div>
		<!-- # Footer Ends -->
		<a href="#galery" class="gototop "><i class="fa fa-angle-up  fa-3x"></i></a>

		<!-- jquery -->
		<script src="assets/js/jquery-1.12.0.js"></script> 

		<script src="assets/js/util.js"></script>

		<!-- wow script -->
		<script src="assets/js/wow.min.js"></script>


		<!-- boostrap -->
		<script src="assets/js/bootstrap.js" type="text/javascript" ></script>

		<!-- jquery mobile -->
		<script src="assets/js/touchSwipe.min.js"></script>


		<!-- custom script -->
		<script src="assets/js/script.js"></script>
		<script src="assets/js/email.js"></script>

		<!--<script src="assets/js/jquery-1.13.3.js"></script>

		<script type="text/javascript" src="assets/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="assets/js/jssor.slider.mini.js"></script>-->

		
		<script src="assets/js/jquery-2.1.1.js"></script>
		<script src="assets/js/jquery.mixitup.min.js"></script>
		<script src="assets/js/main.js"></script> <!-- Resource jQuery -->
		
		<!-- Filtros -->
		<script src="assets/js/modernizr.js"></script>
	</body>
</html>