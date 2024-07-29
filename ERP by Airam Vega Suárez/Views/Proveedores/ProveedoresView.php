<?php session_start();$_SESSION['actPage'] = "proveedores";?>
<?php require_once "Views\Shared\HeaderView.php";?>
<div class="contenedor0">
    <div class="contenedor1" >
        <h2>Ver Proveedores</h2>
        <?php require_once "Views\Shared\TablaDinamica.php";?>
        <?php require_once "Views\Modal\ModalView.php";?>
    </div>
</div>
<?php require_once "Views\Shared\FooterView.php";?>