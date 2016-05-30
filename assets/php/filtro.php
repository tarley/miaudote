<?php
require_once 'conexao.php';
$pdo = conectar ();

$load = $_POST['load'];
		
$query =	"select 	e.nom_estado,
						e.sg_uf,
						c.nom_cidade,
						c.cod_cidade,
						a.cod_usuario,
						u.nom_usuario,
						a.cod_animal,
						a.nom_animal,
						f.cod_foto,
						f.nom_foto,
						f.url,
					  case
					  when esp.cod_especie = 1 then 'cao'
					  when esp.cod_especie = 2 then 'gato'
						end as cod_especie,
						a.cor,
						a.idade,
						case
							when a.ind_porte = 0 then 'pequeno'
							when a.ind_porte = 1 then 'medio'
							when a.ind_porte = 2 then 'grande'
							else 'indefinido'
						end as ind_porte,
						case
							when a.ind_sexo = 1 then 'macho'
							when a.ind_sexo = 2 then 'femea'
						end as ind_sexo
					from
						tb_animal a inner join tb_especie esp on(a.cod_especie = esp.cod_especie)
									inner join tb_foto    f   on(a.cod_animal  = f.cod_animal)
									inner join tb_usuario u   on(a.cod_usuario = u.cod_usuario)
									inner join tb_cidade  c   on(a.cod_cidade  = c.cod_cidade)
									inner join tb_estado  e   on(c.cod_estado  = e.cod_estado)
					where
						f.id_foto_pri = 's'";

/* Se primeiro acesso a p�gina */
if ($load == 'true') {
	
	
	
} else {
	
	$fnome = $_POST['fnome'];
	$festado = $_POST['festado'];
	$fcidade = $_POST['fcidade'];
	$fpequeno = $_POST['fpequeno'];
	$fmedio = $_POST['fmedio'];
	$fgrande = $_POST['fgrande'];
	$fmacho = $_POST['fmacho'];
	$ffemea = $_POST['ffemea'];
	
	// Nome
	if (!empty($fnome)) {
		$query .= " and a.nom_animal like '%" .$fnome. "%'";
	}
	
	// Cidade - Estado
	if (!empty($festado) && empty($fcidade)) {
		$query .= " and e.sg_uf = '" .$festado. "'";
	} elseif (empty($festado) && !empty($fcidade)) {
		$query .= " and c.cod_cidade = '" .$fcidade. "'";
	} elseif (!empty($festado) && !empty($fcidade)) {
		$query .= " and (e.sg_uf = '" .$festado. "' or c.cod_cidade = '" .$fcidade. "')";
	}
	
	// Porte
	
	// Sexo

}

$query .= " limit 20";	// Limite máximo de exibições

$listaAnimal = $pdo->query ($query);

if ($listaAnimal) {
	while ( $row = $listaAnimal->fetch ( PDO::FETCH_ASSOC ) ) {
		echo "<li class='mix " . $row ["nom_animal"] . " " . $row ["cor"] . " " . $row ["cod_especie"] . " " . $row ["idade"] . "a " . $row ["ind_porte"] . " " . $row ["ind_sexo"] . " " . $row ["sg_uf"] . " c" . ( $row ["cod_cidade"] ) . "'>
							<div class='imgHolder'>
								<figure>
								<img id='animal-filtro' data-value='" . $row ['cod_animal'] . "'  src='".substr($row ['url'],3)."' >
								<hr>
								<p>
									" . $row ['nom_animal'] . "
								</p>
								<figcaption>
									<h3>" . utf8_encode ( $row ['nom_cidade'] ) . " - " . $row ['sg_uf'] . "</h3>
									<span>" . $row ["ind_sexo"] . ", " . $row ["idade"] . " ano(s)</span>
									<a href='#conteudo' id='animal-filtro' data-value='" . $row ['cod_animal'] . "'>Perfil</a>
								</figcaption>
								</figure>
							</div>
						</li>";
	}
}


?>