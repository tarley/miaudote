<?php
	error_reporting(0);
	class Upload{
		private $arquivo;
		private $altura;
		private $largura;
		private $pasta;

		function __construct($arquivo, $altura, $largura, $pasta){
			$this->arquivo = $arquivo;
			$this->altura  = $altura;
			$this->largura = $largura;
			$this->pasta   = $pasta;
		}
		
		private function getExtensao() {
			//retorna a extensao da imagem 
			$nomeExplodido = explode('.', $this->arquivo['name']);
			$ext = end($nomeExplodido);
					
			return strtolower($ext);
		}
		
		private function ehImagem($extensao){
			$extensoes = array('gif', 'jpeg', 'jpg', 'png');	 // extensoes permitidas
			if (in_array($extensao, $extensoes))
				return true;	
		}
		
		//largura, altura, tipo, localizacao da imagem original
		private function redimensionar($imgLarg, $imgAlt, $tipo, $img_localizacao){
			//descobrir novo tamanho sem perder a proporcao
			/*if ( $imgLarg > $imgAlt ){
				$novaLarg = $this->largura;
				$novaAlt = round( ($novaLarg / $imgLarg) * $imgAlt );
			}
			elseif ( $imgAlt > $imgLarg ){
				$novaAlt = $this->altura;
				$novaLarg = round( ($novaAlt / $imgAlt) * $imgLarg );
			}
			else // altura == largura
				$novaAltura = $novaLargura = max($this->largura, $this->altura);*/
			
			$novaAlt =  $this-> altura;
			$novaLarg = $this-> largura;
			//redimencionar a imagem
			
			//cria uma nova imagem com o novo tamanho	
			$novaimagem = imagecreatetruecolor($novaLarg, $novaAlt);
			
			switch ($tipo){
				case 1:	// gif
					$origem = imagecreatefromgif($img_localizacao);
					imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0,
					$novaLarg, $novaAlt, $imgLarg, $imgAlt);
					imagegif($novaimagem, $img_localizacao);
					break;
				case 2:	// jpg
					$origem = imagecreatefromjpeg($img_localizacao);
					imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0,
					$novaLarg, $novaAlt, $imgLarg, $imgAlt);
					imagejpeg($novaimagem, $img_localizacao);
					break;
				case 3:	// png
					$origem = imagecreatefrompng($img_localizacao);
					imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0,
					$novaLarg, $novaAlt, $imgLarg, $imgAlt);
					imagepng($novaimagem, $img_localizacao);
					break;
			}
			
			//echo $img_localizacao." local";
			//destroi as imagens criadas
			imagedestroy($novaimagem);
			imagedestroy($origem);
		}
		
		public function salvar(){									
			$extensao = $this->getExtensao();
			
			//gera um nome unico para a imagem em funcao do tempo
			$novo_nome = md5(time(uniqid($upload['name']))).md5(uniqid(time())). "." .$extensao;
			//localizacao do arquivo 
			$destino = $this->pasta . $novo_nome;
			
			//move o arquivo
			if (!move_uploaded_file($this->arquivo['tmp_name'], $destino)){
				if ($this->arquivo['error'] == 1)
					return "Tamanho excede o permitido";
				else
					return "Erro " . $this->arquivo['error'];
			}else{
				
				//return $destino;
				
				if ($this->ehImagem($extensao)){												
					//pega a largura, altura, tipo e atributo da imagem
					list($largura, $altura, $tipo, $atributo) = getimagesize($destino);

					$this->redimensionar($largura, $altura, $tipo, $destino); //Inbdependente do tamanho da imagem ele irá redimensionar seja para mais ou para menos

					$imgGrava = $novo_nome;	
				}else{
					$imgGrava ="";
				}
			}
			
			return $imgGrava;
		}
	
	}
	
	
	/*
	function up_arquivo_foto($images,$patch){
				
		//@set_time_limit(0);
		//$extensao	=	@strtolower(@end(explode('.',$upload['name'])));
		//$array_formato	=	array("png","jpg","gif","jpeg","bmp");
		
		echo $images;
		/*if(!empty($images)){ 

			$upload = new Upload($images,512,512,$patch); 
			// Determinamos nossa largura máxima permitida para a imagem
			//$upload->width = 250; 
			// Determinamos nossa altura máxima permitida para a imagem
			//$upload->height = 250; 

			// Exibimos a mensagem com sucesso ou erro retornada pela função salvar.
			//Se for sucesso, a mensagem também é um link para a imagem enviada.
			$upload->salvar();
			
			return $upload->salvar();
			
		}

	}*/

	
?>