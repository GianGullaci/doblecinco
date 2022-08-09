<?php include 'template/header.php' ?>

<script type="text/javascript" src="../editor/js/ckeditor/ckeditor.js"></script>
<script src="../editor/sample.js" type="text/javascript"></script>
<link href="../editor/sample.css" rel="stylesheet" type="text/css" />

<?php
    if(!isset($_GET['id_club'])){
        header('Location: index.php?mensaje=error');
        exit();
    }

    include_once '../model/conexion.php';
    $id_club = $_GET['id_club'];

    $sentencia = $bd->prepare("select * from clubes where id_club = ?;");
    $sentencia->execute([$id_club]);
    $club = $sentencia->fetch(PDO::FETCH_OBJ);
    $fechaInaugura = $club->fecha_inauguracion;
	$time = strtotime($fechaInaugura);
	$fechaInaugura = date("Y-m-d", $time);
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
        <div class="card">
                <div class="card-header">
                    Editar datos
                </div>
                <form  class="p-4" method="POST" action="editar-club-proceso.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="txtNombre" value="<?php echo $club->nombre_club; ?>" autofocus required>
                        <label class="form-label">Fecha Inauguración: </label>
                        <input type="date" class="form-control" name="txtFechaInaugura" value="<?php echo $fechaInaugura?>">
                        <label class="form-label">Dirección Sede: </label>
                        <input type="text" class="form-control" name="txtSede" value="<?php echo $club->direccion_sede; ?>" autofocus required>
                        <label class="form-label">Dirección Estadio: </label>
                        <input type="text" class="form-control" name="txtEstadio" value="<?php echo $club->direccion_estadio; ?>" autofocus required>
                        <label class="form-label">Dirección Predio Auxiliar: </label>
                        <input type="text" class="form-control" name="txtPredio" value="<?php echo $club->direccion_predio; ?>" autofocus required>
                        <label class="form-label">Teléfono: </label>
                        <input type="text" class="form-control" name="txtTel" value="<?php echo $club->telefono_club; ?>" autofocus required>
                        <label class="form-label">Logo: </label>
                        <input class="form-control" type="file" accept="image/*" name="txtLogo">
                        <label class="form-label">Nombre Presidente: </label>
                        <input type="text" class="form-control" name="txtPresidente" value="<?php echo $club->nombre_presidente; ?>" autofocus required>
                        <div class="">
							  <label class="form-label">Descripción:</label>
							  <div class="">
								<textarea cols="80" id="descripcion" name="descripcion" rows="10"><?=base64_decode($club->descripcion)?></textarea>
								<script type="text/javascript">
								//<![CDATA[

									CKEDITOR.replace( 'descripcion',
							{
								
							
							    toolbar: [
							    [ 'Source', '-', 'Print', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
							    [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ],
							    [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ],
							    [ 'Link', 'Unlink' ],
							    [ 'Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar' ],
							    [ 'Styles', 'Format', 'Font', 'FontSize' ],
							    [ 'TextColor', 'BGColor' ],
								['Youtube'],['Mp3Player']
						],
							    filebrowserBrowseUrl :'../editor/js/ckeditor/filemanager/browser/default/browser.html?Connector=http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/connector.php',
							    filebrowserImageBrowseUrl : '../editor/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/connector.php',
							    filebrowserFlashBrowseUrl :'../editor/js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/connector.php',
										filebrowserUploadUrl  :'http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
										filebrowserImageUploadUrl : 'http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
										filebrowserFlashUploadUrl : 'http://doblecinco.com.ar/editor/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
										
									});

								//]]>
								</script>
							  </div>
							</div>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="id_club" value="<?php echo $club->id_club; ?>">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php' ?>