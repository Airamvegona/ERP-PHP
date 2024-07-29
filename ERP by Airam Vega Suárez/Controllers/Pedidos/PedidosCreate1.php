<?php 
    if (session_status() === PHP_SESSION_NONE) {session_start();};$actPage = $_SESSION['actPage'];
    require_once "Database/Con1Db.php";
    require_once "Models/Models.php";
?>
<br>
<div class="pedidos">
    <div class="w100">
        <label for="tipoOperacion">Tipo de Operación:</label>
        <select name="tipoOperacion" id="tipoOperacion">
            <option value="compra">Compra</option>
            <option value="venta">Venta</option>
        </select>
        <input type="hidden" name="tipoOperacion" id="tipoOperacionHidden" value="compra">
    </div>

    <div id="pedidoCompra" class="pedido">
        <form method="post" id="formPedidoCompra">
            <label for='proveedores'>Proveedor:</label>
            <select name='proveedoresC' id='proveedoresC'>
                <?php $datos = new Datos();$proveedores = $datos->obtenerProveedores();foreach ($proveedores as $proveedor):?>
                <option value='<?php echo $proveedor['idProveedor']; ?>'><?php echo $proveedor['nombreProveedor']; ?></option><?php endforeach; ?>
            </select>
            <label for='almacen'>Almacén:</label>
            <select name='almacenC' id='almacenC'>
                <?php $almacen = $datos->obtenerAlmacen();foreach ($almacen as $alm): ?>
                <option value='<?php echo $alm['ID']; ?>'><?php echo $alm['nombre']; ?></option><?php endforeach; ?>
            </select>
        </form>
        <select id='productoC'>
            <?php $productos = $datos->obtenerProductos();foreach ($productos as $producto): ?>
                <option value='<?php echo $producto['nombre']; ?>' data-precio='<?php echo $producto['precioProd']; ?>' data-ide='<?php echo $producto['id']; ?>'><?php echo $producto['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="number" id="cantidadC" placeholder="Cantidad">
        <button id="addProdC">Añadir producto</button>
        <div id="divProdC" class='divProd'></div>
        <br>
        <button id="finPedidoC">Finalizar Pedido</button>
    </div>

    <div id="pedidoVenta" class="hidden">
        <form method="post" id="formPedidoVenta">
            <label class="w100" for='clientes'>Cliente:</label>
            <select name='clientesV' id='clientesV'>
                <?php $clientes = $datos->obtenerClientes();foreach ($clientes as $cliente):?>
                <option value='<?php echo $cliente['idCliente']; ?>'><?php echo $cliente['nombreCliente']; ?></option><?php endforeach; ?>
            </select>
            <label class="w100" for="productoV">Producto: </label>
            <select id='productoV'>
                <?php foreach ($productos as $producto): ?>
                <option value='<?php echo $producto['nombre']; ?>' data-precio='<?php echo $producto['precioProd'];?>' data-ide='<?php echo $producto['id'];?>' data-cantidad='<?php echo $producto['cantidadProd']; ?>'><?php echo $producto['nombre']; ?></option><?php endforeach; ?>
            </select>
            <label class="w100" for="cantidadV">Cantidad: </label>
            <select id='cantidadV' name='cantidadV'>
            </select>
        </form>
        <button id="addProdV">Añadir producto</button>
        <div id="divProdV" class='divProd'></div>
        <button id="finPedidoV">Finalizar Pedido</button>
    </div>
    <div id="response"></div>
</div>

