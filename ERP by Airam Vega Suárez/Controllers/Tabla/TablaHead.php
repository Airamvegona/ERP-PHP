<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
;
$actPage = $_SESSION['actPage']; ?>
<?php
switch ($actPage) {
    case "almacenes":
        echo "<div>
            <th></th>
            <th>ID Almacen</th>
            <th>Nombre Almacen</th>
            <th>Direccion</th>
            </div> ";
        break;
    case "clientes":
        echo "
            <th></th>
            <th>ID Cliente</th>
            <th>Nombre Cliente</th>
        ";
        break;
    case "productos":
        echo "
            <th></th>
            <th>ID Producto</th>
            <th>Nombre Producto</th>
            <th>Precio Producto</th>
            <th>Cantidad Producto</th>
            <th>ID Almacen</th>
        ";
        break;
    case "proveedores":
        echo "
            <th></th>
            <th>ID Proveedor</th>
            <th>Nombre Proveedor</th>
        ";
        break;
    case "facturas":
        echo "
            <th>ID Factura</th>
            <th>Fecha Factura</th>
            <th>Tipo de Factura</th>
            <th></th>
        ";
        break;
    default:
        echo "La opción no es válida";
}

?>