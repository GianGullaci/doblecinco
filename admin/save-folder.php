
<?php
  $mysqli = new mysqli("localhost", "doble5jl_main", "Racing123club", "doble5jl_main");

  /* comprobar la conexión */
  if (mysqli_connect_errno()) {
      printf("Falló la conexión: %s\n", mysqli_connect_error());
      exit();
  }
  
  
    /* Preparar una sentencia INSERT */
    echo $_POST['name'];
    echo $_POST['path'];
    $name = $mysqli->real_escape_string($_POST['name']);
    $path = $mysqli->real_escape_string($_POST['path']);
    echo $name;
    echo $path;
    $consulta = "INSERT INTO carpetas_galerias (nombre_carpeta, ruta_carpeta, hash) VALUES ('".$name."','".$path."','".$_POST['hash']."')";
    $sentencia = $mysqli->prepare($consulta);
     echo $consulta;
//     exit;

    /* Ejecutar la sentencia */
    $sentencia->execute();

    /* cerrar la sentencia */
    $sentencia->close();
    
     $consulta = "UPDATE carpetas_galerias SET hash = REPLACE(hash, 'xxxYYY', '".$_POST['hash']."') WHERE hash LIKE ('xxxYYY%')";
    $sentencia = $mysqli->prepare($consulta);
     echo $consulta;

    /* Ejecutar la sentencia */
    $sentencia->execute();

    /* cerrar la sentencia */
    $sentencia->close();
    
     $consulta = "DELETE FROM carpetas_galerias WHERE hash LIKE ('xxxYYY%')";
    $sentencia = $mysqli->prepare($consulta);
     echo $consulta;
//     exit;

    /* Ejecutar la sentencia */
    $sentencia->execute();

    /* cerrar la sentencia */
    $sentencia->close();
  
?>
