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
$class="li-verde";

while($row_general2 = mysqli_fetch_array($result_general2)) {
	if (!$started_cascara){

		$style="style='display:none;'";
		if (!$comienzan_desplegables){
			echo '<h2>Posiciones. <div style="color: #424243;
    font-size: 18px;">Campeonato Juveniles y Menores </div></h2>';
			$style="style='display:block;'";
			$comienzan_desplegables=true;
		}
		else{
			$funcion = "mostrarocultar('tab-containerpos".$fase."'); return false;";
// 			echo '<h3 class="col-1-1 mostrarocultar-posiciones"  onclick="'.$funcion.'"><span>+</span>&nbsp;&nbsp;&nbsp;Infantiles. Fase 2: Apertura. </h3>';
			echo '<h3 class="col-1-1 mostrarocultar-posiciones"  onclick="'.$funcion.'"><span>+</span>&nbsp;&nbsp;&nbsp;Menores. Fase 2. </h3>';
		}
		echo '
			<div id="tab-containerpos'.$fase.'" class="tab-container col-1-1" '.$style.'>  
				<ul class="tab-nav col-1-5 ulcategorias">';
		
		echo '<div class="li-padre" >'.$row_general2['nombre_categoria_padre'].'</div>
		      <li class=" active '.$class.'" data-tab="'.$fase.'-posiciones-'.$row_general2['nombre_categoria_padre'].'">General</li>
		      <li class=" '.$class.'" data-tab="'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'">'.$row_general2['nombre_categoria'].'</li>';
			
		
		$padre = $row_general2['nombre_categoria_padre'];
	}
	else{
		echo '<li class="'.$class.'" data-tab="'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'">'.$row_general2['nombre_categoria'].'</li>';
	}
	$started_cascara=true;
}

if ($started_cascara){

// 	$leyenda="General corresponde a la suma de Octava, Novena, Décima y Predécima";
	$leyenda="General corresponde a la suma de Octava, Novena, Décima y Predécima";
	
	echo '<li class="li-nota">'.$leyenda.'</li>';
	echo '</ul>';

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

//este while va a recorrer todas las categorias para obtener sus fechas
while($row_general2 = mysqli_fetch_array($result_general2)) {

	if (!$started_cascara){
	
		echo '<div class="tab-contents col-4-5 last" style="">';
		$general=false;
		$id_padre=0;
		
		// como estoy en la fase 2, debo armar el TAB para la tabla general de Infantiles
		$padre=$row_general2['nombre_categoria_padre'];
		echo '<h3 data-tab="'.$fase.'-posiciones-'.$row_general2['nombre_categoria_padre'].'" class="v_nav">'.$row_general2['nombre_categoria_padre'].'</h3>';
		echo '<div class="tab_content" id="'.$fase.'-posiciones-'.$row_general2['nombre_categoria_padre'].'">';
			$id_padre=$row_general2['id_categoria_padre'];
			include("posiciones/panel-posiciones.php");
		echo '</div>';
	
		$id_padre=0;
		
		
		echo '<h3 data-tab="'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'" class="v_nav ">'.$row_general2['nombre_categoria'].'</h3>';
	}
	else {

		
		echo '<h3 data-tab="'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'" class="v_nav">'.$row_general2['nombre_categoria'].'</h3>';
	}
	
		echo '<div class="tab_content" id="'.$fase.'-posiciones-'.$row_general2['nombre_categoria'].'">';
			include("posiciones/panel-posiciones.php");
		echo '</div>';
	
	$started_cascara=true;
}

if ($started_cascara){

	echo '</div></div>';

}
?>