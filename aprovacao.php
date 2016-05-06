<?php
Error_reporting ( 0 );

include ("assets/php/conexao.php");
$pdo = conectar ();

header ( "Content-Type: text/html; charset=UTF-8", true );

$lista = $pdo->query ( "select a.cod_animal,
							   a.nom_animal,
							   a.desc_animal,
							   a.desc_perfil,
							   b.nom_usuario,
							   b.email,
							   b.telefone,
							   c.url
						  from 
							tb_animal a inner join tb_usuario b on (a.cod_usuario = b.cod_usuario)
										inner join tb_foto c on (a.cod_animal = c.cod_animal)
						  where a.dt_cadastro is null
							and c.id_foto_pri = 'S'" );

?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<title>Miaudote</title>
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="images/icons/favicon.ico">
<link rel="apple-touch-icon" href="images/icons/favicon.png">
<link rel="apple-touch-icon" sizes="72x72"
	href="images/icons/favicon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114"
	href="images/icons/favicon-114x114.png">
<!--Loading bootstrap css-->
<link type="text/css" rel="stylesheet"
	href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
<link type="text/css" rel="stylesheet"
	href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
<link type="text/css" rel="stylesheet"
	href="assets/css/aprovacao/jquery-ui-1.10.4.custom.min.css">
<link type="text/css" rel="stylesheet"
	href="assets/css/aprovacao/font-awesome.min.css">
<link type="text/css" rel="stylesheet"
	href="assets/css/aprovacao/bootstrap.min.css">
<link type="text/css" rel="stylesheet"
	href="assets/css/aprovacao/animate.css">
<link type="text/css" rel="stylesheet"
	href="assets/css/aprovacao/all.css">
<link type="text/css" rel="stylesheet"
	href="assets/css/aprovacao/main.css">
<link type="text/css" rel="stylesheet"
	href="assets/css/aprovacao/style-responsive.css">
<link type="text/css" rel="stylesheet"
	href="assets/css/aprovacao/zabuto_calendar.min.css">
<link type="text/css" rel="stylesheet"
	href="assets/css/aprovacao/pace.css">
<link type="text/css" rel="stylesheet"
	href="assets/css/aprovacao/jquery.news-ticker.css">
<link type="text/css" rel="stylesheet"
	href="assets/css/aprovacao/jplist-custom.css">
</head>
<!--BEGIN CONTENT-->
<div class="page-content">
	<div id="tab-general">
		<div class="row mbl">
			<div class="col-lg-12">

				<div class="col-md-12">
					<div id="area-chart-spline"
						style="width: 100%; height: 300px; display: none;"></div>
				</div>

			</div>

			<div class="col-lg-12">

				<div class="page-content">
					<div class="row">
						<div class="col-lg-12">
							<div class="panel">
								<div class="panel-body">
									<div id="grid-layout-table-1" class="box jplist">
										<div class="jplist-ios-button">
											<i class="fa fa-sort"></i>Ações
										</div>
										<div class="jplist-panel box panel-top">
											<button type="button" data-control-type="reset"
												data-control-name="reset" data-control-action="reset"
												class="jplist-reset-btn btn btn-default">
												Limpar Filtros<i class="fa fa-share mls"></i>
											</button>
											<div data-control-type="drop-down" data-control-name="paging"
												data-control-action="paging"
												class="jplist-drop-down form-control">
												<ul class="dropdown-menu">
													<li><span data-number="3"> 3 Por página</span></li>
													<li><span data-number="5"> 5 Por página</span></li>
													<li><span data-number="10" data-default="true"> 10 Por
															página</span></li>
													<li><span data-number="all"> Todos</span></li>
												</ul>
											</div>
											<div data-control-type="drop-down" data-control-name="sort"
												data-control-action="sort"
												data-datetime-format="{month}/{day}/{year}"
												class="jplist-drop-down form-control">
												<ul class="dropdown-menu">
													<li><span data-path="default">Filtrar por</span></li>
													<li><span data-path=".title" data-order="asc"
														data-type="text">Título A-Z</span></li>
													<li><span data-path=".title" data-order="desc"
														data-type="text">Título Z-A</span></li>
													<li><span data-path=".desc" data-order="asc"
														data-type="text">Descrição A-Z</span></li>
													<li><span data-path=".desc" data-order="desc"
														data-type="text">Descrição Z-A</span></li>
													<li><span data-path=".date" data-order="asc"
														data-type="datetime">Data Crescente</span></li>
													<li><span data-path=".date" data-order="desc"
														data-type="datetime">Date Decrescente</span></li>
												</ul>
											</div>
											<div class="text-filter-box">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-search"></i></span><input
														data-path=".title" type="text" value=""
														placeholder="filtro nome" data-control-type="textbox"
														data-control-name="title-filter"
														data-control-action="filter" class="form-control" />
												</div>
											</div>
											<div class="text-filter-box">
												<div class="input-group">
													<span class="input-group-addon"><i class="fa fa-search"></i></span><input
														data-path=".desc" type="text" value=""
														placeholder="filtro Descrição" data-control-type="textbox"
														data-control-name="desc-filter"
														data-control-action="filter" class="form-control" />
												</div>
											</div>
											<div data-type="página {current} de {pages}"
												data-control-type="pagination-info"
												data-control-name="paging" data-control-action="paging"
												class="jplist-label btn btn-default"></div>
											<div data-control-type="pagination"
												data-control-name="paging" data-control-action="paging"
												class="jplist-pagination"></div>
										</div>
										<div class="box text-shadow">
											<table class="demo-tbl">
												<!--item-->
												<?php
												if ($lista) {
													while ( $row = $lista->fetch ( PDO::FETCH_ASSOC ) ) {
														echo "<tr class='tbl-item'>													
															<td class='img'>
																<a href='' onclick='AbrirFotos(" .$row["cod_animal"]. ");'><p class='desc'>Ver Fotos</p></a>
																<img src='" .$row["url"]. "' alt='' title='' />							   									
															</td>													
															<td class='td-block'>
																<p class='date'></p>
																<p class='title'>" .$row["nom_animal"]. "</p>
																<p class='desc'>" .$row["desc_animal"]. "</p>
																<p class='desc'>" .$row["desc_perfil"]. "</p>
															</td>
															<td class='td-block'>
																<p class='title'>" .$row["nom_usuario"]. "</p>
																<p class='desc'>" .$row["email"]. "</p>
																<p class='desc'>" .$row["telefone"]. "</p>					
															</td>
															<td class='td-block'>
																<p class='title'>Ação</p>
																<div class='btn-group'>
																	<button type='button' data-toggle='dropdown'
																		class='btn btn-primary dropdown-toggle'>
																		Ação &nbsp;<i class='fa fa-angle-down'></i>
																	</button>
		
																	<ul role='menu' class='dropdown-menu'>
																		<li><a href='#'>Aprovar</a></li>
																		<li><a href='#'>Reprovar</a></li>
																	</ul>
																</div>
															</td>
														</tr>";
													}
												}
												?>
											</table>
										</div>

										<div class="box jplist-no-results text-shadow align-center">
											<p>Sem resultados</p>
										</div>
										<div class="jplist-ios-button">
											<i class="fa fa-sort"></i>Ações
										</div>
										<div class="jplist-panel box panel-bottom">
											<div data-control-type="drop-down" data-control-name="paging"
												data-control-action="paging"
												data-control-animate-to-top="true"
												class="jplist-drop-down form-control">
												<ul class="dropdown-menu">
													<li><span data-number="3"> 3 por página</span></li>
													<li><span data-number="5"> 5 por página</span></li>
													<li><span data-number="10" data-default="true"> 10 por
															página</span></li>
													<li><span data-number="all"> Todos</span></li>
												</ul>
											</div>
											<div data-control-type="drop-down" data-control-name="sort"
												data-control-action="sort"
												data-control-animate-to-top="true"
												data-datetime-format="{month}/{day}/{year}"
												class="jplist-drop-down form-control">
												<ul class="dropdown-menu">
													<li><span data-path="default">Filtrar por</span></li>
													<li><span data-path=".title" data-order="asc"
														data-type="text">Title A-Z</span></li>
													<li><span data-path=".title" data-order="desc"
														data-type="text">Title Z-A</span></li>
													<li><span data-path=".desc" data-order="asc"
														data-type="text">Description A-Z</span></li>
													<li><span data-path=".desc" data-order="desc"
														data-type="text">Description Z-A</span></li>
													<li><span data-path=".date" data-order="asc"
														data-type="datetime">Date asc</span></li>
													<li><span data-path=".date" data-order="desc"
														data-type="datetime">Date desc</span></li>
												</ul>
											</div>
											<div data-type="{start} - {end} of {all}"
												data-control-type="pagination-info"
												data-control-name="paging" data-control-action="paging"
												class="jplist-label btn btn-default"></div>
											<div data-control-type="pagination"
												data-control-name="paging" data-control-action="paging"
												data-control-animate-to-top="true" class="jplist-pagination"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>

</div>
<script src="assets/js/aprovacao/jquery-1.10.2.min.js"></script>
<script src="assets/js/aprovacao/jquery-migrate-1.2.1.min.js"></script>
<script src="assets/js/aprovacao/jquery-ui.js"></script>
<script src="assets/js/aprovacao/bootstrap.min.js"></script>
<script src="assets/js/aprovacao/bootstrap-hover-dropdown.js"></script>
<script src="assets/js/aprovacao/html5shiv.js"></script>
<script src="assets/js/aprovacao/respond.min.js"></script>
<script src="assets/js/aprovacao/jquery.metisMenu.js"></script>
<script src="assets/js/aprovacao/jquery.slimscroll.js"></script>
<script src="assets/js/aprovacao/jquery.cookie.js"></script>
<script src="assets/js/aprovacao/icheck.min.js"></script>
<script src="assets/js/aprovacao/custom.min.js"></script>
<script src="assets/js/aprovacao/jquery.news-ticker.js"></script>
<script src="assets/js/aprovacao/jquery.menu.js"></script>
<script src="assets/js/aprovacao/pace.min.js"></script>
<script src="assets/js/aprovacao/holder.js"></script>
<script src="assets/js/aprovacao/responsive-tabs.js"></script>
<script src="assets/js/aprovacao/jquery.flot.js"></script>
<script src="assets/js/aprovacao/jquery.flot.categories.js"></script>
<script src="assets/js/aprovacao/jquery.flot.pie.js"></script>
<script src="assets/js/aprovacao/jquery.flot.tooltip.js"></script>
<script src="assets/js/aprovacao/jquery.flot.resize.js"></script>
<script src="assets/js/aprovacao/jquery.flot.fillbetween.js"></script>
<script src="assets/js/aprovacao/jquery.flot.stack.js"></script>
<script src="assets/js/aprovacao/jquery.flot.spline.js"></script>
<script src="assets/js/aprovacao/zabuto_calendar.min.js"></script>
<script src="assets/js/aprovacao/index.js"></script>
<script src="assets/js/aprovacao/highcharts.js"></script>
<script src="assets/js/aprovacao/data.js"></script>
<script src="assets/js/aprovacao/drilldown.js"></script>
<script src="assets/js/aprovacao/exporting.js"></script>
<script src="assets/js/aprovacao/highcharts-more.js"></script>
<script src="assets/js/aprovacao/charts-highchart-pie.js"></script>
<script src="assets/js/aprovacao/charts-highchart-more.js"></script>
<script src="assets/js/aprovacao/modernizr.min.js"></script>
<script src="assets/js/aprovacao/jplist.min.js"></script>
<script src="assets/js/aprovacao/jplist.js"></script>

<!--CORE JAVASCRIPT-->
<script src="assets/js/aprovacao/main.js"></script>
<script type="text/javascript">
	function AbrirFotos(id) {		
		var win = window.open('foto.php?id='+id,'_blank');
	}
</script>
</html>
