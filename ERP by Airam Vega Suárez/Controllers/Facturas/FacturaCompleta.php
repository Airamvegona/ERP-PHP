<?php

    require_once "Database/Con1Db.php";
    require_once "Models/Models.php";

    $numeroFactura = empty($_GET['numFactura']) ? '' : $_GET['numFactura'];

    $oDatos = new Datos;
    $sql="Select * from facturas where numeroFactura = $numeroFactura";
    $data = $oDatos->read($sql);
    $tipoFactura = $data[0]->tipoFactura;

    if($data){
        echo "<h2>Factura Nº: $numeroFactura</h2><br>";
        foreach ($data as $row) {
            echo "<table class='tabla'>";
            echo "<tr>";
            echo "<td>Numero de Factura: " . $row->numeroFactura . "</td>";
            echo "<td>Fecha de la factura: " . $row->fechaFactura . "</td>";
            echo "<td>Tipo de factura: " . $row->tipoFactura . "</td>";
            echo "</tr>";
            echo "</table>";
        }
    }else{
        echo "No se encontro la factura";
    }

    if($tipoFactura === "Compra"){
        echo "<br><h2>Resumen: </h2><br>";
        $oDatos = new Datos;
        $sql="Select * from facturaComHeader where numeroFactura = $numeroFactura";
        $data = $oDatos->read($sql);
        foreach ($data as $row) {
            echo "<table class='tabla'>";
            echo "<tr>";
            echo "<td>Proveedor: " . $row->idProveedor . "</td>";
            echo "<td>Total factura: " . $row->totalFactura . "€</td>";
            echo "</tr>";
            echo "</table>";
        }
    }elseif($tipoFactura === "Venta"){
        echo "<br><h2>Resumen: </h2><br>";
        $oDatos = new Datos;
        $sql="Select * from facturaVenHeader where numeroFactura = $numeroFactura";
        $data = $oDatos->read($sql);
        foreach ($data as $row) {
            echo "<table class='tabla'>";
            echo "<tr>";
            echo "<td>Cliente: " . $row->idCliente . "</td>";
            echo "<td>Total factura: " . $row->totalFactura . "€</td>";
            echo "</tr>";
            echo "</table>";
        }
    }else{
        echo "No se ha encontrado el resumen de la tabla";
    }
    
    $oDatos = new Datos;
    $sql="Select * from facturaBody where numeroFactura = $numeroFactura";
    $data = $oDatos->read($sql);
    if($data){
        echo "<br><h2>Productos: </h2><br>";
        foreach ($data as $row) {
            echo "<table class='tabla'>";
            echo "<tr>";
            echo "<td>Codigo Producto: " . $row->codigoProd . "</td>";
            echo "<td>Cantidad Producto: " . $row->cantidadProd . "</td>";
            echo "<td>Precio Ud: " . $row->precioProd . "€</td>";
            echo "<td>Subtotal: " . $row->precioTotal . "€</td>";
            echo "</tr>";
            echo "</table>";
        }
    }else{
        echo "No se han encotrado los productos";
    }
?>