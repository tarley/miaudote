<?php
require_once 'DB.php';
function conectar(){
	$pdo= new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
	return $pdo;
}
?>