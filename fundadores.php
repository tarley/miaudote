<?php 
		if(isset($fundadores)){
			include 'assets/php/fundador.php';
		}
		
		$fundadoresSI = array (
				new Fundador ( 'Ariane Silva', 'Analista de testes', 'images/fundadores/Ariane_Silva.jpg', '', '', '' ),
				new Fundador ( 'Bruna Frazoni', 'Desenvolvedora', 'images/fundadores/Bruna_Frazoni.jpg', '', '', '' ),
				new Fundador ( 'Cibele Castelo', 'Product Owner', 'images/fundadores/Cibele_Castelo.jpg', '', '', '' ),
				new Fundador ( 'Igor Yuri', 'Product Owner', 'images/fundadores/Igor_Yuri.jpg', '', '', '' ),
				new Fundador ( 'Juliano Savio', 'Desenvolvedor', 'images/fundadores/Juliano_Savio.jpg', '', '', '' ),
				new Fundador ( 'Lucas Raphael', 'Desenvolvedor', 'images/fundadores/Lucas_Raphael.JPG', '', '', '' ),
				new Fundador ( 'Luiz Henrique', 'Desenvolvedor', 'images/fundadores/Luiz_Henrique.jpg', '', '', '' ),
				new Fundador ( 'Marcela Simão', 'Desenvolvedora', 'images/fundadores/Marcela_Simao.jpg', '', '', '' ),
				new Fundador ( 'Felipe Sangiorge', 'Analista de testes', 'images/fundadores/Felipe_Sangiorge.jpg', '', '', '' ),
				new Fundador ( 'Albert Rocha', 'Analista de testes', 'images/fundadores/Albert_Rocha.jpg', '', '', '' ),
				new Fundador ( 'Gustavo Resende', 'Administrador de Banco de Dados', 'images/fundadores/Gustavo_Resende.jpg', '', '', '' ),
				new Fundador ( 'Carlos Alberto', 'Desenvolvedor', 'images/fundadores/Carlos_Alberto.jpg', '', '', '' ),
				new Fundador ( 'Geovane Nascimento', 'Analista de testes', 'images/fundadores/geovane_silva.jpg', '', '', '' ),
				new Fundador ( 'Jeferson Eustáquio', 'Desenvolvedor', 'images/fundadores/desconhecido.jpg', '', '', '' ),
				new Fundador ( 'Tarley Lana', 'Prof.Orientador', 'images/fundadores/Tarley_Lana.jpg', '', '', '' )
		);
		
		$fundadoresVet = array (
				new Fundador ( 'Anna Carolina', 'Orientado de extensão', 'images/fundadores/Anna_Carolina.jpg', '', '', '' ),
				new Fundador ( 'Bárbara Magalhães', 'Orientado de extensão', 'images/fundadores/Barbara_Magalhaes.jpg', '', '', '' ),
				new Fundador ( 'Bety Saara', 'Orientado de extensão', 'images/fundadores/Bety_Saara.jpg', '', '', '' ),
				new Fundador ( 'Carlos Carvalho', 'Orientado de extensão', 'images/fundadores/Carlos_Carvalho.jpg', '', '', '' ),
				new Fundador ( 'Carolina Oliveira', 'Orientado de extensão', 'images/fundadores/Carolina_Oliveira.jpg', '', '', '' ),
				new Fundador ( 'Célia Charchar', 'Orientado de extensão', 'images/fundadores/Celia_Charchar.jpg', '', '', '' ),
				new Fundador ( 'Daniel Dimas', 'Orientado de extensão', 'images/fundadores/Daniel_Dimas.jpg', '', '', '' ),
				new Fundador ( 'Gabriel Alcântara', 'Orientado de extensão', 'images/fundadores/Gabriel_Alcantara.jpg', '', '', '' ),
				new Fundador ( 'Gabriel Wnuk', 'Orientado de extensão', 'images/fundadores/Gabriel_Wnuk.jpg', '', '', '' ),
				new Fundador ( 'Izabella Maria', 'Orientado de extensão', 'images/fundadores/Izabella_Maria.jpg', '', '', '' ),
				new Fundador ( 'Luiza Fernandes', 'Orientado de extensão', 'images/fundadores/Luiza_Fernandes.jpg', '', '', '' ),
				new Fundador ( 'Pollyanna Ferreira', 'Orientado de extensão', 'images/fundadores/Pollyanna_Ferreira.jpg', '', '', '' ),
				new Fundador ( 'Paula Cambraia', 'Prof(a).Orientadora', 'images/fundadores/Paula_Cambraia.jpg', '', '', '' )
		);
		
		$disciplinas = array (
				new Disciplina ( "Sistemas de Informação - 8º Período", $fundadoresSI ),
				new Disciplina ( "Veterinária - 8º Período", $fundadoresVet )
		);
		
		?>
			
			<!--<div class="container-fundador">-->
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
			<!--</div>-->
			
