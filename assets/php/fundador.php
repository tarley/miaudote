<?php

	class Disciplina {		
		public $nome;
		public $fundadores;
		
		function __construct($nome, $fundadores) {
			$this->nome = $nome;
			$this->fundadores = $fundadores;
		}
	}

	class Fundador {
		
		public $nome;
		public $papel;
		public $urlImagem;
		public $twitter;
		public $facebook;
		public $linkedin;
		
		
		function __construct($nome, $papel, $urlImagem, $twitter, $facebook, $linkedin) {
			$this->nome = $nome;
			$this->papel = $papel;
			
			if(empty($urlImagem))
				$this->urlImagem = "images/fundadores/desconhecido.jpg";
			else
				$this->urlImagem = "images/fundadores/" . $urlImagem;
			
			$this->twitter = $twitter;
			$this->facebook = $facebook;
			$this->linkedin = $linkedin;
		}
	}
	
	$disciplinas = array(
			
			
			
	);
	
?>