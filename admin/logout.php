<?php    
    session_start();
	//Para destruir una variable en específico

	session_unset();
	unset($_SESSION['id_admin']);
	unset($_SESSION['nombre_admin']);
	unset($_SESSION['email_admin']);
	session_destroy();
	
	header("Location: index.php");
	exit;   
    
?>
