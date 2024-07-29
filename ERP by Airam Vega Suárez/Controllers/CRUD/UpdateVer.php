<?php 
    if (session_status() === PHP_SESSION_NONE) {session_start();};$actPage = $_SESSION['actPage'];

    require_once "Database\Con1Db.php";
    require_once "Models\Models.php";
    $oData = new Datos;

    
    $id = empty($_GET['id']) ? '' : $_GET['id'];

    switch ($actPage) {
        case "almacenes":
            $sql = "SELECT * FROM Almacen WHERE ID = ?";
            $data = $oData->readUpdate($sql, $id);
            if (empty($data)) {
                echo "<div>No hay datos</div>";
            } else {
                foreach ($data as $row) {
                    echo "
                        <div>
                            <form method='post' id='formUpdate'>
                                <input type='hidden' name='id' value='$row->ID'>
                                <label for='nombre'>Nombre Almacén:</label>
                                <input type='text' name='nombre' value='$row->nombre'>
                                <label for='direccion'>Dirección Almacén:</label>
                                <input type='text' name='direccion' value='$row->direccion'>
                                <input type='submit' id='botonUpdate' value='Actualizar'>
                            </form>
                            <div id='response'></div>
                        </div>
                    ";
                }
            }
            break;
        case "clientes":
            $sql = "SELECT * FROM Clientes WHERE idCliente = ?";
            $data = $oData->readUpdate($sql, $id);
            if (empty($data)) {
                echo "<div>No hay datos</div>";
            } else {
                foreach ($data as $row) {
                    echo "
                        <div>
                            <form method='post' id='formUpdate'>
                                <input type='hidden' name='id' value='$row->idCliente'>
                                <label for='nombre'>Nombre Cliente:</label>
                                <input type='text' name='nombre' value='$row->nombreCliente'>
                                <input type='submit' id='botonUpdate' value='Actualizar'>
                            </form>
                            <div id='response'></div>
                        </div>
                    ";
                }
            }
            break;
        case "productos":
            $sql = "SELECT * FROM Productos WHERE id = ?";
            $data = $oData->readUpdate($sql, $id);
            if (empty($data)) {
                echo "<div>No hay datos</div>";
            } else {
                foreach ($data as $row) {
                    echo "
                        <div>
                            <form method='post' id='formUpdate'>
                                <input type='hidden' name='id' value='$row->id'>
                                <label for='nombre'>Nombre Producto:</label>
                                <input type='text' name='nombre' value='$row->nombre'>
                                <label for='precio'>Precio Producto:</label>
                                <input type='text' name='precio' value='$row->precioProd'>
                                <label for='cantidad'>Cantidad Producto:</label>
                                <input type='text' name='cantidad' value='$row->cantidadProd'>
                                <label for='id_almacen'>ID Almacén:</label>
                                <input type='text' name='id_almacen' value='$row->id_almacen'>
                                <input type='submit' id='botonUpdate' value='Actualizar'>
                            </form>
                            <div id='response'></div>
                        </div>
                    ";
                }
            }
            break;
        case "proveedores":
            $sql = "SELECT * FROM Proveedores WHERE idProveedor = ?";
            $data = $oData->readUpdate($sql, $id);
            if (empty($data)) {
                echo "<div>No hay datos</div>";
            } else {
                foreach ($data as $row) {
                    echo "
                        <div>
                            <form method='post' id='formUpdate'>
                                <input type='hidden' name='id' value='$row->idProveedor'>
                                <label for='nombre'>Nombre Proveedor:</label>
                                <input type='text' name='nombre' value='$row->nombreProveedor'>
                                <input type='submit' id='botonUpdate' value='Actualizar'>
                            </form>
                            <div id='response'></div>
                        </div>
                    ";
                }
            }
            break;
        default:
            echo "No se encontraron datos";
    }
    
?>