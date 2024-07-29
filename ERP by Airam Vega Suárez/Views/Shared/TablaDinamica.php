<div class="w100">
    <div class="crearBorrar col-4">
    <div class="atras col-4"> <img  class="atras"  src="Assets\images\flecha-izquierda.png" alt="Volver Atrás" onclick="volverAtras()" style="cursor: pointer;"></div>
    <div class=" borrarcrear col-4"> <button class=" borrarcrear " id="botonBorrar">Borrar</button></div>
    <div class=" borrarcrear col-4">  <button class="borrarcrear" id="createBtn">Crear</button></div>
    </div>
</div>
<div id="result1"></div>
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