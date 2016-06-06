<?php
	error_reporting(E_ALL | E_STRICT);
	session_start();

	include("upload.php");
	
	$usuario = $_SESSION['nom_usuario'];
	$animal  = $_SESSION['nom_animal'];

	mkdir(__DIR__ ."/usuario_".$usuario."/animal_".$animal."/", 0777, true);
	
	
	//$upload    = new Upload($files_foto,387,600,"../images/uploads/usuario_".$usuario."/animal_".$animal.""); 

	
	$arquivo   = $upload->salvar();
	
	
	
	
/*
require('UploadHandler.php');
$upload_handler = new UploadHandler();*/
?>

