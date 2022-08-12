<?php include 'template/header.php' ?>

<?php
    include_once "../model/conexion.php";
    $sentencia = $bd -> query( "SELECT id_partido, fecha_partido, hora_partido,lugares.direccion as lugar, tipo_lugar, zona, 
    club_juega.nombre_club as nombre_juega, club_local.nombre_club as nombre_local, neutral, nombre_neutral, 
    club_visitante.nombre_club as nombre_visitante, nombre_categoria,  fechas.nombre as nombre_fecha, 
    nombre_torneo, DATEDIFF(fecha_partido,CURDATE()) as dif,
    equipo_local.nombre_equipo as nombre_equipo_local,
    equipo_visitante.nombre_equipo as nombre_equipo_visitante
    FROM partidos 
    left join equipos as equipo_local on equipo_local.id_equipo=partidos.equipos_id_equipo
    left join clubes as club_local on club_local.id_club=equipo_local.clubes_id_club
    left join equipos as equipo_visitante on equipo_visitante.id_equipo=partidos.equipos_id_equipo1
    left join clubes as club_visitante on club_visitante.id_club=equipo_visitante.clubes_id_club
    left join categorias on categorias.id_categoria=equipo_visitante.categorias_id_categoria
    left join fechas on fechas.id_fecha=partidos.fechas_id_fecha
    left join torneos on fechas.torneos_id_torneo1=torneos.id_torneo
    left join lugares on partidos.lugares_id_lugar=lugares.id_lugar
    left join clubes as club_juega on club_juega.id_club=lugares.clubes_id_club
    order by fecha_partido");
    $partidos = $sentencia->fetchAll(PDO::FETCH_OBJ);    
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-10">

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
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'equiposIguales'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">          
                <strong>Error!</strong> Los equipos no pueden ser iguales.
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

            <!-- fin alerta-->


            <div class="card">
                <div class="card-header">
                    Lista de Partidos
                </div>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Torneo</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Zona</th>
                                <th scope="col">Día</th>
                                <th scope="col">Categoría</th>
                                <th scope="col">Local</th>
                                <th scope="col">Visitante</th>
                                <th scope="col" colspan="4">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($partidos as $dato){
                            ?>

                            <tr>
                                <td><?php echo $dato->nombre_torneo; ?></td>
                                <td><?php echo $dato->nombre_fecha; ?></td>
                                <td><?php echo $dato->zona; ?></td>
                                <?php if ($dato->fecha_partido!="0000-00-00 00:00:00"){
										echo "<td class='center'>".date("d-m-Y", strtotime($dato->fecha_partido))."</td>";
									}
									else{
										echo "<td class='center'>Sin definir</td>";
									}?>
                                <td><?php echo $dato->nombre_categoria; ?></td>
                                <td><?php echo $dato->nombre_equipo_local; ?></td>
                                <td><?php echo $dato->nombre_equipo_visitante; ?></td>
                                <td><a class="text-success" href="editar-partido.php?id_partido=<?php echo $dato->id_partido;?>"><i class="bi bi-pencil-square"></i></a></td>

                                <td><a class="text-success" href="jugadores-partido.php?id_partido=<?php echo $dato->id_partido;?>"><i class="bi bi-person"></i></a></td>

                                <td><a class="text-success" href="goles-partido.php?id_partido=<?php echo $dato->id_partido;?>"><i class="bi bi-dribbble"></i></a></td>

                                <td><a onclick="return confirm('Estás seguro de eliminar?');" class="text-danger" href="eliminar-partido.php?id_partido=<?php echo $dato->id_partido;?>"><i class="bi bi-trash-fill"></i></a></td>
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