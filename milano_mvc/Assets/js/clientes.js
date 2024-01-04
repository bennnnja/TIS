const tableLista = document.querySelector("#tableListaProductos tbody");
const tblPedidos = document.querySelector("#tblPedidos");

const estadoEnviado = document.querySelector('#estadoEnviado');
const estadoProceso = document.querySelector('#estadoProceso');
const estadoCompletado = document.querySelector('#estadoCompletado');

document.addEventListener("DOMContentLoaded", function () {
  if (tableLista) {
    getListaProducto();
  }
  $.ajax({
    url: base_url + 'clientes/listarPedidos',
    method: 'GET', // o 'POST' dependiendo de tu implementación
    dataType: 'json',
    success: function (data) {
      $('#tblPedidos').DataTable({
        data: data,
        columns: [
          { data: 'cod_pedido' },
          { data: 'monto' },
          { data: 'fecha_pedido' },
          { data: 'estado' },
          {
            data: 'cod_pedido',
            render: function(data, type, row) {
                return '<button class="btn btn-primary" type="button" onclick="verPedido(' + data + ')"><i class="fas fa-eye"></i></button>';
            }
        }
        ],
        language, dom, buttons
      });
    },
    error: function (error) {
      console.error('Error al obtener los datos:', error);
    }
  });
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
          if( producto.cantidad <= producto.stock && producto.cantidad >= 0 ) {
          html += `<tr>
                      <td>
                      <img class="img-thumbnail" src="${base_url + producto.imagen
            }" alt="" width="100">
                      </td>
                      <td>${producto.nombre_producto}</td>
                      <td><span class="badge bg-custom-orange text-white">${res.moneda + " " + producto.precio
            }</span></td>
                      <td width="100">
                      <input type="number" class="form-control agregarCantidad" id="${
                        producto.cod_producto
                      }" value="${producto.cantidad}" step="1">
                      <button class="btn btn-custom-orange btnReloadPage" type="button" onclick="location.reload();">
                        <i class="fas fa-sync-alt"></i>
                      </button>
                      </td>
                      <td>$${producto.subTotal}</td>
                      <td>
                      <button class="btn btn-custom-orange btn-lg btnDeletecart" type="button" prod="${producto.cod_producto
            }" ><i class="fas fa-times-circle"></i></button>
                      </td>
                  </tr>`;

                } else {
                  for (let i = 0; i < listaCarrito.length; i++) {
                    if (listaCarrito[i]["cod_producto"] == producto.cod_producto) {
                      listaCarrito.splice(i, 1);
                    }
                  }
                  localStorage.setItem("listaCarrito", JSON.stringify(listaCarrito));
                  getListaCarrito();
                  cantidadCarrito();
                  Swal.fire("Lo lamentamos!", "Has seleccionado una cantidad negativa o se supera el stock del producto " + producto.nombre_producto , "error");
                  setTimeout(() => {
                    window.location.reload();
                  }, 1500);}
                  
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
function cambiarCantidad(stockprod) {
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
  Swal.fire({
    title: '🤤 Estamos casi listos! 😈',
    text: "Debes realizar la transferencia del monto a estos datos, luego tu pedido quedara en un estado pendiente, nosotros la verificaremos y dejaremos el pedido como aceptado si la transferencia es correcta. Luego para retirar debes venir a la heladeria y te haremos entrega de tu pedido 🥵🍦 ",
    imageUrl: base_url + "Assets/imgs/Datos-transferencia.png",
    imageWidth: 800,
    imageHeight: 260,
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Listo, Pagado!'
  }).then((result) => {
    if (result.isConfirmed) {
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
  }
  )
}

function verPedido(cod_pedido) {
  const mPedido = new bootstrap.Modal(document.getElementById('modalPedido'));
  const url = base_url + 'clientes/verPedido/' + cod_pedido;
  const http = new XMLHttpRequest();
  http.open('GET', url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      console.log(this.responseText);
      let html = "";
      if (res && res.producto && Array.isArray(res.producto)) {
        res.producto.forEach(row => {
          let subTotal = row.precio * row.cantidad;
          html += `<tr>
                   <td>${row.producto}</td>
                   <td><span class="badge bg-custom-orange text-white">${"$" + row.precio}</span></td>
                   <td><span class="badge bg-custom-orange text-white">${row.cantidad}</span></td>
                   <td>${subTotal}</td>
               </tr>`;
        });
        document.querySelector('#tablePedidos tbody').innerHTML = html;
        mPedido.show();
      } else {
        console.error("La respuesta no tiene la estructura esperada:", res);
      }
    }
  };
}

// Lógica para abrir el modal
document.getElementById('btnModificarPerfil').addEventListener('click', function () {
  abrirModalModificarPerfil();
});

// Lógica para enviar la solicitud AJAX
document.getElementById('formModificarPerfil').addEventListener('submit', function (event) {
  event.preventDefault();
  enviarSolicitudModificarPerfil();
});

const modalModificarPerfil = new bootstrap.Modal(document.getElementById("modalModificarPerfil"));
function abrirModalModificarPerfil() {
  // Lógica para abrir el modal (usando Bootstrap como ejemplo)
  modalModificarPerfil.show();
}


const icono = 'success';
function enviarSolicitudModificarPerfil() {
  const formElement = document.getElementById('formModificarPerfil');
  let formData = new FormData(formElement);
  let data = {};
  formData.forEach((value, key) => data[key] = value);

  fetch(base_url + 'clientes/administrar_perfil/', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
  })
  .then(response => response.json())
  .then(data => {
      console.log(data);
      Swal.fire("Aviso", data.msg, data.icono);
      if (data.icono == "success") {
          setTimeout(() => {
              window.location.reload();
          }, 2000);
      }
  })
  .catch(error => console.error('Error:', error));
}


