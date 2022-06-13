<?php
include('../phpqrcode/qrlib.php');
QRcode::png("" . $_GET["correo"] . "", "" . $_GET["correo"] . ".png", QR_ECLEVEL_L, 10, 2);
header('Location: ../index.php?correo='.$_GET["correo"].'');
?>
