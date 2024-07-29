<div id="result1"></div>
<div class="crearBorrar">
        <img class="atras" src="Assets\images\flecha-izquierda.png" alt="Volver Atrás" onclick="volverAtras()" style="cursor: pointer;">
    </div>
<table id="datatable" class="tabla">
    <thead class="tableHead">
    <tr>
        <?php require_once "Controllers/Tabla/TablaHead.php"?>
    </tr>
    </thead>
    <tbody id="tableBody">
        <?php require_once "Controllers/Tabla/TablaBody.php"?>
    </tbody>
</table>