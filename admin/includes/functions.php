<?php 

	function showDir( $dir , $subdir = 0 ) {
	    if ( !is_dir( $dir ) ) { return false; }

	    $scan = scandir( $dir );

	    foreach( $scan as $key => $val ) {
		if ( $val[0] == "." ) { continue; }

		if ( is_dir( $dir . "/" . $val ) ) {
		    echo "<option value='".$dir . "/" . $val."'>" . str_repeat( "--", $subdir ) . $val . "</option>\n";

		    if ( $val[0] !="." ) {
			showDir( $dir . "/" . $val , $subdir + 1 );
		    }
		}
	    }

	    return true;
	}

	function delTree($dir) { 
		$files = array_diff(scandir($dir), array('.','..')); 
		foreach ($files as $file) { 
			(is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
		} 
		return rmdir($dir); 
	} 
	
	function select_galerias($mysqli,$galeria=0){
		$query = "SELECT * FROM galerias order by nombre_galeria";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_galeria']."'";
				if ($galeria==$row['id_galeria']){
				  echo " selected ";
				}
				echo ">";
				echo str_replace('galerias/','',str_replace('../', '', $row['ruta_galeria']));
				echo "</option>";
			}
		}
	}
	
	function select_publicidades($mysqli,$publicidad=0){
		$query = "SELECT * FROM publicidades order by nombre_publicidad";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_publicidad']."'";
				if ($publicidad==$row['id_publicidad']){
				  echo " selected ";
				}
				echo ">";
				echo $row['nombre_publicidad'];
				echo "</option>";
			}
		}
	}
	
	function select_publicidades_no_archivadas($mysqli,$publicidad=0){
		$query = "SELECT * FROM publicidades where archivada=0 order by nombre_publicidad";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_publicidad']."'";
				if ($publicidad==$row['id_publicidad']){
				  echo " selected ";
				}
				echo ">";
				echo $row['nombre_publicidad'];
				echo "</option>";
			}
		}
	}
	
	function select_publicidades_archivadas($mysqli,$publicidad=0){
		$query = "SELECT * FROM publicidades where archivada=1 order by nombre_publicidad";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_publicidad']."'";
				if ($publicidad==$row['id_publicidad']){
				  echo " selected ";
				}
				echo ">";
				echo $row['nombre_publicidad'];
				echo "</option>";
			}
		}
	}
	
	function select_ciudades($mysqli,$ciudad=0){
		$query = "SELECT * FROM ciudades order by nombre";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_ciudad']."'";
				if ($ciudad==$row['id_ciudad']){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre']);
				echo "</option>";
			}
		}
	}
	
	function select_puesto($mysqli,$puesto=0){
		$query = "SELECT * FROM puesto order by nombre_puesto";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_puesto']."'";
				if ($puesto==$row['id_puesto']){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre_puesto']);
				echo "</option>";
			}
		}
	}
	
	function select_pierna_habil($mysqli,$pierna_habil=0){
		$query = "SELECT * FROM pierna_habil order by nombre_pierna";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_pierna_habil']."'";
				if ($pierna_habil==$row['id_pierna_habil']){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre_pierna']);
				echo "</option>";
			}
		}
	}
	
	function select_clubes($mysqli,$club=0){
		$query = "SELECT * FROM clubes order by nombre_club";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_club']."'";
				if ($club==$row['id_club']){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre_club']);
				echo "</option>";
			}
		}
	}
	
	function select_clubes_multi($mysqli,$clubes){
		$query = "SELECT * FROM clubes order by nombre_club";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_club']."'";
				if (in_array($row['id_club'],$clubes)){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre_club']);
				echo "</option>";
			}
		}
	}
	
	function select_torneos($mysqli,$torneo=0){
		$query = "SELECT * FROM torneos order by nombre_torneo";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_torneo']."'";
				if ($torneo==$row['id_torneo']){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre_torneo']);
				echo "</option>";
			}
		}
	}
	
	function select_torneos_multi($mysqli,$torneos){
		$query = "SELECT * FROM torneos order by nombre_torneo";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_torneo']."'";
				if (in_array($row['id_torneo'],$torneos)){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre_torneo']);
				echo "</option>";
			}
		}
	}
	
	function select_fechas($mysqli,$fecha=0){
		$query = "SELECT * FROM fechas order by nombre";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_fecha']."'";
				if ($fecha==$row['id_fecha']){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre'])." - Fase ".$row['fase'];
				echo "</option>";
			}
		}
	}
	
	function select_fechas_torneo($mysqli,$torneo,$fecha=0){
		$query = "SELECT * FROM fechas where torneos_id_torneo1=".$torneo." order by nombre";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_fecha']."'";
				if ($fecha==$row['id_fecha']){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre'])." - Fase ".$row['fase'];
				echo "</option>";
			}
		}
	}
	
	
	
	function select_categorias($mysqli,$categoria=0){
		$query = "SELECT * FROM categorias where categorias_id_categoria<>0 order by id_categoria";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_categoria']."'";
				if ($categoria==$row['id_categoria']){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre_categoria']);
				echo "</option>";
			}
		}
	}
	
	function select_categorias_de_padre($mysqli,$padre=0,$categoria=0){
		$query = "SELECT * FROM categorias where categorias_id_categoria=".$padre." order by id_categoria";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_categoria']."'";
				if ($categoria==$row['id_categoria']){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre_categoria']);
				echo "</option>";
			}
		}
	}
	
	function select_categorias_multi($mysqli,$categorias){
		$query = "SELECT * FROM categorias where categorias_id_categoria<>0 order by id_categoria";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_categoria']."'";
				if (in_array($row['id_categoria'],$categorias)){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre_categoria']);
				echo "</option>";
			}
		}
	}
	
// 	function select_lugares($mysqli,$lugar=""){
// 		$query = "SELECT * FROM clubes order by nombre_club";
// 		if (isset($mysqli) and $mysqli!=null){
// 			$result = $mysqli->query($query); 
// 			//por cada clun
// 			while($row = mysqli_fetch_array($result)) {
// 				
// 				//miramos las 3 ubicaciones
// 				if (isset($row['direccion_sede']) and $row['direccion_sede']!="" and $row['direccion_sede']!="NULL"){
// 				      echo "<option value='".$row['id_club']."_sede'";
// 				      if ($lugar==$row['id_club']."_sede"){
// 					echo " selected ";
// 				      }
// 				      echo ">";
// 				      echo "Sede ".ucfirst($row['nombre_club']).": ".$row['direccion_sede'];
// 				      echo "</option>";
// 				}
// 				
// 				if (isset($row['direccion_estadio']) and $row['direccion_estadio']!="" and $row['direccion_estadio']!="NULL"){
// 				      echo "<option value='".$row['id_club']."_estadio'";
// 				      if ($lugar==$row['id_club']."_estadio"){
// 					echo " selected ";
// 				      }
// 				      echo ">";
// 				      echo "Estadio ".ucfirst($row['nombre_club']).": ".$row['direccion_estadio'];
// 				      echo "</option>";
// 				}
// 				
// 				if (isset($row['direccion_predio']) and $row['direccion_predio']!="" and $row['direccion_predio']!="NULL"){
// 				      echo "<option value='".$row['id_club']."_predio'";
// 				      if ($lugar==$row['id_club']."_predio"){
// 					echo " selected ";
// 				      }
// 				      echo ">";
// 				      echo "Predio ".ucfirst($row['nombre_club']).": ".$row['direccion_predio'];
// 				      echo "</option>";
// 				}
// 			}
// 		}
// 	}
	
	function select_arbitros($mysqli,$arbitro=0,$activos=false){
		$where=" ";
		if ($activos){
		    $where=" WHERE activo=1 ";
		}
		$query = "SELECT * FROM arbitros ".$where." order by nombre_arbitro";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_arbitro']."'";
				if ($arbitro==$row['id_arbitro']){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre_arbitro']);
				echo "</option>";
			}
		}
	}
	
	function select_personal($mysqli,$personal=0,$club=0){
		$where=" ";
		if ($club!=0){
		  $where=" WHERE clubes_id_club=".$club." ";
		}
		$query = "SELECT * FROM personal ".$where." order by nombre";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_personal']."'";
				if ($personal==$row['id_personal']){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre']);
				echo "</option>";
			}
		}
	}
	
	function select_jugadores($mysqli,$jugador=0,$club=0){
		$where=" ";
		if ($club!=0){
		  $where=" WHERE activo=1 AND clubes_id_club=".$club." ";
		}
		$query = "SELECT * FROM jugadores ".$where." order by nombre_jugador";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_jugador']."'";
				if ($jugador==$row['id_jugador']){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre_jugador']);
				echo "</option>";
			}
		}
	}
	
	function select_autores($mysqli,$autor=0){
		
		$query = "SELECT * FROM autores order by nombre_autor";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_autor']."'";
				if ($autor==$row['id_autor']){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre_autor'])." - ".$row['titulo_autor'];
				echo "</option>";
			}
		}
	}
	
	/*
	function select_clubes($mysqli,$club=0){
		
		$query = "SELECT clubes_id_club, nombre_equipo FROM equipos group by clubes_id_club, nombre_equipo";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['clubes_id_club']."'";
				if ($club==$row['clubes_id_club']){
				  echo " selected ";
				}
				echo ">";
				echo $row['nombre_equipo'];
				echo "</option>";
			}
		}
	}
	*/
	
	function select_categorias_notas($mysqli,$categoria=0){
		$query = "SELECT hijo.id_categoria_notas as id_categoria, hijo.nombre_categoria as nombre_categoria,
		padre.nombre_categoria as nombre_padre, padre.id_categoria_notas as id_padre
		FROM categorias_notas as hijo
		left join categorias_notas as padre on hijo.categorias_notas_id_categoria_notas=padre.id_categoria_notas
		order by hijo.categorias_notas_id_categoria_notas";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_categoria']."'";
				if ($categoria==$row['id_categoria']){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre_padre'])."/".$row['nombre_categoria'];
				echo "</option>";
			}
		}
	}
	
	function select_categorias_notas_group($mysqli,$categoria=0){
		$query = "SELECT hijo.id_categoria_notas as id_categoria, hijo.nombre_categoria as nombre_categoria,
		padre.nombre_categoria as nombre_padre, padre.id_categoria_notas as id_padre
		FROM categorias_notas as hijo
		left join categorias_notas as padre on hijo.categorias_notas_id_categoria_notas=padre.id_categoria_notas
		where hijo.categorias_notas_id_categoria_notas<>0 		
		order by hijo.categorias_notas_id_categoria_notas";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			$padre = "";
			$empezo =false;
			while($row = mysqli_fetch_array($result)) {
				
				if ($padre!=$row["nombre_padre"]){
					//hubo un cambio
					if ($empezo){
						echo "</optgroup>";
					}
					else{
						$empezo =true;
					}
					echo "<optgroup label='".$row["nombre_padre"]."'>";
					$padre = $row["nombre_padre"];
				}
				
				echo "<option value='".$row['id_categoria']."'";
				if ($categoria==$row['id_categoria']){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre_padre'])."/".$row['nombre_categoria'];
				echo "</option>";
			}
			echo "</optgroup>";
		}
	}
	
	function select_categorias_notas_padre($mysqli,$categoria=0){
		$query = "SELECT * FROM categorias_notas where categorias_notas_id_categoria_notas=0 order by nombre_categoria";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_categoria_notas']."'";
				if ($categoria==$row['id_categoria_notas']){
				  echo " selected ";
				}
				echo ">";
				echo ucfirst($row['nombre_categoria']);
				echo "</option>";
			}
		}
	}
	
	
	function select_lugares($mysqli,$lugar=0,$club1=0,$club2=0){
		if ($club1!=0 and $club2!=0){
			$where = " WHERE clubes.id_club=".$club1."  OR clubes.id_club=".$club2;
		}
		else if ($club2!=0){
		  $where = " WHERE clubes.id_club=".$club2;
		}
		else{
		  $where = " WHERE clubes.id_club=".$club1;
		}
		$query = "SELECT * FROM lugares
		left join clubes on clubes.id_club=lugares.clubes_id_club
		".$where." 
		and neutral=0
		order by direccion_sede";
		$result = $mysqli->query($query); 
		$json = array();
		while ($row = mysqli_fetch_array($result)) {
			if ($row['tipo_lugar']==1){
				$tipo="Sede ";
			}
			else if ($row['tipo_lugar']==2){
				$tipo="Estadio ";
			}
			else{
				$tipo="Predio ";
			}
			
			echo "<option value='".$row['id_lugar']."'";
			if ($lugar==$row['id_lugar']){
			  echo " selected ";
			}
			echo ">";
			echo $tipo.$row['nombre_club'].": ".$row['direccion'];
			echo "</option>";
				    
		}
		
		$query = "SELECT * FROM lugares
		where neutral=1
		order by direccion";
		$result = $mysqli->query($query); 
		$json = array();
		while ($row = mysqli_fetch_array($result)) {
			
			echo "<option value='".$row['id_lugar']."'";
			if ($lugar==$row['id_lugar']){
			  echo " selected ";
			}
			echo ">";
			echo $tipo.$row['nombre_neutral'].": ".$row['direccion'];
			echo "</option>";
				    
		}
		
			
	}
	
	function select_encuestas($mysqli,$encuesta=0){
		
		$query = "SELECT * FROM encuestas order by fecha_encuesta desc";
		if (isset($mysqli) and $mysqli!=null){
			$result = $mysqli->query($query); 
			while($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['id_encuesta']."'";
				if ($encuesta==$row['id_encuesta']){
				  echo " selected ";
				}
				echo ">";
				echo substr(base64_decode($row['pregunta']),0,50);
				echo "</option>";
			}
		}
	}
	
	

?>