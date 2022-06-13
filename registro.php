<?php
    if ( empty($_POST['correo']) || empty($_POST['password']) || empty($_POST['nombre']) || empty($_POST['apellido']) ||
    empty($_POST['fechaNac']) || empty($_POST['estado']) || empty($_POST['genero'])  ) {
        # code...
        header('Location: index.php?mensaje=falta');
        exit;
    }
    include_once 'coneccion/coneccion.php';
    $correo = $_POST['correo'];
    $contraseña = $_POST['password'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fechaNac = $_POST['fechaNax'];
    $estado = $_POST['estado'];
    $genero= $_POST['genero'];

    $sentencia = $bd->prepare('INSERT INTO usuario values (?,md5(?),?,?,?,?,?)');
    $resultado = $sentencia->execute([$correo,$contraseña,$nombre,$apellido,$fechaNac,$estado,$genero]);

    if ($resultado === TRUE) {
        header('Location: index.php?mensaje=registrado');
    } else {
        header('Location: index.php?mensaje=error');
    }
    
?>