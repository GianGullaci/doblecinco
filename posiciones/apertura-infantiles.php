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
	where padre.id_categoria=2 and cat.id_categoria<>16 
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
		echo '<div class="d-flex">  
				<div class="nav flex-column nav-pills me-4" style="width:20%" id="v-pills-tab" role="tablist" aria-orientation="vertical">

		<button class="nav-link active" id="v-pills-general-apertura-infantiles-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general-apertura-infantiles" type="button" role="tab" aria-controls="v-pills-general-apertura-infantiles" aria-selected="true">General</button>
		
		      <div class="fw-bold text-center" >'.$row_general2['nombre_categoria_padre'].'</div>
			  <button class="nav-link" id="v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'" type="button" role="tab" aria-controls="v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'" aria-selected="false">'.$row_general2['nombre_categoria'].'</button>';
			
		
		$padre = $row_general2['nombre_categoria_padre'];
	}
	else{
		if ($padre!=$row_general2['nombre_categoria_padre']){
			$padre=$row_general2['nombre_categoria_padre'];
			echo '<div class="fw-bold text-center">'.$row_general2['nombre_categoria_padre'].'</div>';
		}
		echo '<button class="nav-link" id="v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'-tab" data-bs-toggle="pill" data-bs-target="#v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'" type="button" role="tab" aria-controls="v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'" aria-selected="false">'.$row_general2['nombre_categoria'].'</button>';
	}
	$started_cascara=true;
}

if ($started_cascara){

// 	$leyenda="General corresponde a la suma de Octava, Novena, Décima y Predécima";
	$leyenda="General corresponde a la suma de Séptima, Octava y Novena";
	
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
		where padre.id_categoria=2  and cat.id_categoria<>16
		group by cat.id_categoria order by diferencia desc ";

$result_general2 = $mysqli->query($query_general2); 
$started_cascara = false;
// $contador=1;
$padre="";
$general=true;
$id_padre=0;

echo '<div class="tab-content" id="v-pills-tabContent">';
//este while va a recorrer todas las categorias para obtener sus fechas
while($row_general2 = mysqli_fetch_array($result_general2)) {

	if (!$started_cascara){
	
		$general=false;
		$id_padre=0;
		
		// como estoy en la fase 2, debo armar el TAB para la tabla general de Infantiles
		$padre=$row_general2['nombre_categoria_padre'];
		echo '<div class="tab-pane fade show active" id="v-pills-general-apertura-infantiles" role="tabpanel" aria-labelledby="v-pills-general-apertura-infantiles-tab">';
		echo '<div class="row">';
		$id_padre=$row_general2['id_categoria_padre'];
			include("posiciones/panel-posiciones.php");
		echo '</div></div>';
	
		$id_padre=0;
		
		
		echo '<div class="tab-pane fade" id="v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'" role="tabpanel" aria-labelledby="v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'-tab">';
	}
	else {
		echo '<div class="tab-pane fade" id="v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'" role="tabpanel" aria-labelledby="v-pills-'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'-tab">';
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