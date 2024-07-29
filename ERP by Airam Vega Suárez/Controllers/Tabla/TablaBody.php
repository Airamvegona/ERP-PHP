<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
;
$actPage = $_SESSION['actPage']; ?>
<?php
require_once "Database\Con1Db.php";
require_once "Models\Models.php";
$oData = new Datos;

switch ($actPage) {
    case "almacenes":
        $sql = "SELECT * FROM almacen;";
        $data = $oData->read($sql);
        if (empty($data)) {
            echo
                "
                    <div>
                        No hay datos
                    </div>
                ";
        }
        foreach ($data as $row) {
            echo "<tr>";
            echo "<td><input type='checkbox' name='eliminar[]' value=" . $row->ID . "></td>";
            echo "<td>" . $row->ID . "</td>";
            echo "<td>" . $row->nombre . "</td>";
            echo "<td>" . $row->direccion . "</td>";
            echo "<td><a href='editar.php?id=$row->ID'>Editar</a></td>";
            echo "</tr>";
        }
        break;


    case "clientes":
        $sql = "SELECT * FROM Clientes";
        $data = $oData->read($sql);
        if (empty($data)) {
            echo "<div>No hay datos</div>";
        }

               
            foreach ($data as $row) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='eliminar[]' value=" . $row->idCliente . "></td>";
                echo "<td>" . $row->idCliente . "</td>";
                echo "<td>" . $row->nombreCliente . "</td>";
                echo "<td><a href='editar.php?id=$row->idCliente'>Editar</a></td>";
                echo "</tr>";
            }
           
        break;
    case "productos":
        $sql = "SELECT * FROM Productos";
        $data = $oData->read($sql);
        if (empty($data)) {
            echo "<div>No hay datos</div>";
        } 
            foreach ($data as $row) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='eliminar[]' value=" . $row->id . "></td>";
                echo "<td>" . $row->id . "</td>";
                echo "<td>" . $row->nombre . "</td>";
                echo "<td>" . $row->precioProd . "</td>";
                echo "<td>" . $row->cantidadProd . "</td>";
                echo "<td>" . $row->id_almacen . "</td>";
                echo "<td><a href='editar.php?id=$row->id'>Editar</a></td>";
                echo "</tr>";
            }
           
        
        break;
    case "proveedores":
        $sql = "SELECT * FROM Proveedores";
        $data = $oData->read($sql);
        if (empty($data)) {
            echo "<div>No hay datos</div>";
        } 
            foreach ($data as $row) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='eliminar[]' value=" . $row->idProveedor . "></td>";
                echo "<td>" . $row->idProveedor . "</td>";
                echo "<td>" . $row->nombreProveedor . "</td>";
                echo "<td><a href='editar.php?id=$row->idProveedor'>Editar</a></td>";
                echo "</tr>";
            }
            
        break;
    case "facturas":
        $sql = "SELECT * FROM facturas";
        $data = $oData->read($sql);
        if (empty($data)) {
            echo "<div>No hay datos</div>";
        } 
            foreach ($data as $row) {
                echo "<tr>";
                echo "<td>" . $row->numeroFactura . "</td>";
                echo "<td>" . $row->fechaFactura . "</td>";
                echo "<td>" . $row->tipoFactura . "</td>";
                echo "<td><a href='facturaCompleta.php?numFactura=$row->numeroFactura'>Ver</a></td>";
                echo "</tr>";
            }
            
        break;
    default:
        echo "No se encontraron datos";
}

?>