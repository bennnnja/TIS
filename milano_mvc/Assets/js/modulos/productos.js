const frm = document.querySelector('#frmRegistro')
const btnAccion = document.querySelector('#btnAccion')
let tblProductos;

var firstTabEl = document.querySelector('#myTab li:last-child button')
var firstTab = new bootstrap.Tab(firstTabEl)

document.addEventListener("DOMContentLoaded", function () {
    tblProductos = $('#tblProductos').DataTable({
        ajax: {
            url: "https://acinfo.inf.unap.cl/~brojas/interfaz2/milano_mvc/productos/listar",
            dataSrc: ''
        },
        columns: [
            { data: 'cod_producto' },
            { data: 'nombre_producto' },
            { data: 'stock' },
            { data: 'precio' },
            {
                data: 'imagen', 
                render: function(data, type, row) {
                    return '<img src="' + data + '" alt="Imagen" height="50" />';
                } 
            },
            {
                data: 'cod_producto',
                render: function(data, type, row) {
                    return '<button class="btn btn-primary" onclick="editPro(' + data + ')"><i class="fas fa-edit"></i></button>' +
                           '<button class="btn btn-danger" onclick="eliminarPro(' + data + ')"><i class="fas fa-trash"></i></button>';
                }
            }
        ],
        language,
        dom,
        buttons,
    });

    frm.addEventListener('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        let data = {};
        formData.forEach((value, key) => data[key] = value);
    
        fetch('https://acinfo.inf.unap.cl/~brojas/interfaz2/milano_mvc/productos/registrar', {
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
        Swal.fire("Aviso", "Producto ingresado", "success");
    });
});

function eliminarPro(idPro) {
    Swal.fire({
        title: 'Aviso',
        text: "Esta seguro de eliminar el producto?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = "https://acinfo.inf.unap.cl/~brojas/interfaz2/milano_mvc/productos/delete/" + idPro;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res.icono = 'sucess') {
                        tblProductos.ajax.reload();
                    }
                    Swal.fire("Aviso", res.msg.toUpperCase(), res.icono);
                }
            };
        }
    })
}

function editPro(idPro) {
    const url = "https://acinfo.inf.unap.cl/~brojas/interfaz2/milano_mvc/productos/edit/" + idPro;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            // Asigna valores a los campos del formulario
            document.querySelector('#nombre_producto').value = res[0].nombre_producto;
            document.querySelector('#precio').value = res[0].precio;
            document.querySelector('#stock').value = res[0].stock;
            document.querySelector('#fecha_vencimiento').value = res[0].fecha_vencimiento;
            document.querySelector('#categoria').value = res[0].categoria;
            document.querySelector('#sabor').value = res[0].sabor;
            document.querySelector('#imagen_actual').value = res[0].imagen;
            const codInput = document.querySelector('#cod_producto');
            codInput.value = res[0].cod_producto;
            codInput.setAttribute('readonly', true); // Hacer el campo cod_producto solo lectura
            
            // Deshabilitar el campo de imagen
            const imagenInput = document.querySelector('#imagen');
            imagenInput.setAttribute('disabled', true);

            btnAccion.textContent = 'Actualizar';
            document.getElementById('nuevoProducto').click();
            firstTab.show();
        }
    }
}
