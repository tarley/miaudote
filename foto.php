<?php
Error_reporting ( 0 );

include ("assets/php/conexao.php");
$pdo = conectar ();

header ( "Content-Type: text/html; charset=UTF-8", true );

$fotos = $pdo->query ( "select url
						  from 
							tb_foto
						  where cod_animal = " . $_GET ["id"] . "
							and id_foto_pri = 'N'" );

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Galeria de Fotos</title>
<link href="./assets/css/aprovacao/bootstrap.min.css" rel="stylesheet">
<style>
@import url(https://fonts.googleapis.com/css?family=Bree+Serif);

body {
	background: #ebebeb;
}

ul {
	padding: 0 0 0 0;
	margin: 0 0 40px 0;
}

ul li {
	list-style: none;
	margin-bottom: 10px;
}

ul li.bspHasModal {
	cursor: pointer;
}

.modal-body {
	padding: 5px !important;
}

.modal-content {
	border-radius: 0;
}

.modal-dialog img {
	text-align: center;
	margin: 0 auto;
}

.controls {
	width: 50px;
	display: block;
	font-size: 11px;
	padding-top: 8px;
	font-weight: bold;
}

.next {
	float: right;
	text-align: right;
}

.text {
	font-family: 'Bree Serif';
	color: #666;
	font-size: 11px;
	margin-bottom: 10px;
	padding: 12px;
	background: #fff;
}

.glyphicon-remove-circle:hover {
	cursor: pointer;
}

@media screen and (max-width: 380px) {
	.col-xxs-12 {
		width: 100%;
	}
	.col-xxs-12 img {
		width: 100%;
	}
}
</style>
</head>
<body>
	<br/>
	<div class="container">
	<?php
	if ($fotos) {
		while ( $row = $fotos->fetch ( PDO::FETCH_ASSOC ) ) {
			echo "<ul class='row first'>		
					<li>
						<img src='" . substr($row ["url"],3) . "'>
					</li>				
				  </ul>";
		}
	}
	?>
	</div>
</body>
<script src="./assets/js/aprovacao/jquery-1.10.2.min.js"></script>
<script src="./assets/js/aprovacao/bootstrap.min.js"></script>
<script src="./assets/js/aprovacao/jquery.bsPhotoGallery.js"></script>
<script>
      $(document).ready(function(){
        $('ul.first').bsPhotoGallery({
          "classes" : "col-lg-2 col-md-4 col-sm-3 col-xs-4 col-xxs-12",
          "hasModal" : true
        });
      });
    </script>
</html>