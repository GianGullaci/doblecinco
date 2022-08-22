
<?php
  $mysqli = new mysqli("localhost", "doble5jl_main", "marilina01", "doble5jl_main");

  /* comprobar la conexión */
  if (mysqli_connect_errno()) {
      printf("Falló la conexión: %s\n", mysqli_connect_error());
      exit();
  }
  
  
    /* Preparar una sentencia INSERT */
  
    $consulta = "DELETE FROM carpetas_galerias WHERE hash = '".$_POST['hash']."' ";
    $sentencia = $mysqli->prepare($consulta);
     echo $consulta;
//     exit;

    /* Ejecutar la sentencia */
    $sentencia->execute();

    /* cerrar la sentencia */
    $sentencia->close();
    
    $consulta = "UPDATE carpetas_galerias SET hash = REPLACE(hash, '".$_POST['hash']."', 'xxxYYY') WHERE hash LIKE ('".$_POST['hash']."%')";
    $sentencia = $mysqli->prepare($consulta);
     echo $consulta;

    /* Ejecutar la sentencia */
    $sentencia->execute();

    /* cerrar la sentencia */
    $sentencia->close();
  
?>
