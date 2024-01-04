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

const btnModalLogin = document.querySelector("#btnModalLogin");

const modalLogin = new bootstrap.Modal(document.getElementById("modalLogin"));

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
      let data = {
        nombre: nombreRegistro.value,
        nom_usuario: nom_usuarioRegistro.value,
        rut: rutRegistro.value,
        telefono: telefonoRegistro.value,
        fecha_nacimiento: fdnRegistro.value,
        contrasena: contrasenaRegistro.value,
        email: correoRegistro.value
      };

      fetch('https://acinfo.inf.unap.cl/~brojas/interfaz2/milano_mvc/clientes/registrarse', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      })
        .then(response => response.json())
        .then(res => {
          Swal.fire("Aviso", res.msg, res.icono);
          if (res.icono == "success") {
            setTimeout(() => {
              window.location.reload();
            }, 2000);
          }
        })
        .catch(error => console.error('Error:', error));
    };
    /*
      btnModalLogin.addEventListener("click", function () {
        modalLogin.show();
      }); */
  });

  //login directo
  login.addEventListener("click", function () {
    if (correoLogin.value == "" || contrasenaLogin.value == "") {
      Swal.fire("Aviso", "Debes rellenar todos los campos", "warning");
    } else {
      let data = {
        correoLogin: correoLogin.value,
        contrasenaLogin: contrasenaLogin.value
      };

      fetch('https://acinfo.inf.unap.cl/~brojas/interfaz2/milano_mvc/clientes/iniciar_sesion', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Respuesta de red no fue ok. Estado: ' + response.status);
          }
          return response.text();  // Cambia a text() para manejar cualquier tipo de respuesta
        })
        .then(text => {
          try {
            const res = JSON.parse(text); // Intenta analizar el texto como JSON
            Swal.fire("Aviso", res.msg, res.icono);
            if (res.icono == "success") {
              setTimeout(() => {
                window.location.reload();
              }, 2000);
            }
          } catch (e) {
            console.error('La respuesta no es un JSON válido:', text);
            // Maneja el caso en que la respuesta no es JSON aquí
          }
        })
        .catch(error => {
          console.error('Error:', error);
          // Manejar otros errores de red aquí
        });

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
} */

function abrirModalLogin() {
  myModal.hide();
  modalLogin.show();
}
