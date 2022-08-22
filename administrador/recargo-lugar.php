<?php
include_once "../model/conexion.php";
$local=$_POST['local'];
$visitante=$_POST['visitante'];

if(isset($local) or isset($visitante)) {
    if (isset($local) and isset($visitante)){
      $where = " WHERE equipos.id_equipo=".$local."  OR equipos.id_equipo=".$visitante;
    }
    else if (isset($visitante)){
      $where = " WHERE equipos.id_equipo=".$visitante;
    }
    else{
      $where = " WHERE equipos.id_equipo=".$local;
    }

    $sentencia = $bd -> query("SELECT distinct(id_lugar), tipo_lugar, id_lugar, nombre_club, direccion FROM lugares
    join clubes on clubes.id_club=lugares.clubes_id_club
    join equipos on equipos.clubes_id_club=clubes.id_club
    ".$where." order by direccion_sede");
    $lugares = $sentencia->fetchAll(PDO::FETCH_OBJ);

    foreach ($lugares as $opcionesLugar): 
        if ($opcionesLugar->tipo_lugar==1){
            $tipo="Sede ";
          }
          else if ($opcionesLugar->tipo_lugar==2){
            $tipo="Estadio ";
          }
          else{
            $tipo="Predio ";
          }
    ?>
        <option value="<?php echo $opcionesLugar->id_lugar ?>" <?php if($opcionesLugar->id_lugar === 1){ echo 'selected = "selected"';} ?>><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $tipo; echo $opcionesLugar->nombre_club;?>: <?php echo $opcionesLugar->direccion ?></font></font></option>

    <?php endforeach;
}
    ?>