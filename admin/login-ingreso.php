<?php
    session_start();
    include_once "../model/conexion.php";
    if (isset($_POST['usuario']) && isset($_POST['contraseña'])){
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        $usuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];

        if (empty($usuario)){
            header('Location: login.php?mensaje=Usuario Requerido');
        }else if (empty($contraseña)){
            header('Location: login.php?mensaje=Contraseña Requerida');
        }else{
            $sentencia = $bd -> query("SELECT * FROM admin where nombre_usuario = '$usuario' and contraseña = '$contraseña';");
            $admin = $sentencia->fetch(PDO::FETCH_OBJ);
            if ($admin->contraseña === $contraseña) {
                $_SESSION['nombre'] = $admin->nombre;
                $_SESSION['id_admin'] = $admin->id_admin;
                $_SESSION['nombre_usuario'] = $admin->nombre_usuario;
                header('Location: index.php');
            }else{
                header('Location: login.php?mensaje=Usuario o Contraseña Incorrectos');
            }
        }
    }else{
        header('Location: login.php');
    }
?>