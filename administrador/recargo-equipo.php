<?php
include_once "../model/conexion.php";
$categoria=$_POST['categoria'];

$sentencia = $bd -> query("SELECT * FROM equipos 
left join clubes on clubes.id_club=equipos.clubes_id_club
where equipos.categorias_id_categoria=".$categoria." 
order by nombre_equipo");
$equipos = $sentencia->fetchAll(PDO::FETCH_OBJ);

foreach ($equipos as $opcionesEquipo): 
?>
        <option value="<?php echo $opcionesEquipo->id_equipo ?>" <?php if($opcionesEquipo->id_equipo === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $opcionesEquipo->nombre_equipo ?></font></font></option>

<?php endforeach

?>