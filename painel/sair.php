<?php
@session_start();
if(count($_SESSION)){
	foreach($_SESSION as $field=>$value){
		unset($_SESSION[$field]);
	}
}
unset($_SESSION);
session_destroy();
die('<script>window.location.href="../index.php?page=destaques";</script>');
exit();

?>