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
        <button type="button" class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#MenuNavegacion">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div id="MenuNavegacion" class=" offcanvas offcanvas-start w-50">
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
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
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

                <l1><a class="dropdown-item" href="#"><?php echo $row2->nombre_categoria;?></a></l1>
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

  <div style="background: #29A8FF">
    <div class="container">

    </div>
  </div>

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