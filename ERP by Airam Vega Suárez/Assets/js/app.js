window.addEventListener('load', async function() {

    let tipoOperacion = document.getElementById('tipoOperacion');
    if(tipoOperacion){
        tipoOperacion.addEventListener('change', async function() {
            document.getElementById('tipoOperacionHidden').value = this.value;
            let tipoOperacion = document.getElementById('tipoOperacionHidden').value;
            let pedidoCompra = document.querySelector('#pedidoCompra');
            let pedidoVenta = document.querySelector('#pedidoVenta');
            
            if(tipoOperacion==="compra"){
                pedidoCompra.setAttribute('class', 'pedido');
                pedidoVenta.setAttribute('class', 'hidden');
            }
            else if(tipoOperacion==="venta"){
                pedidoCompra.setAttribute('class', 'hidden');
                pedidoVenta.setAttribute('class', 'pedido');
            }
        });
    }

    let selectProductos =  document.querySelector("#productoV");
    if(selectProductos){
        let opcionSeleccionada = selectProductos.options[selectProductos.selectedIndex];
        let cantidadDisponible = opcionSeleccionada.dataset.cantidad;
        let selectCantidad = document.querySelector("#cantidadV");
            selectCantidad.innerHTML = '';
            for (let i = 1; i <= cantidadDisponible; i++) {
                let opcionCantidad = document.createElement('option');
                opcionCantidad.value = i;
                opcionCantidad.textContent = i;
                selectCantidad.appendChild(opcionCantidad);
            }
        selectProductos.addEventListener('change', async function() {
            let opcionSeleccionada = selectProductos.options[selectProductos.selectedIndex];
            let cantidadDisponible = opcionSeleccionada.dataset.cantidad;

            let selectCantidad = document.querySelector("#cantidadV");
            selectCantidad.innerHTML = '';
            for (let i = 1; i <= cantidadDisponible; i++) {
                let opcionCantidad = document.createElement('option');
                opcionCantidad.value = i;
                opcionCantidad.textContent = i;
                selectCantidad.appendChild(opcionCantidad);
            }
        });
    }
    

    let addProdC = document.querySelector("#addProdC");
    let productosC = [];
    if(addProdC){
        let divProd = document.querySelector("#divProdC");
        addProdC.addEventListener('click', async function(event){
            event.preventDefault();
            let selectProducto = document.querySelector("#productoC");
            let opcionSeleccionada = selectProducto.options[selectProducto.selectedIndex];
            let nombre = opcionSeleccionada.value;
            let precio = opcionSeleccionada.dataset.precio;
            let ide = opcionSeleccionada.dataset.ide;
            let cantidad = document.querySelector("#cantidadC").value;
            let nuevoProducto = {
                producto: nombre,
                cantidad: cantidad,
                precio: precio,
                ide: ide
            };
            productosC.push(nuevoProducto);
            divProd.innerHTML = '';
    
            productosC.forEach(function(item) {
                let productoHTML = document.createElement('p');
                productoHTML.textContent = `Producto: ${item.producto}, Cantidad: ${item.cantidad}`;
                divProd.appendChild(productoHTML);
            });
        });
    }

    let finPedidoC = document.querySelector("#finPedidoC");
    if(finPedidoC){
        finPedidoC.addEventListener('click', async function(event){
            event.preventDefault();
            let form1 = document.querySelector("#formPedidoCompra");
            let productosC_JSON = {};
            productosC.forEach(function(item, index) {
                productosC_JSON["producto" + index] = item.producto;
                productosC_JSON["cantidad" + index] = item.cantidad;
                productosC_JSON["precio" + index] = item.precio;
                productosC_JSON["ide" + index] = item.ide;
            });
            let controlador1 = "Controllers/Pedidos/PedidosCompra.php";
            let div1 = document.querySelector("#response");
            await ajaxPost4(new FormData(form1), productosC_JSON, controlador1, div1);
        });
    }    

    async function ajaxPost4(formData, jsonData, controlador1, div1) {
        for (let key in jsonData) {
            formData.append(key, jsonData[key]);
        }
        try {
            const response = await fetch(controlador1, {
                method: "POST",
                body: formData
            });
            const result = await response.text();
    
            if (result) {
                div1.innerHTML = result;
            } else {
                div1.innerHTML = "Error: respuesta vacía del servidor";
            }
        } catch (error) {
            console.error('Error: no se ha enviado la información');
        }
    }    
    
    let addProdV = document.querySelector("#addProdV");
    let productosV = [];
    if(addProdV){
        let divProd = document.querySelector("#divProdV");
        addProdV.addEventListener('click', async function(event){
            event.preventDefault();
            let selectProducto = document.querySelector("#productoV");
            let opcionSeleccionada = selectProducto.options[selectProducto.selectedIndex];
            let nombre = opcionSeleccionada.value;
            let precio = opcionSeleccionada.dataset.precio;
            let ide = opcionSeleccionada.dataset.ide;
            let cantidad = document.querySelector("#cantidadV").value;
            let nuevoProducto = {
                producto: nombre,
                cantidad: cantidad,
                precio: precio,
                ide: ide
            };
            productosV.push(nuevoProducto);
            divProd.innerHTML = '';
    
            productosV.forEach(function(item) {
                let productoHTML = document.createElement('p');
                productoHTML.textContent = `Producto: ${item.producto}, Cantidad: ${item.cantidad}`;
                divProd.appendChild(productoHTML);
            });
        });
    }

    let finPedidoV = document.querySelector("#finPedidoV");
    if(finPedidoV){
        finPedidoV.addEventListener('click', async function(event){
            event.preventDefault();
            let form1 = document.querySelector("#formPedidoVenta");
            let productosV_JSON = {};
            productosV.forEach(function(item, index) {
                productosV_JSON["producto" + index] = item.producto;
                productosV_JSON["cantidad" + index] = item.cantidad;
                productosV_JSON["precio" + index] = item.precio;
                productosV_JSON["ide" + index] = item.ide;
            });
            let controlador1 = "Controllers/Pedidos/PedidosVenta.php";
            let div1 = document.querySelector("#response");
            await ajaxPost4(new FormData(form1), productosV_JSON, controlador1, div1);
        });
    }

    let botonBorrar = document.querySelector("#botonBorrar");
    if (botonBorrar) {
        botonBorrar.addEventListener('click', async function() {
            let controlador1 = "Controllers/CRUD/Delete.php"
            let div1 = document.querySelector("#result1")
            let filasEliminar = [];
            let checkboxes = document.querySelectorAll("input[name='eliminar[]']:checked");
            if (checkboxes.length === 0) {
                alert("No se ha seleccionado ninguna fila");
            } else {
                checkboxes.forEach(function(checkbox) {
                    filasEliminar.push(checkbox.value);
                });
                let formData = new FormData();
                filasEliminar.forEach(function(id) {
                    formData.append('filasEliminar[]', id);
                });
                await ajaxPost1(formData, controlador1, div1);
            }
        });
    }

    let createButton = document.querySelector("#createButton");
    if (createButton) {
        let form1 = document.querySelector("#formCreate");
        let controlador1 = "Controllers/CRUD/Create.php";
        let div1 = document.querySelector("#response");
        createButton.addEventListener('click', async function(event) {
            event.preventDefault();
            await ajaxPost2(new FormData(form1), controlador1, div1);
        });
    }    

    let botonUpdate = document.querySelector("#botonUpdate");
    if(botonUpdate){
        let form1 = document.querySelector("#formUpdate");
        let controlador1 = "Controllers/CRUD/Update.php";
        let div1 = document.querySelector("#response");
        botonUpdate.addEventListener('click', async function(event){
            event.preventDefault();
            await ajaxPost3(new FormData(form1), controlador1, div1);
        });
    }// LOGIN ------------------------------------------------------
    let loginButton = document.querySelector("#loginButton");
    if (loginButton) {
        let form1 = document.querySelector("#loginForm");
        let controlador1 = "Controllers/loginController/loginController.php";
        let div1 = document.querySelector("#loginResponse");

        loginButton.addEventListener('click', async function (event) {
            event.preventDefault();
            await ajaxPostLogin(new FormData(form1), controlador1, div1);
        });
    }
    // REGISTRARSE ------------------------------------------

    let registroButton = document.querySelector("#registroButton");
    if (registroButton) {
        let formRegistro = document.querySelector("#registroForm");
        let controladorRegistro = "Controllers/loginController/registroController.php";
        let divRegistro = document.querySelector("#registroResponse");

        registroButton.addEventListener('click', async function (event) {
            event.preventDefault();
            await ajaxPostRegistro(new FormData(formRegistro), controladorRegistro, divRegistro);
        });
    }

    

    let btnMostrarRegistro = document.getElementById('btnMostrarRegistro');
    let btnMostrarInicioDeSesion = document.getElementById('btnMostrarInicioDeSesion');
    let seccionLogin = document.getElementById('seccionLogin');
    let seccionRegistro = document.getElementById('seccionRegistro');

    if (btnMostrarRegistro && btnMostrarInicioDeSesion && seccionLogin && seccionRegistro) {
        btnMostrarRegistro.addEventListener('click', function () {
            seccionLogin.style.display = 'none';
            seccionRegistro.style.display = 'block';
            btnMostrarRegistro.style.display = 'none';
            btnMostrarInicioDeSesion.style.display = 'block';
        });

        btnMostrarInicioDeSesion.addEventListener('click', function () {
            seccionRegistro.style.display = 'none';
            seccionLogin.style.display = 'block';
            btnMostrarInicioDeSesion.style.display = 'none';
            btnMostrarRegistro.style.display = 'block';
        });
    }




    // LOGOUT

    let cerrarSesion = document.getElementById('cerrarSesion');

    if (cerrarSesion) {
        cerrarSesion.addEventListener('click', function () {

            window.location.href = 'logout.php';
        });
    }

});
// ------------------------------------------------------------

async function ajaxPost1(form1, controlador1, div1) {
    try {
        const response = await fetch(controlador1, {
            method: "POST",
            body: form1
        });
        const result = await response.text();
        
        if (result === "error") {
            div1.innerHTML = "No se puede eliminar la fila ya que se referencia en otra tabla";
        } else if (result === "success") {
            reload();
        }
    } catch (error) {
        console.error("Error:", error);
        alert('Error: no se ha enviado la información');
    }
}

async function ajaxPost2(formData, controlador1, div1) {
    try {
        const response = await fetch(controlador1, {
            method: "POST",
            body: formData
        });
        const result = await response.text();

        div1.innerHTML = result;
        setTimeout(function(){reload();}, 1500);
    } catch (error) {
        console.error("Error:", error);
        alert('Error: no se ha enviado la información');
    }
}

async function ajaxPost3(formData, controlador1, div1) {
    try {
        const response = await fetch(controlador1, {
            method: "POST",
            body: formData
        });
        const result = await response.text();

        if (result) {
            div1.innerHTML = result;
        } else {
            div1.innerHTML = "Error: respuesta vacía del servidor";
        }
    } catch (error) {
        console.error("Error:", error);
        alert('Error: no se ha enviado la información');
    }
}

// LOGIN --------------------------

async function ajaxPostLogin(formData, controlador1, div1) {
    try {
        const response = await fetch(controlador1, {
            method: "POST",
            body: formData
        });
        const result = await response.text();

        if (result) {
            div1.innerHTML = result;

            if (result === "success") {
                window.location.href = 'inicio.php';
            }
        } else {
            div1.innerHTML = "Error: respuesta vacía del servidor";
        }
    } catch (error) {
        console.error('Error: no se ha enviado la información');
    }
}

// REGISTRARSE-----------------------------

async function ajaxPostRegistro(formData, controladorRegistro, divRegistro) {
    try {
        const response = await fetch(controladorRegistro, {
            method: "POST",
            body: formData
        });
        const result = await response.text();

        if (result) {
            divRegistro.innerHTML = result;

            if (result === "success") {
                window.location.href = 'index.php';
            }
        } else {
            divRegistro.innerHTML = "Error: respuesta vacía del servidor";
        }
    } catch (error) {
        console.error('Error: no se ha enviado la información');
    }
}

function reload() {
    window.location.reload(true);
}

window.addEventListener('load', async function(){
    let btnOpen = document.querySelector("#createBtn");
    let modalContainer = document.querySelector("#modalContainer");
    let btnClose = document.querySelector("#closeBtn");

    if(btnOpen && modalContainer && btnClose){
        btnOpen.addEventListener('click', function(){
            modalContainer.style.display = "block";
        });

        btnClose.addEventListener('click', function(){
            modalContainer.style.display = "none";
        });
    }
});

function volverAtras() {
    window.history.back();
}
