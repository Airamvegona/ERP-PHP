<?php session_start();$_SESSION['actPage'] = "facturas";?>
<?php require_once "Views\Shared\HeaderView.php";?>
<div class="contenedor0">
    <div class="contenedor1" >
        <h2>Ver Facturas</h2>
        <?php require_once "Views\Shared\TablaFacturas.php";?>
    </div>
</div>
<?php require_once "Views\Shared\FooterView.php";?>