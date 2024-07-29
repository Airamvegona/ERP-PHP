<?php 
    if (session_status() === PHP_SESSION_NONE) {session_start();};$actPage = $_SESSION['actPage'];

    require_once "../../Database/Con1Db.php";
    require_once "../../Models/Models.php";
    $oData = new Datos;

    switch ($actPage) {
        case "almacenes":
            $id = empty($_POST['id']) ? '' : $_POST['id'];
            $nombre = empty($_POST['nombre']) ? '' : $_POST['nombre'];
            $direccion = empty($_POST['direccion']) ? '' : $_POST['direccion'];
    
            $sql = "UPDATE Almacen SET nombre = ?, direccion = ? WHERE ID = ?";
            $data = $oData->updateAlmacen($sql, $nombre, $direccion, $id);
            echo $data;
            break;
        case "clientes":
            $id = empty($_POST['id']) ? '' : $_POST['id'];
            $nombre = empty($_POST['nombre']) ? '' : $_POST['nombre'];
    
            $sql = "UPDATE Clientes SET nombreCliente = ? WHERE idCliente = ?";
            $data = $oData->updateCliente($sql, $nombre, $id);
            echo $data;
            break;
        case "productos":
            $id = empty($_POST['id']) ? '' : $_POST['id'];
            $nombre = empty($_POST['nombre']) ? '' : $_POST['nombre'];
            $precio = empty($_POST['precio']) ? '' : $_POST['precio'];
            $cantidad = empty($_POST['cantidad']) ? '' : $_POST['cantidad'];
            $id_almacen = empty($_POST['id_almacen']) ? '' : $_POST['id_almacen'];
    
            $sql = "UPDATE Productos SET nombre = ?, precioProd = ?, cantidadProd = ?, id_almacen = ? WHERE id = ?";
            $data = $oData->updateProducto($sql, $nombre, $precio, $cantidad, $id_almacen, $id);
            echo $data;
            break;
        case "proveedores":
            $id = empty($_POST['id']) ? '' : $_POST['id'];
            $nombre = empty($_POST['nombre']) ? '' : $_POST['nombre'];
    
            $sql = "UPDATE Proveedores SET nombreProveedor = ? WHERE idProveedor = ?";
            $data = $oData->updateProveedor($sql, $nombre, $id);
            echo $data;
            break;
        default:
            echo "No se encontraron datos";
    }
    
?>