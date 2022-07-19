<section class="pt-4 pb-0 card-grid">
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
</section>
   <!--<footer>
    <section class="pt-4 pb-0">
    <div class="container-fluid bg-dark fixed-bottom">
        <div class="row">
            <div class=" footer col-md text-light py-3">
                Desarrollado por Gian
            </div>
        </div>
    </div>
    </section>
    </footer>-->
    

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>
</html>