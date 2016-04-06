<?php
require_once 'DB.php';
function conectar(){
	$pdo= new PDO('mysql:host=localhost;dbname=adote','root','');
	return $pdo;
}
?>