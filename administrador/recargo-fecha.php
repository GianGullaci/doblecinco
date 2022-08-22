<?php
include_once "../model/conexion.php";
$torneo=$_POST['torneo'];

$sentencia = $bd -> query("select * from fechas where torneos_id_torneo1 = '$torneo'");
$fechas = $sentencia->fetchAll(PDO::FETCH_OBJ);

foreach ($fechas as $opcionesFecha): 
        $fase= $opcionesFecha->fase;
	        if ($fase==1 or $fase==6){
			$fase= "Fase 1";
		}
		else if ($fase==2){
			$fase= "Fase 2 Juveniles";
		}
		else if ($fase==3){
			$fase= "Semifinal Juveniles (Fase 3)";
		}
		else if ($fase==4){
		        $fase= "Final Juveniles";
		}
		else if ($fase==5){
			$fase= "Finalisima Juveniles";
		}
		else if ($fase==7){
			$fase= "Torneo Apertura Menores";
		}
		else if ($fase==8){
			$fase= "Torneo Clausura Menores";
		}
		else if ($fase==9){
			$fase= "Final Menores";
		}
?>
        <option value="<?php echo $opcionesFecha->id_fecha ?>" <?php if($opcionesFecha->id_fecha === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesFecha->nombre." - ".$fase ?></font></font></option>

<?php endforeach

?>