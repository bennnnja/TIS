const btnRegister = document.querySelector("#btnRegister");
const btnLogin = document.querySelector("#btnLogin");
const frmLogin = document.querySelector("#frmLogin");
const frmRegister = document.querySelector("#frmRegister");
const registrarse = document.querySelector("#registrarse");
const login = document.querySelector("#login");


const nombreRegistro = document.querySelector("#nombreRegistro");
const nom_usuarioRegistro = document.querySelector("#nom_usuarioRegistro");
const rutRegistro = document.querySelector("#rutRegistro");
const telefonoRegistro = document.querySelector("#telefonoRegistro");
const fdnRegistro = document.querySelector("#fdnRegistro");
const contrasenaRegistro = document.querySelector("#contrasenaRegistro");
const correoRegistro = document.querySelector("#correoRegistro");

const correoLogin = document.querySelector("#correoLogin");
const contrasenaLogin = document.querySelector("#contrasenaLogin");

const inputBusqueda = document.querySelector("#search");

document.addEventListener("DOMContentLoaded", function () {
  btnRegister.addEventListener("click", function () {
    frmLogin.classList.add("d-none");
    frmRegister.classList.remove("d-none");
  });
  btnLogin.addEventListener("click", function () {
    frmRegister.classList.add("d-none");
    frmLogin.classList.remove("d-none");
  });

  //registro
  registrarse.addEventListener("click", function () {
    if (
      nombreRegistro.value == "" ||
      nom_usuarioRegistro.value == "" ||
      rutRegistro.value == "" ||
      telefonoRegistro.value == "" ||
      fdnRegistro.value == "" ||
      correoRegistro.value == "" ||
      contrasenaRegistro.value == ""
    ) {
      Swal.fire("Aviso", "Debes rellenar todos los campos", "warning");
    } else {
      let formData = new FormData();
      formData.append("nombre", nombreRegistro.value);
      formData.append("nom_usuario", nom_usuarioRegistro.value);
      formData.append("rut", rutRegistro.value);
      formData.append("telefono", telefonoRegistro.value);
      formData.append("fecha_nacimiento", fdnRegistro.value);
      formData.append("contrasena", contrasenaRegistro.value);
      formData.append("email", correoRegistro.value);
      const url = base_url + "clientes/registroDirecto";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(formData);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          Swal.fire("Aviso", res.msg, res.icono);
          if (res.icono == "success") {
            setTimeout(() => {
              window.location.reload();
            }, 2000);
          }
        }
      };
    }
  });


  //login directo
  login.addEventListener("click", function () {
    if (correoLogin.value == "" || contrasenaLogin.value == "") {
      Swal.fire("Aviso", "Debes rellenar todos los campos", "warning");
    } else {
      let formData = new FormData();
      formData.append("correoLogin", correoLogin.value);
      formData.append("contrasenaLogin", contrasenaLogin.value);
      const url = base_url + "clientes/loginDirecto";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(formData);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
         console.log(this.responseText);
          /* const res = JSON.parse(this.responseText);
          Swal.fire("Aviso", res.msg, res.icono);
          if (res.icono == "success") {
            setTimeout(() => {
              window.location.reload();
            }, 2000);
          }*/
        }
      };
    }
  });

  //busqueda de productos
  inputBusqueda.addEventListener("keyup", function (e) {
    if (e.target.value != "") {
      const url = base_url + "principal/busqueda/" + e.target.value;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          let html = "";
          res.forEach((producto) => {
            html += `<div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                      <a href="#">
                        <img src="${producto.imagen}" class="card-img-top" alt="${producto.nombre}">
                      </a>
                      <div class="card-body">
                        <a href="#" class="h2 text-decoration-none text-dark">${producto.nombre}</a>
                        <p class="card-text">
                        $${producto.precio}
                        </p>
                        <div class="buy_bt"><a href="#" onclick="agregarCarrito(${producto.id}, 1)">Añadir</a></div>
                      </div>
                    </div>
                  </div>`;
          });
          document.querySelector("#resultBusqueda").innerHTML = html;
        }
      };
    }else{
        document.querySelector('#resultBusqueda').innerHTML = '';
    }
  }); 
});
/*
function enviarCorreo(correo, token) {
  let formData = new FormData();
  formData.append("token", token);
  formData.append("correo", correo);
  const url = base_url + "clientes/enviarCorreo";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(formData);
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      Swal.fire("Aviso?", res.msg, res.icono);
      if (res.icono == "success") {
        setTimeout(() => {
          window.location.reload();
        }, 2000);
      }
    }
  };
}

function abrirModalLogin() {
  $('#modalCarrito').modal('hide')
  $('#modalLogin').modal('show')
}*/
