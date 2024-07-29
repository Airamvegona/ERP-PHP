<?php
class Datos
{
    private $mysqli;
    private $data;
    public function __construct()
    {
        $this->mysqli = Connection::conn1();
        $this->data = array();
    }
    
    public function read($sql)
    {
        if (!$this->mysqli->query($sql)) {
            echo "La operación no se ha podido realizar.";
        } else {
            $result = $this->mysqli->query($sql);
            while ($rows = $result->fetch_object()) {
                $this->data[] = $rows;
            }
            $this->mysqli->close();
            return $this->data;
        }
    }

    public function readUpdate($sql, $par1)
    {
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $par1);
        if (!$stmt->execute()) {
            echo "La operación no se ha podido realizar.";
        } else {
            $result = $stmt->get_result(); // Obtener el resultado de la consulta preparada
            while ($rows = $result->fetch_object()) {
                $this->data[] = $rows;
            }
            $stmt->close();
            return $this->data;
        }
    }
    //Funciones updates

    public function updateAlmacen($sql, $par1, $par2, $par3)
    {
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ssi", $par1, $par2, $par3);
        if (!$stmt->execute()) {
            $result = "La operación no se ha podido realizar.";
        } else {
            $result = "Se ha actualizado el almacen";
        }
        $stmt->close();
        return $result;
    }
    public function updateCliente($sql, $par1, $par2)
    {
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("si", $par1, $par2);
        if (!$stmt->execute()) {
            $result = "La operación no se ha podido realizar.";
        } else {
            $result = "Se ha actualizado el cliente.";
        }
        $stmt->close();
        return $result;
    }
    public function updateProducto($sql, $par1, $par2, $par3, $par4, $par5)
    {
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("siiii", $par1, $par2, $par3, $par4, $par5);
        if (!$stmt->execute()) {
            $result = "La operación no se ha podido realizar.";
        } else {
            $result = "Se ha actualizado el producto.";
        }
        $stmt->close();
        return $result;
    }
    public function updateProveedor($sql, $par1, $par2)
    {
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("si", $par1, $par2);
        if (!$stmt->execute()) {
            $result = "La operación no se ha podido realizar.";
        } else {
            $result = "Se ha actualizado el proveedor.";
        }
        $stmt->close();
        return $result;
    }





    public function delete($sql)
    {
        $result = "";
        try {
            if ($this->mysqli->query($sql)) {
                $result = "success";
                echo "success";
            } else {
                throw new Exception("Error al ejecutar la consulta de eliminación.");
            }
        } catch (Exception $e) {
            $result = "error";
            echo "error";
        }
        $this->mysqli->close();
        return $result;
    }
    // funcion Creates
    public function createAlmacen($sql, $par1, $par2)
    {
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ss", $par1, $par2);
        if (!$stmt->execute()) {
            $result = "La operación no se ha podido realizar.";
        } else {
            $result = "Se ha creado el almacen";
        }
        $stmt->close();
        return $result;
    }
    public function createCliente($sql, $par1)
    {
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $par1);
        if (!$stmt->execute()) {
            $result = "La operación no se ha podido realizar.";
        } else {
            $result = "Se ha creado el cliente.";
        }
        $stmt->close();
        return $result;
    }
    public function createProducto($sql, $par1, $par2, $par3, $par4)
    {
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("siii", $par1, $par2, $par3, $par4);
        if (!$stmt->execute()) {
            $result = "La operación no se ha podido realizar.";
        } else {
            $result = "Se ha creado el producto.";
        }
        $stmt->close();
        return $result;
    }
    public function createProveedor($sql, $par1)
    {
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $par1);
        if (!$stmt->execute()) {
            $result = "La operación no se ha podido realizar.";
        } else {
            $result = "Se ha creado el proveedor.";
        }
        $stmt->close();
        return $result;
    }

    public function obtenerProveedores()
    {
        $query = "SELECT idProveedor, nombreProveedor FROM Proveedores";
        $result = $this->mysqli->query($query);
        
        while ($row = $result->fetch_assoc()) {
            $this->data['proveedores'][] = $row;
        }
        
        return $this->data['proveedores'];
    }
    
    public function obtenerClientes()
    {
        $query = "SELECT idCliente, nombreCliente FROM Clientes";
        $result = $this->mysqli->query($query);
        
        while ($row = $result->fetch_assoc()) {
            $this->data['clientes'][] = $row;
        }
        
        return $this->data['clientes'];
    }
    
    public function obtenerAlmacen()
    {
        $query = "SELECT ID, nombre FROM Almacen";
        $result = $this->mysqli->query($query);
        
        while ($row = $result->fetch_assoc()) {
            $this->data['almacen'][] = $row;
        }
        
        return $this->data['almacen'];
    }
    
    public function obtenerProductos()
    {
        $query = "SELECT * FROM Productos";
        $result = $this->mysqli->query($query);
        
        while ($row = $result->fetch_assoc()) {
            $this->data['productos'][] = $row;
        }
        
        return $this->data['productos'];
    }

    public function obtenerMaxNumeroFactura()
    {
        $sql = "SELECT MAX(numeroFactura) AS maxNumero FROM Facturas";
        $result = $this->mysqli->query($sql);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['maxNumero'];
        } else {
            echo "Error al obtener el número máximo de factura.";
            return null;
        }
    }

    public function insertarFactura($fechaFactura, $tipoFactura)
    {
        $sql = "INSERT INTO Facturas (fechaFactura, tipoFactura) VALUES (?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ss", $fechaFactura, $tipoFactura);
        if (!$stmt->execute()) {
            echo "Error al insertar la factura de compra.";
            return false;
        } else {
            return true;
        }
    }

    //Funciones Pedido Compra
    public function insertarCabeceraFacturaCompra($numeroFactura, $idProveedor, $totalFactura)
    {
        $sql = "INSERT INTO facturaComHeader (numeroFactura, idProveedor, totalFactura) VALUES (?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("iii", $numeroFactura, $idProveedor, $totalFactura);
        if (!$stmt->execute()) {
            echo "Error al insertar la cabecera de la factura de compra.";
            return false;
        } else {
            return true;
        }
    }
    public function createFacturaBody($sql, $numeroFactura, $codigoProd, $cantidadProd, $precioProd, $tipoOperacion, $precioTotal)
    {
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("iisdsd", $numeroFactura, $codigoProd, $cantidadProd, $precioProd, $tipoOperacion, $precioTotal);
        if (!$stmt->execute()) {
            $result = "La operación no se ha podido realizar.";
        } else {
            $result = "Se ha insertado en la tabla facturaBody.";
        }
        $stmt->close();
        return $result;
    }

    public function updateCantidadProducto($sql, $cantidad, $codigoProd)
    {
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ii", $cantidad, $codigoProd);
        if (!$stmt->execute()) {
            $result = "La operación no se ha podido realizar.";
        } else {
            $result = "Se ha actualizado la cantidad del producto.";
        }
        $stmt->close();
        return $result;
    }

    //Funciones Pedido venta
    public function insertarCabeceraFacturaVenta($numeroFactura, $cliente, $totalFactura)
    {
        $sql = "INSERT INTO facturaVenHeader (numeroFactura, idCliente, totalFactura) VALUES (?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("iii", $numeroFactura, $cliente, $totalFactura);
        if (!$stmt->execute()) {
            echo "Error al insertar la cabecera de la factura de compra.";
            return false;
        } else {
            return true;
        }
    }
    
    public function validarCredenciales($email, $password)
{
    $email = $this->mysqli->real_escape_string($email);

    // Obtén el hash almacenado en la base de datos
    $sql = "SELECT password FROM usuarios WHERE email = ?";
    $stmt = $this->mysqli->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashedPasswordFromDatabase = $user['password'];

        // Verifica la contraseña proporcionada con el hash almacenado
        if (password_verify($password, $hashedPasswordFromDatabase)) {
            // Contraseña válida
            return true;
        }
    }

    // Usuario o contraseña inválidos
    return false;
    }

    public function registrarUsuario($nombre, $email, $password)
    {
        // Lógica para validar y almacenar el nuevo usuario en la base de datos
        // Puedes utilizar prepared statements para mayor seguridad

        // Ejemplo de consulta SQL
        $sql = "INSERT INTO usuarios (name, email, password) VALUES (?, ?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $nombre, $email, $hashedPassword);

        if ($stmt->execute()) {
            // Registro exitoso
            return true;
        } else {
            // Fallo en el registro
            return false;
        }
    }
    
    public function existeEmail($email) {

    $sql = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
    $stmt = $this->mysqli->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();

    return $count > 0;

}
}

?>