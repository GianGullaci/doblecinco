<?php
include_once "../model/conexion.php";
$torneo=$_POST['torneo'];

$sentencia = $bd -> query("select * from fechas where torneos_id_torneo1 = '$torneo'");
$fechas = $sentencia->fetchAll(PDO::FETCH_OBJ);

foreach ($fechas as $opcionesFecha): 
?>
        <option value="<?php echo $opcionesFecha->id_fecha ?>" <?php if($opcionesFecha->id_fecha === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesFecha->nombre ?></font></font></option>

<?php endforeach

?>