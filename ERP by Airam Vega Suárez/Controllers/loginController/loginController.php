<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['actPage'] = "login";
$actPage = $_SESSION['actPage'];

require_once "../../Database/Con1Db.php";
require_once "../../Models/Models.php";
$oData = new Datos;

switch ($actPage) {
    case "login":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoge los datos del formulario
            $email = $_POST['email'];
            $password = $_POST['password'];

            try {
                // Validaciones adicionales
                if (empty($email) || empty($password)) {
                    throw new Exception("Todos los campos son obligatorios");
                }

                // Validación de email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@.+\.com$/', $email)) {
                    throw new Exception("El formato del correo electrónico no es válido. Debe tener la estructura x@x.com");
                }

                // Validación de contraseña
                if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[_\-.\/|])[A-Za-z\d_\-.\/|]{8,}$/', $password)) {
                    throw new Exception("La contraseña debe cumplir con ciertos requisitos de formato");
                }

                // Verifica las credenciales
                if ($oData->validarCredenciales($email, $password)) {
                    // Credenciales válidas
                    echo "success";
                } else {
                    // Credenciales inválidas
                    echo "El usuario o la contraseña son inválidos";
                }
            } catch (Exception $e) {
                // Manejo de errores
                echo $e->getMessage();
            }
        }
        break;
    default:
        echo "La opción no es válida";
}
