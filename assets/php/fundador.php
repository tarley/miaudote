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
			$this->urlImagem = $urlImagem;
			$this->twitter = $twitter;
			$this->facebook = $facebook;
			$this->linkedin = $linkedin;
		}
	}
	
	$disciplinas = array(
	
	);
	
?>