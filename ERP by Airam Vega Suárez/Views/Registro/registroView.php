<form id="registroForm" class="form-container">
    <label for="registroNombre">Nombre:</label>
    <div class="d-flex" style="color: red;" id="errorNombreRegistro"></div>
    <input type="text" id="registroNombre" name="nombre" placeholder="Debe comenzar con mayúscula y contener solo letras (mínimo 3 caracteres)..." required>
    

    <label for="registroEmail">Email:</label>
    <div class="d-flex" style="color: red;" id="errorEmailRegistro"></div>
    <input type="text" id="registroEmail" name="email" placeholder="Escribe tu email x@x.com..." required>
    

    <label for="registroPassword">Password:</label>
    <div class="d-flex"  id="errorContraseñaRegistro"></div>
    <input type="password" id="registroPassword" name="password" placeholder="Debe comenzar con mayúscula, contener al menos 1 letra, 1 número y 1 carácter especial (mínimo 8 caracteres)..." required>
    

    <button type="button" id="registroButton">Registrarse</button>
    <div id="registroResponse" style="color: red;"></div>
</form>

