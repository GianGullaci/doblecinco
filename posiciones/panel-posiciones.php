<?php
	$id_cat = $row_general2['id_categoria'];
	
	//la categoria padre me va a servir para saber si estoy en una subcategoria de menores o infantiles
	//con menores=1 & infantiles=2
	$padre_cat = $row_general2['id_categoria_padre'];
	
	if ($general){
		//es la tabla de posiciones genera, no distingo categoria
		$entidad="Club";
		
		$where = " where 1=1 ";
		$puntos = "sum(todos1.puntos) as total_puntos";
		$select_equipos="  todos1.nombre_equipo, ";
		$group = "group by nombre_equipo";
		$group_todos = "group by todos1.nombre_equipo";
		
		$goles = "";
	}
	//estoy visualizando la informacion de la categoria padre
	else if ($id_padre<>0){
		$entidad="Club";
		
		$where = " 
			    left join categorias as catp on todos1.categorias_id_categoria=catp.id_categoria
			    where catp.categorias_id_categoria=".$id_padre;
		$puntos = "sum(todos1.puntos) as total_puntos";
		$select_equipos="  todos1.nombre_equipo, ";
		$group = "group by nombre_equipo";
		$group_todos = "group by todos1.nombre_equipo";
		
		$goles = "";
		
	}
	else{
		$entidad="Equipo";
		
		$select_equipos = " todos1.id_equipo, todos1.nombre_equipo, ";
		$puntos = "sum(todos1.puntos) as total_puntos";
		$where = "where todos1.categorias_id_categoria=".$id_cat;
		$group = "group by id_equipo";
		$group_todos = "group by todos1.id_equipo";
	}
	
?>
	
	<?php
 		include("posiciones/tabla-posiciones.php");

	?>