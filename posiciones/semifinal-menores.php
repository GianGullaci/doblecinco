<?php

/*
* este while muestra todas las categorias sobre el margen izquierdo
* dependiendo en la fase que nos encontremos mostrará o no las tablas generales
*/


$query_general2 = "
	select padre.id_categoria AS id_categoria_padre,padre.nombre_categoria AS nombre_categoria_padre,
	cat.id_categoria AS id_categoria,cat.nombre_categoria AS nombre_categoria,
	cat.diferencia AS diferencia 
	from categorias as cat 
	join categorias as padre on cat.categorias_id_categoria = padre.id_categoria 
	where padre.id_categoria=1 
	group by cat.id_categoria order by diferencia desc ";
			
$result_general2 = $mysqli->query($query_general2); 
$started_cascara = false;

$padre="";

while($row_general2 = mysqli_fetch_array($result_general2)) {
	if (!$started_cascara){

		$style="style='display:none;'";
		if (!$comienzan_desplegables){
			echo '<h2>Posiciones. <div style="color: #424243;
    font-size: 18px;">Campeonato Juveniles y Menores </div></h2>';
			$style="style='display:block;'";
			$comienzan_desplegables=true;
		}
		echo '<button class="nav-link active" id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab" aria-controls="v-pills-general" aria-selected="true">General</button>
		
		      <div class="fw-bold text-center" >'.$row_general2['nombre_categoria_padre'].'</div>
			  <button class="nav-link" id="v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'" type="button" role="tab" aria-controls="v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'" aria-selected="false">'.$row_general2['nombre_categoria'].'</button>';
			
		
		$padre = $row_general2['nombre_categoria_padre'];
	}
	else{
		echo '<button class="nav-link" id="v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'" type="button" role="tab" aria-controls="v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'" aria-selected="false">'.$row_general2['nombre_categoria'].'</button>';
	}
	$started_cascara=true;
}

if ($started_cascara){

	$leyenda="";
	
	
	echo '<li>'.$leyenda.'</li>';
	echo '</ul></div>';

}

//ya mostramos las categorias, ahora armamos por cada categoria el panel que contendra todas las fechas
$query_general2 = "
		select padre.id_categoria AS id_categoria_padre,padre.nombre_categoria AS nombre_categoria_padre,
		cat.id_categoria AS id_categoria,cat.nombre_categoria AS nombre_categoria,
		cat.diferencia AS diferencia 
		from categorias as cat 
		join categorias as padre on cat.categorias_id_categoria = padre.id_categoria 
		where padre.id_categoria=1 
		group by cat.id_categoria order by diferencia desc";

$result_general2 = $mysqli->query($query_general2); 
$started_cascara = false;
// $contador=1;
$padre="";
$general=false;
$id_padre=0;

//este while va a recorrer todas las categorias para obtener sus fechas
while($row_general2 = mysqli_fetch_array($result_general2)) {

	if (!$started_cascara){
	
		echo '<div class="tab-pane fade" id="v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'" role="tabpanel" aria-labelledby="v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'-tab">';
		echo '<h3 data-tab="'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'" class="v_nav ">'.$row_general2['nombre_categoria'].'</h3>';
	}
	else {

		
		echo '<h3 data-tab="'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'" class="v_nav">'.$row_general2['nombre_categoria'].'</h3>';
	}
	
		echo '<div class="row">';
			include("posiciones/panel-posiciones.php");
		echo '</div></div>';
	
	$started_cascara=true;
}

if ($started_cascara){

	echo '</div></div></div>';

}
?>