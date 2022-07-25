<section class="pt-4 pb-0 card-grid">
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
</section>

<footer class="bg-dark pt-0">
        <div class="container">
            <div class="row pt-1 align-items-center justify-content-md-between">
                <div class="col-md-4 text-light py-3">
                    <div class="text-center text-md-start">
                        <font style="vertical-align: inherit;">© Copyright D5 2022</font>
                    </div>
                </div>
                <div class="col-md-4 text-light py-3">
                    <div class="text-center text-md-center">
                        <ul class="nav justify-content-center">
                            <l1 class="nav-item"><a class="nav-link px-2 fs-5 text-white" href="https://www.facebook.com/doblecincobahia" target="_blank"><i class="bi bi-facebook"></i></a></l1>
                            <l1 class="nav-item"><a class="nav-link px-2 fs-5 text-white" href="https://www.twitter.com/doblecincobahia" target="_blank"><i class="bi bi-twitter"></i></a></l1>
                            <l1 class="nav-item"><a class="nav-link px-2 fs-5 text-white" href="https://www.instagram.com/doblecincobahia/" target="_blank"><i class="bi bi-instagram"></i></a></l1>
                            <l1 class="nav-item"><a class="nav-link px-2 fs-5 text-white" href="https://www.youtube.com/channel/UCQgHOUzwUX6X3HR1vtpZLDA" target="_blank"><i class="bi bi-youtube"></i></a></l1>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 text-light py-3">
                    <div class="text-center text-md-end">
                        <font style="vertical-align: inherit;text-align:right;">Dirección: Bahía Blanca, Buenos Aires, Argentina</font>
                    </div>
                </div>
            </div>
        </div>
</footer>