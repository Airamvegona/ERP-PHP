<?php

    require_once "../../Database/Con1Db.php";
    require_once "../../Models/Models.php";

    try{
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cliente = $_POST["clientesV"];

            $productos = array();
    
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'producto') === 0) {
                    $index = substr($key, strlen('producto'));
                    $producto = array(
                        'producto' => $value,
                        'cantidad' => $_POST['cantidad' . $index],
                        'precio' => $_POST['precio' . $index],
                        'ide' => $_POST['ide' . $index]
                    );
                    $productos[] = $producto;
                }
            }       
    
            $datos = new Datos();
    
            //Crear Factura
            $tipoFactura = 'Venta';
            $fechaFactura = date('Y-m-d');
    
            $resultado = $datos->insertarFactura($fechaFactura, $tipoFactura);
    
            $numeroFactura = $datos->obtenerMaxNumeroFactura();

            //Crear factura venta header
            $totalFactura = 0;
            foreach ($productos as $producto) {
                $precioTotalProducto = $producto['precio'] * $producto['cantidad'];
                $totalFactura += $precioTotalProducto;
            }
    
            $resultado = $datos->insertarCabeceraFacturaVenta($numeroFactura, $cliente, $totalFactura);
    
            foreach ($productos as $producto) {
                $codigoProd = $producto['ide'];
                $cantidadProd = $producto['cantidad'];
                $precioProd = $producto['precio'];
                $tipoOperacion = 'Venta';
                $precioTotal = $precioProd * $cantidadProd;
    
                $sql = "INSERT INTO facturaBody (numeroFactura, codigoProd, cantidadProd, precioProd, tipoOperacion, precioTotal) VALUES (?, ?, ?, ?, ?, ?)";
                $resultado = $datos->createFacturaBody($sql, $numeroFactura, $codigoProd, $cantidadProd, $precioProd, $tipoOperacion, $precioTotal);
            }

            foreach ($productos as $producto) {
                $codigoProd = $producto['ide'];
                $cantidadProd = $producto['cantidad'];

                $sql = "SELECT cantidadProd FROM Productos WHERE id = ?";
                $cantidadActual = $datos->readUpdate($sql, $codigoProd)[0]->cantidadProd;
            
                $nuevaCantidad = $cantidadActual - $cantidadProd;

                $sql = "UPDATE Productos SET cantidadProd = ? WHERE id = ?";
                $resultado = $datos->updateCantidadProducto($sql, $nuevaCantidad, $codigoProd);
            }
            
        
        }
        echo "<br>";
        echo "Se ha guardado el pedido";
    }
    catch(error)
    {
        echo "Error al Realizar el pedido";
    }
?>