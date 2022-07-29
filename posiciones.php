<body>

<script>
	function nextElementSibling(el) {
	    if (el.nextElementSibling) return el.nextElementSibling;
	    do { el = el.nextSibling } while (el && el.nodeType !== 1);
	    return el;
	}
	
	function mostrarocultar(id){
		var estado = document.getElementById(id).style.display;
		var h3s = document.getElementsByClassName("mostrarocultar-posiciones");
		for (i = 0; i < h3s.length; i++) {
		    //alert(nextElementSibling(h3s[i]).id);
		    document.getElementById(nextElementSibling(h3s[i]).id).style.display="none";
		}

		if (estado == 'none'){
			document.getElementById(id).style.display="block";
		} 
		else {
			document.getElementById(id).style.display="none";
		}
	}
</script>

<style>
@media only screen and (max-width: 767px) {
  .tab-nav {
    display:block;
  }
  .fixture-inner .widget .tab-contents {
    width: 75%;
    padding-left: 1%;
  }
  ul.tab-nav.ulcategorias {
    width: 20%;
  }
  h3.v_nav {
    display: none;
  }
  ul.tab-nav.ulcategorias {
    float: right;
  }
  
  .fixture-inner .widget .tab-contents .tab_content .tab-contents{
    width: 100%;
   }

}
</style>

<?php

	//seleccionamos el torneo que se setea en el admin
    include_once "model/conexion.php";
	$sentencia = $bd -> query("select * FROM  configuracion_home");   
	$result = $sentencia->fetch(PDO::FETCH_OBJ);
	$torneo_menores= $result->id_torneo_menores;
	$torneo_infantiles=$result->id_torneo_infantiles;
	$texto_cita_posiciones = $result->texto_cita_posiciones;
	$torneos=true;
?>

<div class="col-1-1 nota_home_modelo4 last fixture-inner posiciones-inner clearfix ad-pad outter-wrapper body-wrapper wrapper">
	<div class="widget">
		<?php
			
			if ($torneos){
			
				$mostrarfase1=true;
			
				//hay torneos para mostrar --> los muestro por fases
			
				//mostramos todas las fases (quizas algunas no estén jugadas, y por ello para saber el título, tendremos una variable que lo determine)
				$comienzan_desplegables=false;
				
				$sentencia_fase = $bd -> query("select * 
				FROM resultados_partidos
				where (id_torneo=$torneo_infantiles or id_torneo=$torneo_menores) 
				AND fase=5");   
				$result_fase = $sentencia_fase->fetchall(PDO::FETCH_OBJ);

				if (!empty($result_fase)) {
					$fase=5;
					$fase2=0;
					$titulo="Finalisima Juveniles";
					$subtitulo1="Copa Campeonato";
					$subtitulo2="Copa Competencia";
					include("posiciones/finalisima-menores.php");
					$comienzan_desplegables=true;
					$mostrarfase1=false;
				}
 				
					$sentencia_fase = $bd -> query("select * 
					FROM resultados_partidos
					where (id_torneo=$torneo_infantiles or id_torneo=$torneo_menores) 
					AND fase=4");   
					$result_fase = $sentencia_fase->fetchall(PDO::FETCH_OBJ);
 				if (!empty($result_fase)){
					
					$fase=4;
					$fase2=0;
					$titulo="Final Juveniles";
					$subtitulo1="Copa Campeonato";
					$subtitulo2="Copa Competencia";
					include("posiciones/final-menores.php");
					$comienzan_desplegables=true;
 					$mostrarfase1=false;
 				}
				
				
				 $sentencia_fase = $bd -> query("select * 
				 FROM resultados_partidos
				 where (id_torneo=$torneo_infantiles or id_torneo=$torneo_menores) 
				 AND fase=9");   
				 $result_fase = $sentencia_fase->fetch(PDO::FETCH_OBJ);
 				if (!empty($result_fase)){
 				
					$fase=9;
					$fase2=0;
					$titulo="Final Menores";
					$subtitulo1="Copa Campeonato";
					$subtitulo2="Copa Competencia";
					include("posiciones/final-infantiles.php");
					$comienzan_desplegables=true;
					$mostrarfase1=false;
 				}
 				
 				$sentencia_fase = $bd -> query("select * 
				FROM resultados_partidos
				where (id_torneo=$torneo_infantiles or id_torneo=$torneo_menores) 
				AND fase=3");   
				$result_fase = $sentencia_fase->fetch(PDO::FETCH_OBJ);
 				if (!empty($result_fase)){
 				
					$fase=3;
					$fase2=0;
					$titulo="Semifinal Juveniles";
					$subtitulo1="Copa Campeonato";
					$subtitulo2="Copa Competencia";
					include("posiciones/semifinal-menores.php");
					$comienzan_desplegables=true;
					$mostrarfase1=false;
 				}
 				
 				
 				$sentencia_fase = $bd -> query("select * 
				FROM resultados_partidos
				where (id_torneo=$torneo_infantiles or id_torneo=$torneo_menores) 
				AND fase=2");   
				$result_fase = $sentencia_fase->fetch(PDO::FETCH_OBJ);
 				if (!empty($result_fase)){
 				
					$fase=2;
					$fase2=0;
					$titulo="Fase 2";
					$subtitulo1="<span style='color:#E42C1A;'>Copa Campeonato</span>";
					$subtitulo2="<span style='color:#E42C1A;'>Copa Competencia</span>";
					include("posiciones/fase2-menores.php");
					$comienzan_desplegables=true;
					$mostrarfase1=false;
 				}
				
				 $sentencia_fase = $bd -> query("select * 
				 FROM resultados_partidos
				 where (id_torneo=$torneo_infantiles or id_torneo=$torneo_menores) 
				 AND fase=8");   
				 $result_fase = $sentencia_fase->fetch(PDO::FETCH_OBJ);
 				if (!empty($result_fase)){
 				
					$fase=8;
					$fase2=0;
					$titulo="Fase 2. <span style='color:#E42C1A;'>Torneo Clausura</span>";
					$subtitulo1="Copa Campeonato";
					$subtitulo2="Copa Competencia";
					include("posiciones/clausura-infantiles.php");
					$comienzan_desplegables=true;
					$mostrarfase1=false;
 				}
 				
 				
 				$sentencia_fase = $bd -> query("select * 
				FROM resultados_partidos
				where (id_torneo=$torneo_infantiles or id_torneo=$torneo_menores) 
				AND fase=7");   
				$result_fase = $sentencia_fase->fetch(PDO::FETCH_OBJ);
 				if (!empty($result_fase)){
 				
					$fase=7;
					$fase2=0;
					$titulo="Fase 2. <span style='color:#E42C1A;'>Torneo Apertura</span>";
					$subtitulo1="Copa Campeonato";
					$subtitulo2="Copa Competencia";
					include("posiciones/apertura-infantiles.php");
					$comienzan_desplegables=true;
 				}
 				
 				
				if ($mostrarfase1){
					$fase=1;
					$fase2=6;
					$titulo="Fase 1";
					$subtitulo1="Zona A";
					$subtitulo2="Zona B";
					include("posiciones/fase1.php");
				}
				
				
				
				echo '
					
						<div>
							<a class="citas" href="posiciones/cita_posicionespu.php">'.$texto_cita_posiciones.'</a>
						</div>
					
					';

			}
		?>
	</div>
</div>
<div class="clearfix"></div>
	
	<script src="js/jquery.details.js"></script>
		
	<script>
		$(document).ready(function() {
			$(".link-jugador").fancybox({
						'width' : '40%',
						'height' : '75%',
						'autoScale' : false,
						'transitionIn' : 'none',
						'transitionOut' : 'none',
						'type' : 'iframe'
			}); 
					 
			$(".link-ficha").fancybox({
					'width' : '40%',
					'height' : '75%',
					'autoScale' : false,
					'transitionIn' : 'none',
					'transitionOut' : 'none',
					'type' : 'iframe'
			}); 
			
			$(".link-fases").fancybox({
					'width' : '40%',
					'height' : '75%',
					'autoScale' : false,
					'transitionIn' : 'none',
					'transitionOut' : 'none',
					'type' : 'iframe'
			}); 
			
			$(".link-ficha-mobil").fancybox({
					'width' : '95%',
					'height' : '75%',
					'autoScale' : false,
					'transitionIn' : 'none',
					'transitionOut' : 'none',
					'type' : 'iframe'
			}); 
			
			$(".link-fases-mobil").fancybox({
					'width' : '95%',
					'height' : '75%',
					'autoScale' : false,
					'transitionIn' : 'none',
					'transitionOut' : 'none',
					'type' : 'iframe'
			}); 
			
			$(".citas_pc").fancybox({
					  'width' : '50%',
					'height' : '75%',
					'autoScale' : false,
					'transitionIn' : 'none',
					'transitionOut' : 'none',
					'type' : 'iframe'
			}); 
			$(".citas_mobil").fancybox({
					  'width' : '90%',
					'height' : '75%',
					'autoScale' : false,
					'transitionIn' : 'none',
					'transitionOut' : 'none',
					'type' : 'iframe'
			}); 
			
		}); 
	</script>
    
    
    </body>
</html>
