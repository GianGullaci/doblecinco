<?php include 'template/header.php' ?>

<?php

	//seleccionamos el torneo que se setea en el admin
	include_once "model/coneccion.php";
	$query = "select *
		FROM  configuracion_home";
	$torneos=false;
	$result = $mysqli->query($query); 
	if ($row = mysqli_fetch_array($result)){
		$torneo_menores=$row['id_torneo_menores'];
		$torneo_infantiles=$row['id_torneo_infantiles'];
		$texto_cita_posiciones = $row['texto_cita_posiciones'];
		$torneos=true;
	}

?>

<section class="pt-2">
	<div class="container">
		<?php
			
			if ($torneos){
			
				//hay torneos para mostrar --> los muestro por fases
			
				//mostramos todas las fases (quizas algunas no estén jugadas, y por ello para saber el título, tendremos una variable que lo determine)
				$comienzan_desplegables=false;
				
				
				/*$query_fase = "select * 
 					FROM resultados_partidos
 					
 					where (id_torneo=".$torneo_infantiles." or id_torneo=".$torneo_menores.") 
 					AND fase=5";
 				$result_fase = $mysqli->query($query_fase); 
 				if ($row_fase = mysqli_fetch_array($result_fase)){
 				
					$fase=5;
					$fase2=0;
					$titulo="Finalisima Juveniles";
					$subtitulo1="Copa Campeonato";
					$subtitulo2="Copa Competencia";
					echo '<div class="container">';
					include("posiciones/finalisima-menores.php");
					echo '</div>';
					$comienzan_desplegables=true;
					$mostrarfase1=false;
 					
 				}*/
 				
 				$query_fase = "select * 
				 FROM resultados_partidos
				 
				 where (id_torneo=".$torneo_infantiles." or id_torneo=".$torneo_menores.") 
				 AND (fase=10 or fase=4)";
			 	$result_fase = $mysqli->query($query_fase); 
				if ($row_fase = mysqli_fetch_array($result_fase)){
				
					$fase=4;
					$fase2=10;
					$titulo="Fase 3";
					$subtitulo1="Zona A";
					$subtitulo2="Zona B";
					echo '<div class="container">';
					include("posiciones/fase3.php");
					echo '</div>';
					$comienzan_desplegables=true;
					
				}
				
				
				/*$query_fase = "select * 
 					FROM resultados_partidos
 					
 					where (id_torneo=".$torneo_infantiles." or id_torneo=".$torneo_menores.") 
 					AND fase=9";
 				$result_fase = $mysqli->query($query_fase); 
 				if ($row_fase = mysqli_fetch_array($result_fase)){
 				
					$fase=9;
					$fase2=0;
					$titulo="Final Menores";
					$subtitulo1="Copa Campeonato";
					$subtitulo2="Copa Competencia";
					echo '<div class="container">';
					include("posiciones/final-infantiles.php");
					echo '</div>';
					$comienzan_desplegables=true;
					$mostrarfase1=false;
 					
 				}*/
 				
 				/*$query_fase = "select * 
 					FROM resultados_partidos
 					
 					where (id_torneo=".$torneo_infantiles." or id_torneo=".$torneo_menores.") 
 					AND fase=3";
 				$result_fase = $mysqli->query($query_fase); 
 				if ($row_fase = mysqli_fetch_array($result_fase)){
 				
					$fase=3;
					$fase2=0;
					$titulo="Semifinal Juveniles";
					$subtitulo1="Copa Campeonato";
					$subtitulo2="Copa Competencia";
					echo '<div class="container">';
					include("posiciones/semifinal-menores.php");
					echo '</div>';
					$comienzan_desplegables=true;
					$mostrarfase1=false;
 					
 				}*/
 				
 				
 				/*$query_fase = "select * 
 					FROM resultados_partidos
 					
 					where (id_torneo=".$torneo_infantiles." or id_torneo=".$torneo_menores.") 
 					AND fase=2";
 				$result_fase = $mysqli->query($query_fase); 
 				if ($row_fase = mysqli_fetch_array($result_fase)){
 				
					$fase=2;
					$fase2=0;
					$titulo="Fase 2";
					$subtitulo1="<span style='color:#E42C1A;'>Copa Campeonato</span>";
					$subtitulo2="<span style='color:#E42C1A;'>Copa Competencia</span>";
					echo '<div class="container">';
					include("posiciones/fase2-menores.php");
					echo '</div>';
					$comienzan_desplegables=true;
					$mostrarfase1=false;
 					
 				}
				
				$query_fase = "select * 
 					FROM resultados_partidos
 					
 					where (id_torneo=".$torneo_infantiles." or id_torneo=".$torneo_menores.") 
 					AND fase=8";
 				$result_fase = $mysqli->query($query_fase); 
 				if ($row_fase = mysqli_fetch_array($result_fase)){
 				
					$fase=8;
					$fase2=0;
					$titulo="Fase 2. <span style='color:#E42C1A;'>Torneo Clausura</span>";
					$subtitulo1="Copa Campeonato";
					$subtitulo2="Copa Competencia";
					echo '<div class="container">';
					include("posiciones/clausura-infantiles.php");
					echo '</div>';
					$comienzan_desplegables=true;
					$mostrarfase1=false;
 					
 				}
 				
 				
 				$query_fase = "select * 
 					FROM resultados_partidos
 					
 					where (id_torneo=".$torneo_infantiles." or id_torneo=".$torneo_menores.") 
 					AND fase=7";
 				$result_fase = $mysqli->query($query_fase); 
 				if ($row_fase = mysqli_fetch_array($result_fase)){
 				
					$fase=7;
					$fase2=0;
					$titulo="Fase 2.";
					$subtitulo1="<span style='color:#E42C1A;'>Copa Campeonato</span>";
					$subtitulo2="<span style='color:#E42C1A;'>Copa Competencia</span>";
					echo '<div class="container">';
					include("posiciones/apertura-infantiles.php");
					echo '</div>';
					$comienzan_desplegables=true;
 					
 				}*/

				 $query_fase = "select * 
				 FROM resultados_partidos
				 
				 where (id_torneo=".$torneo_infantiles." or id_torneo=".$torneo_menores.") 
				 AND (fase=7 or fase=2)";
			 	$result_fase = $mysqli->query($query_fase); 
				if ($row_fase = mysqli_fetch_array($result_fase)){
				
					$fase=2;
					$fase2=7;
					$titulo="Fase 2";
					$subtitulo1="Zona A";
					$subtitulo2="Zona B";
					echo '<div class="container">';
					include("posiciones/fase2.php");
					echo '</div>';
					$comienzan_desplegables=true;
					
				}
 				
 				
				$fase=1;
				$fase2=6;
				$titulo="Fase 1";
				$subtitulo1="Zona A";
				$subtitulo2="Zona B";
				echo '<div class="container">';
				include("posiciones/fase1.php");
				echo '</div>';
				

			}
		?>
	</div>
</section>

<?php include 'template/footer.php' ?>