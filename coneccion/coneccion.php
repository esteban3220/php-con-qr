<?php
try {
    $bd = mysqli_connect(
        "localhost",
        "esteban",
        "junomava3842",
        "dulceria",
    );
    mysqli_set_charset($bd, "utf8");
} catch (Exception $e) {
    echo "Problema con la conexion: " . $e->getMessage();
}
