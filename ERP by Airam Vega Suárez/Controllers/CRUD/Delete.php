<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
;
$actPage = $_SESSION['actPage']; ?>
<?php
require_once "../../Database/Con1Db.php";
require_once "../../Models/Models.php";
$oData = new Datos;
$ids = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['filasEliminar'])) {
        $ids = implode(",", $_POST['filasEliminar']);
    } else {
        echo "No se han recibido datos de filas a eliminar.";
    }
} else {
    echo "No se han recibido datos POST.";
}

switch ($actPage) {
    case "almacenes":
        $sql = "DELETE FROM almacen WHERE id IN ($ids)";
        $data = $oData->delete($sql);
        break;
    case "clientes":
        $sql = "DELETE FROM Clientes WHERE idCliente IN ($ids)";
        $data = $oData->delete($sql);
        break;
    case "productos":
        $sql = "DELETE FROM Productos WHERE id IN ($ids)";
        $data = $oData->delete($sql);
        break;
    case "proveedores":
        $sql = "DELETE FROM Proveedores WHERE idProveedor IN ($ids)";
        $data = $oData->delete($sql);
        break;

    default:
        echo "La opción no es válida";
}
?>