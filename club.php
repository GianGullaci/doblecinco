<?php include 'template/header.php' ?>

<?php
    include_once "model/conexion.php";
    $id_club = $_GET['id_club'];
    $sentencia = $bd -> query( "select * from clubes where id_club = $id_club");
    $clubes = $sentencia->fetch(PDO::FETCH_OBJ);
?>

<div class="container">
    
    <div class="p-4 fw-bold fs-3 mt-5" style="background: #29A8FF;">
        <img width="60px" src="img/logos/<?php echo $clubes->logo_club2; ?>" />
        <?php echo $clubes->nombre_club;?>
    </div>
    <div class="fs-5 mt-3">
        <p>
            <b>Presidente: </b>
            <?php echo $clubes->nombre_presidente; ?>
        </p>
        <p>
            <b>Sede: </b>
            <?php echo $clubes->direccion_sede; ?>
        </p>
        <p>
            <b>Teléfono: </b>
            <?php echo $clubes->telefono_club; ?>
        </p>
        <p>
            <?php echo base64_decode($clubes->descripcion); ?>
        </p>
    </div>
</div>

<?php include 'template/footer.php' ?>