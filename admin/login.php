<!doctype html>
<html lang="es">
  <head>
    <title>ACCESO ADMIN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    
  </head>
  <body>
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <form class="border shadow p-3 rounded" style="width: 450px;" action="login-ingreso.php" method="POST">
                <h1 class="text-center p-3">ACCESO</h1>

                <!-- inicio alerta-->
                <?php
                    if(isset($_GET['mensaje'])){
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">          
                    <strong>Error!</strong> <?=$_GET['mensaje'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                    }
                ?>
                <!-- fin alerta-->

                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario">
                </div>
                <div class="mb-3">
                    <label for="contaseña" class="form-label">Contaseña</label>
                    <input type="password" class="form-control" id="contaseña" name="contraseña">
                </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
        </div>
  </body>