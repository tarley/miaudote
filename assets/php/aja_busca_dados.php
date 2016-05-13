<?php
define('PATH', '../../');
define('IMG_ADM_PATH', '../../');

Error_reporting ( 0 );
require_once PATH.'assets/php/conexao.php';
require_once PATH.'seguranca.php';
protectPage();
$pdo = conectar ();


$tipo	=	@$_GET['tipo'];


switch($tipo){

	case 'cidade':

			$estado	=	(int)$_GET['estado'];
			$qry 	= 	"select * from tb_cidade WHERE COD_ESTADO='".$estado."' ORDER BY NOM_CIDADE";
			$ls 	= 	$pdo->query ($qry);
			
			while ( $row = $ls->fetch ( PDO::FETCH_ASSOC ) ):
				$cidade[] = array(
					'id_cidade'	=> $row['COD_CIDADE'],
					'cidade' 	=> utf8_encode($row['NOM_CIDADE']),
				);
			endwhile;
				
			echo(json_encode($cidade));
		
		break;
}


?>