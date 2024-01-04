const nuevo = document.querySelector('#nuevo_registro');
const frm = document.querySelector('#frmRegistro');
const titleModal = document.querySelector('#titleModal');
const btnAccion = document.querySelector('#btnAccion');
const myModal = new bootstrap.Modal(document.getElementById('nuevoModal'));
let tblUsuario;
document.addEventListener("DOMContentLoaded", function () {
    tblUsuario = $('#tblUsuarios').DataTable({
        ajax: {
            url: "https://acinfo.inf.unap.cl/~brojas/interfaz2/milano_mvc/usuarios/listar",
            dataSrc: ''
        },
        columns: [
            { data: 'rut' },
            { data: 'nombre' },
            { data: 'email' },
            { data: 'nom_usuario' },
            { data: 'telefono' },
            {
                data: 'rut',
                render: function(data, type, row) {
                    return '<button class="btn btn-primary" onclick="editUser(' + data + ')"><i class="fas fa-edit"></i></button>' +
                           '<button class="btn btn-danger" onclick="eliminarUser(' + data + ')"><i class="fas fa-trash"></i></button>';
                }
            }
        ],
        language,
        dom,
        buttons,
    });
    nuevo.addEventListener('click', function () {
        document.querySelector('#rut').value = ' ';
        btnAccion.textContent = 'Registrar';
        titleModal.textContent = 'NUEVO USUARIO';
        myModal.show();
    })
    //submit usuarios
    frm.addEventListener('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        let data = {};
        formData.forEach((value, key) => data[key] = value);
    
        fetch('https://acinfo.inf.unap.cl/~brojas/interfaz2/milano_mvc/usuarios/registrar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            Swal.fire("Aviso", data.msg.toUpperCase(), data.icono);
            if (data.icono == 'success') {
                tblProductos.ajax.reload();
                frm.reset();
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

function eliminarUser(idUser) {
    Swal.fire({
        title: 'Aviso',
        text: "Esta seguro de eliminar el registro?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = "https://acinfo.inf.unap.cl/~brojas/interfaz2/milano_mvc/usuarios/delete/" + idUser;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res.icono = 'sucess') {
                        tblUsuario.ajax.reload();
                    }
                    Swal.fire("Aviso", res.msg.toUpperCase(), res.icono);
                }
            };
        }
    })
}

function editUser(idUser) {
    const url = "https://acinfo.inf.unap.cl/~brojas/interfaz2/milano_mvc/usuarios/edit/" + idUser;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.querySelector('#nombre').value = res[0].nombre;
            document.querySelector('#email').value = res[0].email;
            document.querySelector('#telefono').value = res[0].telefono;
            document.querySelector('#nom_usuario').value = res[0].nom_usuario;
            document.querySelector('#fecha_nacimiento').value = res[0].fecha_nacimiento;
            const rutInput = document.querySelector('#rut');
            rutInput.value = res[0].rut;
            rutInput.setAttribute('readonly', true); // Hacer el campo RUT solo lectura
            // Omitir campo contraseña o proporcionar opción para restablecer
            const contrasenaInput = document.querySelector('#contrasena');
            contrasenaInput.value = res[0].contrasena;
            contrasenaInput.setAttribute('readonly', true); // Hacer el campo Contraseña solo lectura
            btnAccion.textContent = 'Actualizar';
            titleModal.textContent = 'MODIFICAR USUARIO';
            myModal.show();
            //$('#nuevoModal').modal('show');
        }
    }
}