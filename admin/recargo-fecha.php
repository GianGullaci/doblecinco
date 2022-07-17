<?php
include_once "../model/conexion.php";
$torneo=$_POST['torneo'];



$sentencia = $bd -> query("select * from fechas where id_torneo = '$torneo'");
$fechas = $sentencia->fetchAll(PDO::FETCH_OBJ);

foreach ($fechas as $opcionesFecha): 
?>
        <option value="<?php echo $opcionesFecha->id_fecha ?>" <?php if($opcionesFecha->id_fecha === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesFecha->nombre_fecha ?></font></font></option>

<?php endforeach

?>