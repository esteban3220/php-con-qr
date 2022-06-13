<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Don yoshi</title>
    <link href="https://bootswatch.com/5/united/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/logoUAEMex.png" type="image/png" />

</head>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

<body>
    <?php
    include_once("model/header.php");
    include_once "coneccion/coneccion.php";
    $consulta = $bd->query("select correo,estado,genero from usuario");
    ?>


    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <!-- Empíezan las alertas -->
                <?php
                if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta') {
                ?>
                    <div class="alert alert-dismissible alert-warning">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Faltan datos:</strong> Por favor llena todos los campos antes de enviarlos.
                    </div>
                <?php
                }
                ?>

                <?php
                if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'error') {
                ?>
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>ERROR:</strong> Si ves este mensaje por favor contacta al administrador del sistema
                    </div>
                <?php
                }
                ?>

                <?php
                if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado') {
                ?>
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Registrado</strong> Se añadieron los datos exitosamente
                    </div>
                <?php
                }
                ?>
                <!-- Termino alertas -->
                <div class="card bg-light mb-3">
                    <div class="card-header ">
                        <h4>Usuarios</h4><br>
                    </div>
                    <div class="card-body">

                        <table id="Tabla" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Correo</th>
                                    <th>Locacion</th>
                                    <th>Genero</th>
                                    <th>QR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($fila = mysqli_fetch_array($consulta)) {
                                ?>
                                    <tr>
                                        <td scope="row"><?php echo $fila['correo'] ?> </td>
                                        <td><?php echo $fila['estado'] ?></td>
                                        <td><?php echo $fila['genero'] ?></td>
                                        <!-- data-bs-toggle="modal" data-bs-target="#Modal_qr" -->
                                        <td><a href="qr_gen/qr.php?correo=<?php echo $fila['correo'] ?>" class="btn btn-Light">
                                                <img src="img/codigo-qr.png">
                                            </a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-light mb-3">
                    <div class="card-header ">
                        <h4>Registro</h4><br>
                    </div>
                    <div class="card-body">
                        <form action="registro.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Correo</label>
                                <input type="email" class="form-control" name="correo" required >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Apellido</label>
                                <input type="text" class="form-control" name="apellido" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Fecha Nacimiento</label>
                                <input type="date" class="form-control" name="fechaNac" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleSelect1" class="form-label mt-4">Estado</label>
                                <select class="form-select" id="" name="estado">
                                    <option>Estado de Mexico</option>
                                    <option>CDMX</option>
                                    <option>Aguascalientes</option>
                                    <option>Culiacan</option>
                                    <option>Monterrey</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleSelect1" class="form-label mt-4">Genero</label>
                                <select class="form-select" id="" name="genero">
                                    <option>Hombre</option>
                                    <option>Mujer</option>
                                </select>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" value="registrar">Agregar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php
    if (isset($_GET['correo'])) {
    ?>
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#Modal_qr').modal('show');
            });
        </script>
        <div class="modal fade" id="Modal_qr" role="dialog" aria-hidden="false" open>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Escanea el codigo QR</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body" align="center">
                    <?php
                        echo "<div><img src='qr_gen/". $_GET["correo"] . ".png'/></div>";
                    ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->

    <?php
    }
    ?>




</body>

</html>