<?php
session_start();
error_reporting(E_ALL);
date_default_timezone_set('Etc/UTC');
require 'PHPMailerAutoload.php';
require 'util.php';

/*Variaveis vindas do formulario*/
$nomeRemetente  = $_POST['name'];
$emailRemetente = $_POST['email'];
$msg			= $_POST['comment'];

/*Variaveis globais*/

enviaEmail($nomeRemetente,$emailRemetente,$msg);
?>