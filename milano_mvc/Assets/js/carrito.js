const btnAddcarrito = document.querySelectorAll(".btnAddcarrito");
const btnCarrito = document.querySelector("#btnCantidadCarrito");
const verCarrito = document.querySelector("#verCarrito");
const tableListaCarrito = document.querySelector("#tableListaCarrito tbody");

let listaCarrito;
document.addEventListener("DOMContentLoaded", function () {
  if (localStorage.getItem("listaCarrito") != null) {
    listaCarrito = JSON.parse(localStorage.getItem("listaCarrito"));
  }
  for (let i = 0; i < btnAddcarrito.length; i++) {
    btnAddcarrito[i].addEventListener("click", function () {
      let cod_producto = btnAddcarrito[i].getAttribute("prod");
      agregarCarrito(cod_producto, 1);
    });
  }
  cantidadCarrito();


  //ver carrito
  const myModal = new bootstrap.Modal(document.getElementById('myModal'))
  verCarrito.addEventListener("click", function () {
    getListaCarrito();
    $("#modalCarrito").modal("show");
  });
});

//agregar productos al carrito
function agregarCarrito(cod_producto, cantidad) {
  if (localStorage.getItem("listaCarrito") == null) {
    listaCarrito = [];
  } else {
    let listaExiste = JSON.parse(localStorage.getItem("listaCarrito"));
    for (let i = 0; i < listaExiste.length; i++) {
      if (listaExiste[i]["cod_producto"] == cod_producto) {
        Swal.fire("¡Aviso!","El producto ya esta en el carrito :(","warning");
        return;
      }
    }
    listaCarrito.concat(localStorage.getItem("listaCarrito"));
  }
  listaCarrito.push({
    cod_producto: cod_producto,
    cantidad: cantidad,
  });
  localStorage.setItem("listaCarrito", JSON.stringify(listaCarrito));
  Swal.fire("¡Buena!", "Se agrego este producto a tu carrito", "success");
  cantidadCarrito();
}

function cantidadCarrito() {
  let listas = JSON.parse(localStorage.getItem("listaCarrito"));
  if (listas != null) {
    btnCarrito.textContent = listas.length;
  } else {
    btnCarrito.textContent = 0;
  }
}

//ver carrito
function getListaCarrito() {
  const url = base_url + "principal/listaProductos";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(JSON.stringify(listaCarrito));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let html = "";
      res.productos.forEach((producto) => {
        html += `<tr>
                    <td>
                    <img class="img-thumbnail" src="${
                      base_url + producto.imagen
                    }" alt="" width="100">
                    </td>
                    <td>${producto.nombre}</td>
                    <td><span class="badge bg-warning">${
                      res.moneda + " " + producto.precio
                    }</span></td>
                    <td width="100">
                    <input type="number" class="form-control agregarCantidad" id="${
                      producto.id
                    }" value="${producto.cantidad}">
                    </td>
                    <td>${producto.subTotal}</td>
                    <td>
                    <button class="btn btn-danger btnDeletecart" type="button" prod="${
                      producto.id
                    }"><i class="fas fa-times-circle"></i></button>
                    </td>
                </tr>`;
      });
      tableListaCarrito.innerHTML = html;
      document.querySelector("#totalGeneral").textContent = res.total;
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
      eliminarListaCarrito(cod_producto);
    });
  }
}

function eliminarListaCarrito(cod_producto) {
  for (let i = 0; i < listaCarrito.length; i++) {
    if (listaCarrito[i]["cod_producto"] == cod_producto) {
      listaCarrito.splice(i, 1);
    }
  }
  localStorage.setItem("listaCarrito", JSON.stringify(listaCarrito));
  getListaCarrito();
  cantidadCarrito();
  Swal.fire("PRODUCTO ELIMINADO DEL CARRITO", "success");
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
