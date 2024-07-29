<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
;
$actPage = $_SESSION['actPage'];

require_once "../../Database/Con1Db.php";
require_once "../../Models/Models.php";
$oData = new Datos;

switch ($actPage) {
    case "almacenes":
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $sql = "INSERT INTO Almacen (nombre, direccion) VALUES (?, ?)";
        echo $oData->createAlmacen($sql, $nombre, $direccion);
        break;
    case "clientes":
        $nombre = $_POST['nombre'];
        $sql = "INSERT INTO Clientes (nombreCliente) VALUES (?)";
        echo $oData->createCliente($sql, $nombre);
        break;
    case "productos":
        $nombre = $_POST['nombre'];
        $precio = $_POST['precioProd'];
        $cantidad = $_POST['cantidadProd'];
        $id_almacen = $_POST['id_almacen'];
        $sql = "INSERT INTO Productos (nombre, precioProd, cantidadProd, id_almacen) VALUES (?, ?, ?, ?)";
        echo $oData->createProducto($sql, $nombre, $precio, $cantidad, $id_almacen);
        break;
    case "proveedores":
        $nombre = $_POST['nombre'];
        $sql = "INSERT INTO Proveedores (nombreProveedor) VALUES (?)";
        echo $oData->createProveedor($sql, $nombre);
        break;
    default:
        echo "La opción no es válida";
}
?>