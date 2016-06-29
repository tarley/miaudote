<?php
    include('../seguranca.php');
	include('navigation_painel.php');
	protectPage($_SESSION['idPermissao']);
	error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Miaudote | ♥_♥ </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="images/icons/favicon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icons/favicon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icons/favicon-114x114.png">
    <!--Loading bootstrap css
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">-->
    <link type="text/css" rel="stylesheet" href="styles/jquery-ui-1.10.4.custom.min.css">
    <link type="text/css" rel="stylesheet" href="styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="styles/animate.css">
    <link type="text/css" rel="stylesheet" href="styles/all.css">
    <link type="text/css" rel="stylesheet" href="styles/main.css">
    <link type="text/css" rel="stylesheet" href="styles/style-responsive.css">
    <link type="text/css" rel="stylesheet" href="styles/zabuto_calendar.min.css">
    <link type="text/css" rel="stylesheet" href="styles/pace.css">
    <link type="text/css" rel="stylesheet" href="styles/jquery.news-ticker.css">
	<link type="text/css" rel="stylesheet" href="assets/css/adicionais.css">
	<script src="assets/js/adicionais.css"></script>
</head>
<body>
    <div>
        <div id="header-topbar-option-demo" class="page-header-topbar">
			<nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">
				<div class="navbar-header">
					<button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
					<a id="logo" href="index.html" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text"><!--<img src="../images/logomiaudote.png">--></span><span style="display: none" class="logo-text-icon">µ</span></a></div>
				<div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
					
					<ul class="nav navbar navbar-top-links navbar-right mbn">
						<li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><img src="images/avatar/48.jpg" alt="" class="img-responsive img-circle"/>&nbsp;<span class="hidden-xs"><?php echo $_SESSION['usuarioNome']?></span>&nbsp;<span class="caret"></span></a>
							<ul class="dropdown-menu dropdown-user pull-right">
								<li><a href="index.php?page=sair"><i class="fa fa-key"></i>Sair </a></li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
        </div>
        <!--END TOPBAR-->
        <div id="wrapper">
            <!--BEGIN SIDEBAR MENU-->
            <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
                data-position="right" class="navbar-default navbar-static-side">
				<div class="sidebar-collapse menu-scroll">
					<ul id="side-menu" class="nav">
					<div class="clearfix"></div>
						<?php
						switch ($_SESSION['idPermissao']){
							case "usuario":	
						?>
							<li><a href='index.php?page=perfil_usuario' data-href='perfil_usuario' id='link' data-value='1'><i class='fa fa-desktop fa-fw'><!-- No data value, adicionar o ID do usuario logado-->
							<div class='icon-bg bg-pink'></div>
							</i><span class='menu-title'>Perfil</span></a>
							<li><a href='index.php?page=animal' data-href='animais' id='link' data-value='0'><i class='fa fa-edit fa-fw'>
							<div class='icon-bg bg-violet'></div>
							</i><span class='menu-title'>Animais</span></a>
							</li>
							<li><a href='index.php?page=lista_adocao' data-href='lista_adocao' id='link' data-value='0'><i class='fa fa-edit fa-fw'>
								<div class='icon-bg bg-violet'></div>
								</i><span class='menu-title'>Animais para adoção</span></a>
							</li>						
						<?php
							break;
							case "moderador":
						?>
							<li><a href='index.php?page=perfil_usuario' data-href='perfil_usuario' id='link' data-value='1'><i class='fa fa-desktop fa-fw'><!-- No data value, adicionar o ID do usuario logado-->
							<div class='icon-bg bg-pink'></div>
							</i><span class='menu-title'>Perfil</span></a>
							<li><a href='index.php?page=ong' data-href='ongs' id='link' data-value='0'><i class='fa fa-th-list fa-fw'>
							<div class='icon-bg bg-green'></div>
							</i><span class='menu-title'>Ongs</span></a>  
							<li><a href='index.php?page=aprovacao' data-href='aprovacao' id='link' data-value='0'><i class='fa fa-th-list fa-fw'>
							<div class='icon-bg bg-blue'></div>
							</i><span class='menu-title'>Aprovacao</span></a>
										  
							</li>	

						<?php
						break;
				
						}
						?>
					</ul>
				</div>
			</nav>
			 <div id="page-wrapper">
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">
                            <?php echo ucwords($page = (isset($_GET['page']))? $_GET['page'] : 'Home')?></div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="#">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#"><?php echo $page = (isset($_GET['page']))? $_GET['page'] : 'Home'; ?></a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active"><?php echo ucwords($page = (isset($_GET['page']))? $_GET['page'] : 'Home') ?></li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>

                <div class="page-content">
                    <div id="tab-general">
						<div class="container-fluid" style="">
							<div class="row " style="min-height:800px">

									<div class="col-md-10 col-md-offset-1 panel panel-default " id="conteudo_painel" style="min-height:800px">
										<div class="col-md-8 col-md-offset-2 panel panel-default " id="conteudo_painel" style="margin-top:50px">
											<?php navigation() ?> 
										</div>
									</div>

							</div>
						</div>
                    </div>
                </div>

                <div id="footer">
                    <div class="copyright">
                        <a href="#"><?php echo date('Y');?> © Miaudote</a>
					</div>
                </div>
            </div>
		</div>
	</div>
		
	<script src="assets/js/jquery-1.11.js"></script>
    <script src="script/jquery-migrate-1.2.1.min.js"></script>
    <script src="script/jquery-ui.js"></script>
    <script src="assets/bootstrap/js/bootstrap.js"></script>
    <script src="script/bootstrap-hover-dropdown.js"></script>
	<script src="assets/js/script.js"></script>
	<script src="assets/js/bootbox.min.js"></script>
	<script src="script/jquery.menu.js"></script>
	
	<!-- os cruds :P -->
	<script src="assets/js/animal.js"></script>
	<script src="assets/js/ong.js"></script>
	<script src="assets/js/adocao.js"></script>
	<script src="assets/js/aprovar.js"></script>
	
	<!--upload-->
	
	<script src="assets/js/vendor/jquery.ui.widget.js"></script>
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="assets/js/jquery.iframe-transport.js"></script>
	<!-- The basic File Upload plugin -->
	<script src="assets/js/jquery.fileupload.js"></script>

 

<script> 
       (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-145464-12', 'auto');
        ga('send', 'pageview');
</script>

</body>
</html>
