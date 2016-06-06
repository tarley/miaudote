<?php
$pdo = conectar ();

	$id_animal	  =	(int)$_GET['n'];
	$usuario      = (int)$_GET['usuario']; 
	$id_del		  =	(int)$_GET['id'];
	$arquivo_foto = $_GET['foto'];
	
	$qry = "delete from tb_foto where COD_FOTO=".$id_del." AND COD_ANIMAL=".$id_animal." LIMIT 1";
	//die($qry);
	if($pdo->query ($qry)){
		unlink($arquivo_foto);	
		echo $arquivo_foto."_arquivo deletad com sucesso";

	};
	die("<script>window.location.href='index.php?page=editar&usuario="<?php echo $_SESSION['usuarioNome']?>";</script>');

?>