<html lang="en">
<?php include 'shared/_header.php';?>
<body>
	<?php include 'shared/_menu.php';
	      include 'assets/php/fundador.php';	
	?>
	
	<div class="container container-fundador">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading"><?php echo utf8_encode('Fundadores do Sistema')?></h2>
				<h3 class="section-subheading text-muted"><?php echo utf8_encode('Sistemas de Informação -	8º Período')?></h3>
			</div>
		</div>
		<div class="row">
			<?php 
			
				$fundadores = array(
						new Fundador('Adelaide Antunes', 'Desenvolvedora', '', '', '', ''),
						new Fundador('Adelaide Antunes', 'Desenvolvedora', '', '', '', ''),
						new Fundador('Adelaide Antunes', 'Desenvolvedora', '', '', '', ''),
						new Fundador('Adelaide Antunes', 'Desenvolvedora', '', '', '', ''),
						new Fundador('Adelaide Antunes', 'Desenvolvedora', '', '', '', '')
				);	
				
				foreach ($fundadores as $f) :
			?>
		
			<div class="col-sm-3">
				<div class="team-member">
					<img class="img-responsive img-circle img-fundadores" alt=""
						src="<?php echo $f->urlImagem?>">
					<h4><?php echo $f->nome?></h4>
					<p class="text-muted"><?php echo $f->papel?></p>
					<ul class="list-inline social-buttons">
						<li><a href="#"><i class="fa fa-twitter"><?php echo $f->twitter?></i></a></li>
						<li><a href="#"><i class="fa fa-facebook"><?php echo $f->facebook?></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin"><?php echo $f->linkedin?></i></a></li>
					</ul>
				</div>
			</div>
			<?php endforeach;?>
		</div>
		<div class="row">
			<div class="col-lg-12 text-center">
				<h3 class="section-subheading text-muted"><?php echo utf8_encode('Sistemas de Informação - 4º Período')?></h3>
			</div>
			
			<?php 
			
				$fundadores = array(
						new Fundador('Adelaide Antunes', 'Desenvolvedora', '', '', '', ''),
						new Fundador('Adelaide Antunes', 'Desenvolvedora', '', '', '', ''),
						new Fundador('Adelaide Antunes', 'Desenvolvedora', '', '', '', ''),
						new Fundador('Adelaide Antunes', 'Desenvolvedora', '', '', '', ''),
						new Fundador('Adelaide Antunes', 'Desenvolvedora', '', '', '', '')
				);	
				
				foreach ($fundadores as $f) :
			?>			
			
			<div class="col-sm-3">
				<div class="team-member">
					<img class="img-responsive img-circle img-fundadores" alt=""
						src="<?php echo $f->urlImagem?>">
					<h4><?php echo $f->nome?></h4>
					<p class="text-muted"><?php echo $f->papel?></p>
					<ul class="list-inline social-buttons">
						<li><a href="#"><i class="fa fa-twitter"><?php echo $f->twitter?></i></a></li>
						<li><a href="#"><i class="fa fa-facebook"><?php echo $f->facebook?></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin"><?php echo $f->linkedin?></i></a></li>
					</ul>
				</div>
			</div>
			<?php endforeach;?>
		</div>
	</div>

	<?php 
	include 'shared/_footer.php';
	
	include 'shared/_scripts.php';?>

</body>
</html>