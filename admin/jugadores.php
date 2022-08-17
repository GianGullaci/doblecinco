<?php include 'template/header.php' ?>


<?php
    include_once "../model/conexion.php";
    $sentencia = $bd -> query( "SELECT jugadores.nombre_jugador as nombre_jugador, jugadores.fecha_nacimiento as fecha_nacimiento,
    jugadores.id_jugador as id_jugador, ciudades.nombre as nombre_ciudad, jugadores.activo as activo,
    puesto.nombre_puesto as puesto, clubes.nombre_club as nombre_club
    FROM jugadores 
    left join ciudades on ciudades.id_ciudad=jugadores.ciudades_id_ciudad
    left join puesto on puesto.id_puesto=jugadores.puesto_id_puesto
    left join clubes on clubes.id_club=jugadores.clubes_id_club
    WHERE activo = 1
    order by nombre_jugador");
    $jugadores = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container my-5">
    <div class="row justify-content-center g-4">
        <div class="col-lg-8">

            <!-- inicio alerta-->
            
            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">          
                <strong>Error!</strong> Falta ingresar el nombre
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">          
                <strong>Registrado!</strong> Se agregaron los datos
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">          
                <strong>Error!</strong> Vuelve a intentar.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">          
                <strong>Editado!</strong> Se editaron los datos
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">          
                <strong>Eliminado!</strong> Se eliminaron los datos
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

            <?php
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'PartidosAsociados'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">          
                <strong>Error!</strong> Posee partidos asociados.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                }
            ?>

            <!-- fin alerta-->


            <div class="card">
                <div class="card-header">
                    Lista de Jugadores
                </div>
                <div class="p-4 table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha Nacimiento</th>
                                <th scope="col">Equipo</th>
                                <th scope="col">Posición</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($jugadores as $dato){
                            ?>

                            <tr>
                                <td><?php echo $dato->nombre_jugador; ?></td>
                                <td><?php echo date("d-m-Y", strtotime($dato->fecha_nacimiento)) ?></td>
                                <td><?php echo $dato->nombre_club; ?></td>
                                <td><?php echo $dato->puesto; ?></td>
                                <td><a class="text-success" href="editar-jugador.php?id_jugador=<?php echo $dato->id_jugador;?>"><i class="bi bi-pencil-square"></i></a></td>
                                <td><a onclick="return confirm('Estás seguro de eliminar?');" class="text-danger" href="eliminar-jugador.php?id_jugador=<?php echo $dato->id_jugador;?>"><i class="bi bi-trash-fill"></i></a></td>
                            </tr>

                            <?php
                                }
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>