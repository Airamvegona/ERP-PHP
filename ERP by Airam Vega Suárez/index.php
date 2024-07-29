<?php
include_once 'Database/Con1Db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Assets/css/style.css">
</head>
<body id="bodyLogin">
    <h1>BIENVENIDO</h1>

    <div id="seccionLogin" class="">
        <div class="">
            <?php include 'Views/Login/loginView.php'; ?>
        </div>
        <div class="d-flex justify-content-center">
            <button id="btnMostrarRegistro">Registrarse</button>
        </div>
    </div>

    <div id="seccionRegistro" style="display: none;">
        <div>
            <?php include 'Views/Registro/registroView.php'; ?>
        </div>
        <div class="d-flex justify-content-center">
            <button id="btnMostrarInicioDeSesion">Iniciar Sesión</button>
        </div>
    </div>

    <script src="Assets/js/app.js"></script>
</body>
</html>