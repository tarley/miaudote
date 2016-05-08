<?php
	function navigation(){
		$permitidos = array('404','perfil','destaques','fundadores','recem_adotados','login','recuperar_acesso');	
				
		$page = (isset($_GET['page']))? $_GET['page'] : 'firstAccessPage';
		$sub  = (isset($_GET['sub'])) ? $_GET['sub']  : 'firstAccessSub';
		
		if($page !='firstAccessPage'){
			if((array_search($page,$permitidos)!== false)){
				if($sub !='firstAccessSub'){
					if((array_search($sub,$permitidos)!== false)){
						include("$page.$sub.php");
					}else{
						include("404.php");	
					}	
				}else{
					include("$page.php");
				}					
			}else{
				include('404.php');
			}	
		}else{
			header("location:index.php?page=destaques");
		}
	}
?>
