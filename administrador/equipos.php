<?php include 'template/header.php' ?>

<?php
    include_once "../model/conexion.php";
    $sentencia = $bd -> query( "SELECT * FROM equipos 
    left join clubes on clubes.id_club=equipos.clubes_id_club
    left join categorias on categorias.id_categoria=equipos.categorias_id_categoria
    left join personal on personal.id_personal=equipos.personal_id_personal");
    $equipos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="container my-5">
    <div class="row justify-content-center g-4">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    Ingresar datos
                </div>
                <form  class="p-4" method="POST" action="nuevo-equipo.php" enctype="multipart/form-data">
                    <div class="mb-3">
                    <label class="form-label">Club: </label>
                        <select class="form-select" id="selectClub" name="cbClub">
                        <?php
                            $consultaClubes = $bd -> query( "select * from clubes ORDER BY clubes.nombre_club ASC;");
                            $clubes = $consultaClubes->fetchAll(PDO::FETCH_OBJ);
                            foreach ($clubes as $opcionesClubes): 
                        ?>
                            <option value="<?php echo $opcionesClubes->id_club ?>" <?php if($opcionesClubes->id_club === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesClubes->nombre_club ?></font></font></option>
                        <?php endforeach ?>
                        </select>
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="txtNombre" required>
                        <label class="form-label">Categoría Deportiva: </label>
                        <select class="form-select" id="selectCategoria" name="cbCategoria">
                        <?php
                            $consultaCat = $bd -> query( "select * from categorias where categorias_id_categoria<>0 order by id_categoria");
                            $cat = $consultaCat->fetchAll(PDO::FETCH_OBJ);
                            foreach ($cat as $opcionesCategorias):
                                ?>
                            <option value="<?php echo $opcionesCategorias->id_categoria ?>" <?php if ($opcionesCategorias->id_categoria === 3) {
                                echo 'selected = "selected"';
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesCategorias->nombre_categoria ?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>
                        <label class="form-label">DT: </label>
                        <select class="form-select" id="selectPersonal" name="cbPersonal">
                        <option value="0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">A definir</font></font></option>
                        <?php
                            $consultaPersonal = $bd -> query( "select * from personal where clubes_id_club = '.clubes_id_club.' order by id_categoria");
                            $personal = $consultaPersonal->fetchAll(PDO::FETCH_OBJ);
                            foreach ($personal as $opcionesPersonal):
                                ?>
                            <option value="<?php echo $opcionesCategorias->id_categoria ?>" <?php if ($opcionesCategorias->id_categoria === 3) {
                                echo 'selected = "selected"';
                            } ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesCategorias->nombre_categoria ?></font></font></option>
                        <?php
                            endforeach ?>
                        </select>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
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

            <!-- fin alerta-->


            <div class="card">
                <div class="card-header">
                    Lista de Equipos
                </div>
                <div class="p-4 table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Club</th>
                                <th scope="col">Nombre Equipo</th>
                                <th scope="col">Categoría Deportiva</th>
                                <th scope="col">DT</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($equipos as $dato){
                            ?>

                            <tr>
                                <td><?php echo $dato->nombre_club; ?></td>
                                <td><?php echo $dato->nombre_equipo; ?></td>
                                <td><?php echo $dato->nombre_categoria; ?></td>
                                <td><?php echo $dato->nombre; ?></td>
                                <td><a class="text-success" href="editar-equipo.php?id_equipo=<?php echo $dato->id_equipo;?>"><i class="bi bi-pencil-square"></i></a></td>
                                <td><a onclick="return confirm('Estás seguro de eliminar?');" class="text-danger" href="eliminar-equipo.php?id_equipo=<?php echo $dato->id_equipo;?>"><i class="bi bi-trash-fill"></i></a></td>
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