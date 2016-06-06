<?php
	include("server/painel_ong.php");
?>

<div id="lista-usuario">
	<?php ong("lista_user",$_SESSION['usuarioID'])?>
</div>