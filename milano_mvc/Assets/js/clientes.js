const tableLista = document.querySelector("#tableListaProductos tbody");
document.addEventListener("DOMContentLoaded", function () {
  getListaProducto();
});

function cantidadProducto() {
  let listas = JSON.parse(localStorage.getItem("listaCarrito"));
  if (listas != null) {
    btnCarrito.textContent = listas.length;
  } else {
    btnCarrito.textContent = 0;
  }
}

let totalCarrito = 0;

function getListaProducto() {
  const url = base_url + "principal/listaProductos";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(JSON.stringify(listaCarrito));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      console.log("Contenido de res.producto:", res.producto);
      let html = "";
      if (res && res.producto && Array.isArray(res.producto)) {
        res.producto.forEach((producto) => {
          html += `<tr>
                      <td>
                      <img class="img-thumbnail" src="${
                        base_url + producto.imagen
                      }" alt="" width="100">
                      </td>
                      <td>${producto.nombre_producto}</td>
                      <td><span class="badge bg-custom-orange text-white">${
                        res.moneda + " " + producto.precio
                      }</span></td>
                      <td width="100">
                      <input type="number" class="form-control agregarCantidad" id="${
                        producto.cod_producto
                      }" value="$${producto.cantidad}" step="1">
                      <button class="btn btn-custom-orange btnReloadPage" type="button" onclick="location.reload();">
                        <i class="fas fa-sync-alt"></i>
                      </button>
                      </td>
                      <td>$${producto.subTotal}</td>
                      <td>
                      <button class="btn btn-custom-orange btn-lg btnDeletecart" type="button" prod="${
                        producto.cod_producto
                      }" ><i class="fas fa-times-circle"></i></button>
                      </td>
                  </tr>`;
        });
        totalCarrito = res.total;
      } else {
        console.error("La respuesta no tiene la estructura esperada:", res);
      }
      console.log("HTML generado:", tableLista.innerHTML);
      tableLista.innerHTML = html;
      document.querySelector("#totalProducto").textContent =
        "Total a pagar: $" + res.total;
      btnEliminarCarrito();
      cambiarCantidad();
    }
  };
}

function btnEliminarCarrito() {
  let listaEliminar = document.querySelectorAll(".btnDeletecart");
  for (let i = 0; i < listaEliminar.length; i++) {
    listaEliminar[i].addEventListener("click", function () {
      let cod_producto = listaEliminar[i].getAttribute("prod");
      eliminarListaProducto(cod_producto);
    });
  }
}

function eliminarListaProducto(cod_producto) {
  for (let i = 0; i < listaCarrito.length; i++) {
    if (listaCarrito[i]["cod_producto"] == cod_producto) {
      listaCarrito.splice(i, 1);
    }
  }
  localStorage.setItem("listaCarrito", JSON.stringify(listaCarrito));
  getListaProducto();
  cantidadProducto();
  Swal.fire("¡Aviso!", "Se eliminara el producto del carrito", "error");
}
//cambiar la cantidad
function cambiarCantidad() {
  let listaCantidad = document.querySelectorAll(".agregarCantidad");
  for (let i = 0; i < listaCantidad.length; i++) {
    listaCantidad[i].addEventListener("change", function () {
      let cod_producto = listaCantidad[i].id;
      let cantidad = listaCantidad[i].value;
      incrementarCantidad(cod_producto, cantidad);
    });
  }
}

function incrementarCantidad(cod_producto, cantidad) {
  for (let i = 0; i < listaCarrito.length; i++) {
    if (listaCarrito[i]["cod_producto"] == cod_producto) {
      listaCarrito[i].cantidad = cantidad;
    }
  }
  localStorage.setItem("listaCarrito", JSON.stringify(listaCarrito));
}

document.querySelector("#btnPagar").addEventListener("click", function () {
  // Obtener información del carrito
  console.log("Botón Pagar clicado");
  const listaCarrito = JSON.parse(localStorage.getItem("listaCarrito"));

  // Verificar que haya productos en el carrito
  if (listaCarrito && listaCarrito.length > 0) {
    const fechaPedido = new Date().toISOString().slice(0, 19).replace("T", " ");
    const datosPedido = {
      cod_pedido: generarCodigoPedido(), // Implementa esta función para generar un código único
      monto: totalCarrito,
      estado: "Pendiente", // Puedes establecer un estado inicial
      fecha_pedido: fechaPedido,
      cliente_rut: obtenerRutCliente(), // Implementa esta función para obtener el RUT del cliente
    };

    // Realizar la solicitud para registrar el pedido en la base de datos
    registrarPedido(datosPedido);
  } else {
    Swal.fire("¡Aviso!", "No hay productos en el carrito", "warning");
  }
});

// Implementa las funciones adicionales necesarias
function generarCodigoPedido() {
  const fechaActual = new Date();
  const codigoUnico =
    fechaActual.getFullYear().toString().slice(-2) + // Tomar solo los últimos 2 dígitos del año
    ("0" + (fechaActual.getMonth() + 1)).slice(-2) +
    ("0" + fechaActual.getDate()).slice(-2) +
    ("000" + Math.floor(Math.random() * 1000)).slice(-4) -
    1000000000;

  return parseInt(codigoUnico); // Convierte a número
}

function obtenerRutCliente() {
  return rutCliente;
}

// Esta función enviará la solicitud para registrar el pedido en la base de datos
function registrarPedido(datos) {
  const url = base_url + "clientes/registrar_pedido";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  http.send(
    JSON.stringify({
      pedidos: datos,
      productos: listaCarrito,
    })
  );
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const respuesta = JSON.parse(this.responseText);
      if (respuesta.msg === "OK") {
        Swal.fire("¡Error!", "Error al registrar el pedido", "error");
        // Puedes realizar acciones adicionales después de registrar el pedido
      } else {
        Swal.fire("¡Éxito!", "Pedido registrado correctamente", "success");
        localStorage.removeItem('listaCarrito');
        setTimeout(() => {
          window.location.reload();
        }, 1000);
      }
    }
    
  };
}
