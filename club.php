<?php include 'template/header.php' ?>

<?php
    include_once "model/conexion.php";
    $id_equipo = $_GET['id_equipo'];
    $sentencia = $bd -> query( "select * from equipos where id_equipo = $id_equipo");
    $equipos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container">
    
    <div class="p-4 fw-bold fs-3 mt-5" style="background: #29A8FF;">
        <?php
            foreach ($equipos as $dato) {
        ?>
                <img width="60px" src="imagenes/<?php echo $dato->logo_equipo; ?>" />
        <?php echo $dato->nombre_equipo;?>
    </div>
    <div class="fs-5 mt-3">
        <p>
            <b>Presidente: </b>
            <?php echo $dato->nombre_presidente; ?>
        </p>
        <p>
            <b>Sede: </b>
            <?php echo $dato->direccion_sede; ?>
        </p>
        <p>
            <b>Teléfono: </b>
            <?php echo $dato->telefono_equipo; ?>
        </p>
        <p>
            <?php echo $dato->descripcion; ?>
        </p>
    </div>
    <h4>
        Lista de Jugadores
    </h4>
    <div class="col-lg-7">
            <div class="card">
                <div class="p-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Equipo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha Nacimiento</th>
                                <th scope="col">Posición</th>
                                <th scope="col">Pierna Hábil</th>
                                <th scope="col">Ciudad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $id_equipo = $_GET['id_equipo'];
                                $sentenciaJugadores = $bd -> query( "select id_jugador, nombre_jugador, fecha_nacimiento, 
                                                                    ciudades.nombre_ciudad nombre_ciudad, puesto.nombre_puesto nombre_puesto, pierna_habil.nombre_pierna nombre_pierna
                                                                    from jugadores 
                                                                    inner join ciudades on jugadores.id_ciudad = ciudades.id_ciudad
                                                                    inner join puesto on jugadores.id_puesto = puesto.id_puesto
                                                                    inner join pierna_habil on jugadores.id_pierna_habil = pierna_habil.id_pierna_habil
                                                                    where id_equipo = $id_equipo");
                                $jugadores = $sentenciaJugadores->fetchAll(PDO::FETCH_OBJ);
                                foreach($jugadores as $datoJugador){
                            ?>

                            <tr>
                                <td><img width="40px" src="imagenes/<?php echo $dato->logo_equipo; ?>" /></td>
                                <td><?php echo $datoJugador->nombre_jugador; ?></td>
                                <td><?php echo $datoJugador->fecha_nacimiento; ?></td>
                                <td><?php echo $datoJugador->nombre_puesto; ?></td>
                                <td><?php echo $datoJugador->nombre_pierna; ?></td>
                                <td><?php echo $datoJugador->nombre_ciudad; ?></td>
                            </tr>

                            <?php
                                }
                            ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    <?php
        }
    ?>
</div>

                            

<?php include 'template/footer.php' ?>