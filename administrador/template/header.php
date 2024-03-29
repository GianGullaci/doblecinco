<?php include("session.php") ?>

<!doctype html>
<html lang="es">
  <head>
    <title>ADMIN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-light bg-light border-3 border-bottom border-primary">
      <div class="container-fluid">
        <a href="index.php" class="navbar-brand">ADMIN</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#MenuNavegacion">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div id="MenuNavegacion" class="collapse navbar-collapse">
          <u1 class="navbar-nav ms-3">
            <l1 class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Torneos
              </a>
              <u1 class="dropdown-menu">
                <l1><a class="dropdown-item" href="torneos.php">Torneos</a></l1>
                <l1><a class="dropdown-item" href="fechas.php">Fechas</a></l1>
                <l1><a class="dropdown-item" href="partidos.php">Partidos</a></l1>
                <l1><a class="dropdown-item" href="nuevo-partido.php">Cargar Partido</a></l1>
              </u1>
            </l1>
            <l1 class="nav-item"><a class="nav-link" href="clubes.php">Clubes</a></l1>
            <l1 class="nav-item"><a class="nav-link" href="equipos.php">Equipos</a></l1>
            <l1 class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Jugadores
              </a>
              <u1 class="dropdown-menu">
                <l1><a class="dropdown-item" href="jugadores.php">Listado Jugadores</a></l1>
                <l1><a class="dropdown-item" href="nuevo-jugador.php">Cargar Jugador</a></l1>
              </u1>
            </l1>
            <l1 class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                Notas
              </a>
              <u1 class="dropdown-menu">
                <l1><a class="dropdown-item" href="notas.php">Listado Notas</a></l1>
                <l1><a class="dropdown-item" href="nuevo-nota.php">Cargar Nota</a></l1>
                <l1><a class="dropdown-item" href="autores.php">Autores</a></l1>
              </u1>
            </l1>
            <l1 class="nav-item"><a class="nav-link" href="ciudades.php">Ciudades</a></l1>
            <l1 class="nav-item"><a class="nav-link" href="usuarios.php">Administradores</a></l1>
          </u1>
        </div> 
        <a href="logout.php" class="btn btn-primary">Salir</a>
      </div>
    </nav>