	<?php include ("assets/php/util.php");
	error_reporting(E_ALL);
	?>
	<input type='hidden' id='current_page' />
	<input type='hidden' id='show_per_page' />
	<!-- Galeria de destaques-->

	<div id="destaques">
	<?php getDados("getDestaques")  ?>
	</div>
