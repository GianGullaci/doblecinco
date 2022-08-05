<!doctype html>
<html lang="es" style="height: 100%;">
  <head>
    <title>Doble 5</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/styles.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

    <link rel="shortcut ico" href="/img/home/c iso d5 1.png" class="favicon">

    <STYLE>A {text-decoration: none;} </STYLE>

  </head>
  
  <body > 
  
  <script>
    document.addEventListener("DOMContentLoaded", function(){
      if (window.innerWidth > 992) {
	      document.querySelectorAll('.navbar .nav-item').forEach(function(everyitem){

		      everyitem.addEventListener('mouseover', function(e){

			      let el_link = this.querySelector('a[data-bs-toggle]');

			      if(el_link != null){
				      let nextEl = el_link.nextElementSibling;
				      el_link.classList.add('show');
				      nextEl.classList.add('show');
			      }

		      });
		      everyitem.addEventListener('mouseleave', function(e){
			      let el_link = this.querySelector('a[data-bs-toggle]');

			      if(el_link != null){
				      let nextEl = el_link.nextElementSibling;
				      el_link.classList.remove('show');
				      nextEl.classList.remove('show');
			      }


		      })
	      });

      }
    // end if innerWidth
    }); 
  </script>
 
  <header class="navbar-light navbar-sticky header-static bg-white">
    <nav class="navbar navbar-expand-lg p-0">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img class="logo" src="img/home/logo3_pc.png" /></a>
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
        <button type="button" class="navbar-toggler button-offcanvas" data-bs-toggle="offcanvas" data-bs-target="#MenuNavegacion">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div id="MenuNavegacion" class=" offcanvas offcanvas-end">
          <div class="offcanvas-header">
            <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <u1 class="navbar-nav mx-auto" >

            <li class="nav-item w-100">
							<a class="nav-link" href="index.php">Inicio</a>
						</li>

            <?php
              include_once "model\conexion.php";
              $sentencia = $bd -> query("select * from categorias_notas
                                          where categorias_notas_id_categoria_notas=0 and activa=1");
              $result = $sentencia->fetchAll(PDO::FETCH_OBJ);
              foreach($result as $row){
            ?>

            <l1 class="nav-item dropdown w-100">
              <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown">
                <?php echo $row->nombre_categoria;?>
              </a>
              <u1 class="dropdown-menu">

                <?php
                  include_once "model/conexion.php";
                  $sentencia = $bd -> query("select * from    categorias_notas
                                          where categorias_notas_id_categoria_notas='$row->id_categoria_notas' and activa=1");
                  $result2 = $sentencia->fetchAll(PDO::FETCH_OBJ);
                  foreach($result2 as $row2){
                ?>

                <l1><a class="dropdown-item" href="listado-notas.php?id=<?php echo $row2->id_categoria_notas;?>"><?php echo $row2->nombre_categoria;?></a></l1>
                <?php
								  }
							  ?>
              </u1>
            </l1>
            <?php
								}
							?>
          </u1>
        </div> 
      </div>
    </nav>
  </header>

  <section class="pt-4 pb-0 card-grid">
    <div style="background: #29A8FF">
      <div class="container">
        <center style="padding: 0px 0px 0px 0px;">
          <div class="row g-4 pt-2 pb-2 align-items-center statistics">
            <div class="col-4 mt-0">
              <div class="card align-items-center mt-0 mb-0">
                <a href="posiciones.php">
                  <img class="pt-2 pb-2" src="img/logo-posiciones.png" height="50px" alt="">
                  <p class="font-weight-bold mb-0 text-dark fw-bold" style="display:inline-block;">Posiciones</p>
                </a>
              </div>
            </div>
            <div class="col-4 mt-0">
              <div class="card align-items-center mt-0 mb-0">
                <a href="goleadores.php">
                  <img class="pt-2 pb-2" src="img/logo-goleadores.png" height="50px" alt="">
                  <p class="font-weight-bold mb-0 text-dark fw-bold" style="display:inline-block;">Goleadores</p>
                </a>
              </div>
            </div>
            <div class="col-4 mt-0">
              <div class="card align-items-center mt-0 mb-0">
                <a href="fixture.php">
                  <img class="pt-2 pb-2" src="img/logo-estadisticas.png" height="50px" alt="">
                  <p class="font-weight-bold mb-0 text-dark fw-bold" style="display:inline-block;">Fixture</p>
                </a>
              </div>
            </div>
          </div>
        </center>
      </div>
    </div>
  </section>

  <div  style="background: #ced4da">
    <div class="container">
      <center style="padding: 0px 0px 0px 0px;">
        <?php
          include_once "model/conexion.php";
          $sentencia = $bd -> query( "select * from clubes where club_activo=1");
          $clubes = $sentencia->fetchAll(PDO::FETCH_OBJ);
          foreach($clubes as $dato){
        ?>
                
        <div style="margin: 13px;display:inline-block;width: 30px;">
            <a href="club.php?id_club=<?php echo $dato->id_club;?>"  title="<?php echo $dato->nombre_club;?>">
                <img width="40px" src="img/logos/<?php echo $dato->logo_club2; ?>" />
            </a>
        </div>
        <?php
            }
        ?>
      </center>
    </div>
  </div>