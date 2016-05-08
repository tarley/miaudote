<html lang="en">
<?php include 'shared/_header.php';?>

	<link rel="stylesheet" href="assets/css/fundadores/fundadores.css">
	<!-- link rel="stylesheet" href="assets/css/fundadores/agency.css"-->
<body>
	<?php
	
	include 'shared/_menu.php';
	include 'assets/php/fundador.php';
	
	$fundadoresSI = array (
			new Fundador ( 'Ariane Silva', 'Analista de testes', 'Ariane_Silva.jpg', '', '', '' ),
			new Fundador ( 'Bruna Frazoni', 'Desenvolvedora', 'Bruna_Frazoni.jpg', '', '', '' ),
			new Fundador ( 'Cibele Castelo', 'Product Owner', 'Cibele_Castelo.jpg', '', '', '' ),
			new Fundador ( 'Igor Yuri', 'Product Owner', 'Igor_Yuri.jpg', '', '', '' ),
			new Fundador ( 'Juliano Savio', 'Desenvolvedor', 'Juliano_Savio.jpg', '', '', '' ),
			new Fundador ( 'Lucas Raphael', 'Desenvolvedor', 'Lucas_Raphael.JPG', '', '', '' ),
			new Fundador ( 'Luiz Henrique', 'Desenvolvedor', 'Luiz_Henrique.jpg', '', '', '' ),
			new Fundador ( 'Marcela Simão', 'Desenvolvedora', 'Marcela_Simao.jpg', '', '', '' ),
			new Fundador ( 'Felipe Sangiorge', 'Analista de testes', '', '', '', '' ),
			new Fundador ( 'Albert Rocha', 'Analista de testes', '', '', '', '' ),
			new Fundador ( 'Gustavo Resende', 'Administrador de Banco de Dados', '', '', '', '' ),
			new Fundador ( 'Carlos Alberto', 'Desenvolvedor', 'Carlos_Alberto.jpg', '', '', '' ),
			new Fundador ( 'Jeferson Eustáquio', 'Desenvolvedor', '', '', '', '' ),
			new Fundador ( 'Tarley Lana', 'Prof.Orientador', 'Tarley_Lana.jpg', '', '', '' ),
	);
	
	$fundadoresVet = array (
			new Fundador ( 'Paula', 'Prof(a).Orientadora', '', '', '', '' ) 
	);
	
	$disciplinas = array (
			new Disciplina ( "Sistemas de Informação - 8º Período", $fundadoresSI ),
			new Disciplina ( "Veterinária - 8º Período", $fundadoresVet ) 
	);
	
	?>
	
	<div class="container container-fundador">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading"><?php echo utf8_encode('Fundadores do Sistema')?></h2>
			</div>
		</div>
		<?php foreach($disciplinas as $d) :?>
		<div class="row">
			<div class="col-lg-12 text-center">
				<h3 class="section-subheading text-muted"><?php echo $d->nome ?></h3>
			</div>
		</div>
		<div class="row">
			<?php foreach ( $d->fundadores as $f ) :?>
		
			<div class="col-sm-3">
				<div class="team-member">
					<img class="img-responsive img-circle img-fundadores" alt="Imagem <?php $f->nome?>" src="<?php echo $f->urlImagem?>">
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
		<?php endforeach;?>		
	</div>

	<?php 
	
	include 'shared/_footer.php';
	include 'shared/_scripts.php';
	
	?>
	
	<!-- script src="assets/js/fundadores/agency.js"></script-->
</body>
</html>