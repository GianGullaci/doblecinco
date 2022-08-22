<?php  session_start();
	if (isset($_SESSION['admin']) and $_SESSION['admin']==1){
		header("Location: index.php");
	}
    
?>
