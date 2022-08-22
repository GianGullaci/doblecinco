<?php  session_start();
 $username = $_POST['username'];   $username = str_replace(array( '=' ), '', $username);
    if (isset ($_POST['username'])){
		include("coneccion.php");
		$psw=md5($_POST['password']);
		$query = "SELECT * FROM administradores WHERE nombre_usuario='".$username."' AND password='".$psw."'";
		$result = $mysqli->query($query); 
		if ($row = mysqli_fetch_array($result)){
			$_SESSION['admin']=1;
			$_SESSION['id_admin']=$row['id_administrador'];
			$_SESSION['nombre_admin']=$row['nombre'];
			$_SESSION['email_admin']=$row['nombre_usuario'];
			header("Location: ../index.php");
		}
		else{
			header("Location: ../login-admin.php");
		}
		
	}
?>
