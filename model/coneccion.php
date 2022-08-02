<?php    
   $mysqli = new mysqli("localhost", "root", "", "doble5jl_db");

  /* comprobar la conexi�n */
  if (mysqli_connect_errno()) {
      printf("Fall� la conexi�n: %s\n", mysqli_connect_error());
      exit();
  }
    
?>
