CREATE DATABASE IF NOT EXISTS bd2;
USE bd2;

CREATE TABLE Proveedores (
    idProveedor INT AUTO_INCREMENT PRIMARY KEY,
    nombreProveedor VARCHAR(255) NOT NULL
);

CREATE TABLE Clientes (
    idCliente INT AUTO_INCREMENT PRIMARY KEY,
    nombreCliente VARCHAR(255) NOT NULL
);

CREATE TABLE Almacen (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    direccion VARCHAR(255)
);

CREATE TABLE Productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    precioProd DECIMAL(10, 2),
    cantidadProd INT,
    id_almacen INT,
    FOREIGN KEY (id_almacen) REFERENCES Almacen(ID)
);

CREATE TABLE Facturas (
    numeroFactura INT AUTO_INCREMENT PRIMARY KEY,
    fechaFactura DATE,
    tipoFactura ENUM('Compra', 'Venta')
);

CREATE TABLE facturaComHeader (
    numeroFactura INT PRIMARY KEY,
    idProveedor INT,
    totalFactura DECIMAL(10, 2),
    FOREIGN KEY (numeroFactura) REFERENCES Facturas(numeroFactura),
    FOREIGN KEY (idProveedor) REFERENCES Proveedores(idProveedor)
);

CREATE TABLE facturaVenHeader (
    numeroFactura INT PRIMARY KEY,
    idCliente INT,
    totalFactura DECIMAL(10, 2),
    FOREIGN KEY (numeroFactura) REFERENCES Facturas(numeroFactura),
    FOREIGN KEY (idCliente) REFERENCES Clientes(idCliente)
);

CREATE TABLE facturaBody (
    numeroFactura INT,
    codigoProd INT,
    cantidadProd INT,
    precioProd DECIMAL(10, 2),
    tipoOperacion ENUM('Compra', 'Venta'),
    precioTotal DECIMAL(10, 2),
    PRIMARY KEY(numeroFactura, codigoProd),
    FOREIGN KEY (numeroFactura) REFERENCES Facturas(numeroFactura),
    FOREIGN KEY (codigoProd) REFERENCES Productos(id)
);


CREATE TABLE usuarios (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
);
