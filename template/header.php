<!doctype html>
<html lang="es" style="height: 100%;">
  <head>
    <title>Doble 5</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

    <link rel="shortcut ico" href="/img/home/c iso d5 1.png iso d5 1.png" class="favicon">

    <STYLE>A {text-decoration: none;} </STYLE>

    <?php
        include_once "model/conexion.php";
        $sentencia = $bd -> query( "select * from equipos");
        $equipos = $sentencia->fetchAll(PDO::FETCH_OBJ);
    ?>
  </head>

  <body > 
 
  <header class="navbar-light navbar-sticky header-static bg-white">
    <nav class="navbar navbar-expand-lg p-0">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img width="300px" src="img/home/logo3_pc.png" /></a>
            <div class="navbar-item d-none d-xl-block">
            <div class="nav-item text-muted" id="current_date">
              <script>
                var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                var f=new Date();
                document.write(diasSemana[f.getDay()] + " " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
              </script>
            </div>
              <ul class="nav justify-content-center">
                <l1 class="nav-item"><a class="nav-link px-2 fs-5 text-secondary" href="https://www.facebook.com/doblecincobahia" target="_blank"><i class="bi bi-facebook"></i></a></l1>
                <l1 class="nav-item"><a class="nav-link px-2 fs-5 text-secondary" href="https://www.twitter.com/doblecincobahia" target="_blank"><i class="bi bi-twitter"></i></a></l1>
                <l1 class="nav-item"><a class="nav-link px-2 fs-5 text-secondary" href="https://www.instagram.com/doblecincobahia/" target="_blank"><i class="bi bi-instagram"></i></a></l1>
                <l1 class="nav-item"><a class="nav-link px-2 fs-5 text-secondary" href="https://www.youtube.com/channel/UCQgHOUzwUX6X3HR1vtpZLDA" target="_blank"><i class="bi bi-youtube"></i></a></l1>
              </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg fw-bold p-0">
      <div class="container">
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
              </u1>
            </l1>
            <l1 class="nav-item"><a class="nav-link" href="equipos.php">Equipos</a></l1>
            <l1 class="nav-item"><a class="nav-link" href="jugadores.php">Jugadores</a></l1>
            <l1 class="nav-item"><a class="nav-link" href="ciudades.php">Ciudades</a></l1>
            <l1 class="nav-item"><a class="nav-link" href="usuarios.php">Administradores</a></l1>
          </u1>
        </div> 
      </div>
    </nav>
  </header>

  <div style="background: #29A8FF">
    <div class="container">

    </div>
  </div>

  <div  style="background: #ced4da">
    <div class="container">
      <center style="padding: 0px 0px 0px 0px;">
        <?php
            foreach($equipos as $dato){
        ?>
                
        <div style="margin: 10px;display:inline-block;width: 60px;">
            <a href="club.php?id_equipo=<?php echo $dato->id_equipo;?>"  title="<?php echo $dato->nombre_equipo;?>">
                <img width="40px" src="imagenes/<?php echo $dato->logo_equipo; ?>" />
            </a>
        </div>
        <?php
            }
        ?>
      </center>
    </div>
  </div>