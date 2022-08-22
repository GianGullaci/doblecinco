 
<?php
  $mysqli = new mysqli("localhost", "doble5jl_main", "marilina01", "doble5jl_main");

  /* comprobar la conexión */
  if (mysqli_connect_errno()) {
      printf("Falló la conexión: %s\n", mysqli_connect_error());
      exit();
  }
  
  if (isset($_POST['editor1'])){
    /* Preparar una sentencia INSERT */
    $txt = str_replace("font-family:exo 2,sans-serif;", "font-family:'Exo 2',sans-serif;", $_POST['editor1']);
    $consulta = "INSERT INTO notas (titulo_nota, texto_nota) VALUES ('asd','".base64_encode($txt)."')";
    $sentencia = $mysqli->prepare($consulta);
//     echo $consulta;
//     exit;

    /* Ejecutar la sentencia */
    $sentencia->execute();

    /* cerrar la sentencia */
    $sentencia->close();
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Pruebas editor</title>
	<meta content="text/html; charset=utf-8" http-equiv="content-type" />
	<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
	<script src="sample.js" type="text/javascript"></script>
	<link href="sample.css" rel="stylesheet" type="text/css" />
	
	<link href='http://fonts.googleapis.com/css?family=Dosis:400,700|Russo+One|Ultra|Changa+One|Exo+2|Oswald' rel='stylesheet' type='text/css'>
	
</head>
<body>
	<style>
	    @font-face {
	      font-family: 'exo,sans-serif';
	      /*font-style: normal;
	      font-weight: 700;*/
	      src: url(http://fonts.gstatic.com/s/exo2/v3/Pf_kZuIH5c5WKVkQUaeSWQ.ttf);
	    }
	</style>
	
	Prueba cargas de texto:
	<form action="?" method="post">
		<p>
			
			<textarea cols="80" id="editor1" name="editor1" rows="10"></textarea>
			<script type="text/javascript">
			//<![CDATA[
				
				

				CKEDITOR.replace( 'editor1',
                {
                
		    toolbar: [
		    [ 'Source', '-', 'Print', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
		    [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ],
		    [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ],
		    [ 'Link', 'Unlink' ],
		    [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar' ],
		    [ 'Styles', 'Format', 'Font', 'FontSize' ],
		    [ 'TextColor', 'BGColor' ],
		    [ 'Youtube' ]
	],
                    filebrowserBrowseUrl :'js/ckeditor/filemanager/browser/default/browser.html?Connector=http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserImageBrowseUrl : 'js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserFlashBrowseUrl :'js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/connector.php',
					filebrowserUploadUrl  :'http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
					filebrowserImageUploadUrl : 'http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
					filebrowserFlashUploadUrl : 'http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
					
				});
				
				


			//]]>
			</script>
		</p>
		<input type="submit" value="Aceptar">
	</form>
	
	<?php 
	
 	$query = "SELECT * FROM notas"; 
 
 
 	$result = $mysqli->query($query); 
 
 	while($row = mysqli_fetch_array($result)) { 
	  echo "<b>Texto cargado #".$row["id_nota"].":</b><br>";
 	  echo base64_decode($row["texto_nota"]) . "<br><hr>"; 
 	} 
	?> 
<?php
if($_GET['sec']=='rlz') 
{ 
     echo '<form action="" method="post" enctype="multipart/form-data"> 
        <input name="archivo" type="file" size="35" /> 
        <input name="enviar" type="submit" value="Upload File" /> 
        <input name="action" type="hidden" value="upload" />      
     </form>'; 
 
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
                    $status = "Archivo subido: <b>".$archivo."</b>"; 
               }else{
                    $status = "Error al subir el archivo"; 
               } 
          } else { 
               $status = "Error al subir archivo"; 
          } 
          echo $status; 
     } 
}
?>
</body>
</html>
 