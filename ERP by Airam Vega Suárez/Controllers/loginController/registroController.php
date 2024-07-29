<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['actPage'] = "registro";
$actPage = $_SESSION['actPage'];

require_once "../../Database/Con1Db.php";
require_once "../../Models/Models.php";
$oData = new Datos;

switch ($actPage) {
    case "registro":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoge los datos del formulario
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Validaciones adicionales
            if (empty($nombre) || empty($email) || empty($password)) {
                echo "Todos los campos son obligatorios";
                exit;
            }

            // Validación de nombre
            if (!preg_match('/^[A-Z][a-zA-Z]{2,}$/', $nombre)) {
                echo "El nombre debe empezar por mayúscula y contener solo letras (mínimo 3 caracteres)";
                exit;
            }

            // Validación de email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@.+\.com$/', $email)) {
                echo "El formato del correo electrónico no es válido. Debe tener la estructura x@x.com";
                exit;
            }

            // Check if the email already exists
            if ($oData->existeEmail($email)) {
                echo "El correo electrónico ya está registrado. Por favor, utiliza otro.";
                exit;
            }

            // Validación de contraseña
            if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[_\-.\/|])[A-Za-z\d_\-.\/|]{8,}$/', $password)) {
                echo "La contraseña debe empezar por mayúscula, contener al menos 1 letra, 1 número, 1 caracter especial y tener mínimo 8 caracteres";
                exit;
            }

            // Lógica para validar y almacenar el nuevo usuario en la base de datos
            $registroExitoso = $oData->registrarUsuario($nombre, $email, $password);

            if ($registroExitoso) {
                // Registro exitoso
                echo "success";
            } else {
                // Fallo en el registro
                echo "error";
            }
        }
        break;
    default:
        echo "La opción no es válida";
}
?>

