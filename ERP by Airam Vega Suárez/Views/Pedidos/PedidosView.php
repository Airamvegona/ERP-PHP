<?php session_start();$_SESSION['actPage'] = "pedidos";?>
<?php require_once "Views\Shared\HeaderView.php";?>
<div class="contenedor0">
    
    <div class="contenedor1" >
        <div class="crearBorrar">
        <img class="atras" src="Assets\images\flecha-izquierda.png" alt="Volver Atrás" onclick="volverAtras()" style="cursor: pointer;">

    </div>
        <h2>Añadir Pedido</h2>
        <?php require_once "Controllers/Pedidos/PedidosCreate1.php";?>
    </div>
</div>
<?php require_once "Views\Shared\FooterView.php";?>