<?php 
    if (session_status() === PHP_SESSION_NONE) {session_start();};$actPage = $_SESSION['actPage'];

    switch ($actPage) {
        case "almacenes":
            echo "
                <div class='w100'>
                    <h2>Añadir Nuevo Almacen</h2>                
                    <form id='formCreate' method='POST'> <!-- Agrega method='POST' aquí -->
                        <input type='text' name='nombre' id='nombre' placeholder='Nombre almacen'>
                        <input type='text' name='direccion' id='direccion' placeholder='Direccion almacen'>
                        <input type='submit' id='createButton' value='Añadir'>
                    </form>
                </div>
                <div class='w100' id='response'></div>
            ";
            break;
        case "clientes":
            echo "
                <div class='w100'>
                    <h2>Añadir Nuevo Cliente</h2>                
                    <form id='formCreate' method='POST'> <!-- Agrega method='POST' aquí -->
                        <input type='text' name='nombre' id='nombre' placeholder='Nombre cliente'>
                        <input type='submit' id='createButton' value='Añadir'>
                    </form>
                </div>
                <div class='w100' id='response'></div>
            ";
            break;
        case "productos":
            echo "
                <div class='w100'>
                    <h2>Añadir Nuevo Producto</h2>                
                    <form id='formCreate' method='POST'> <!-- Agrega method='POST' aquí -->
                        <input type='text' name='nombre' id='nombre' placeholder='Nombre producto'>
                        <input type='text' name='precioProd' id='precioProd' placeholder='Precio producto'>
                        <input type='text' name='cantidadProd' id='cantidadProd' placeholder='Cantidad producto'>
                        <input type='text' name='id_almacen' id='id_almacen' placeholder='ID Almacén'>
                        <input type='submit' id='createButton' value='Añadir'>
                    </form>
                </div>
                <div class='w100' id='response'></div>
            ";
            break;
        case "proveedores":
            echo "
                <div class='w100'>
                    <h2>Añadir Nuevo Proveedor</h2>                
                    <form id='formCreate' method='POST'> <!-- Agrega method='POST' aquí -->
                        <input type='text' name='nombre' id='nombre' placeholder='Nombre proveedor'>
                        <input type='submit' id='createButton' value='Añadir'>
                    </form>
                </div>
                <div class='w100' id='response'></div>
            ";
            break;
        default:
            echo "La opción no es válida";
    }
    
?>
