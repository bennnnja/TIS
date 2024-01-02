const frm = document.querySelector('#frmRegistro')
const btnAccion = document.querySelector('#btnAccion')
let tblIngredientes;

var firstTabEl = document.querySelector('#myTab li:last-child button')
var firstTab = new bootstrap.Tab(firstTabEl)
document.addEventListener("DOMContentLoaded", function () {
    tblIngredientes = $('#tblIngredientes').DataTable({
        ajax: {
            url: "https://acinfo.inf.unap.cl/~brojas/interfaz2/milano_mvc/ingredientes/listar",
            dataSrc: ''
        },
        columns: [
            { data: 'cod_ingrediente' },
            { data: 'nombre_ingrediente' },
            { data: 'stock' },
            { data: 'unidad_de_medida' },
            {
                data: 'cod_ingrediente',
                render: function(data, type, row) {
                    return '<button class="btn btn-primary" onclick="editIngre(' + data + ')"><i class="fas fa-edit"></i></button>' +
                           '<button class="btn btn-danger" onclick="eliminarIngre(' + data + ')"><i class="fas fa-trash"></i></button>';
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
    
        fetch('https://acinfo.inf.unap.cl/~brojas/interfaz2/milano_mvc/ingredientes/registrar', {
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

function eliminarIngre(idIngre) {
    Swal.fire({
        title: 'Aviso',
        text: "Esta seguro de eliminar el ingrediente?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = "https://acinfo.inf.unap.cl/~brojas/interfaz2/milano_mvc/ingredientes/delete/" + idIngre;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res.icono = 'sucess') {
                        tblIngredientes.ajax.reload();
                    }
                    Swal.fire("Aviso", res.msg.toUpperCase(), res.icono);
                }
            };
        }
    })
}

function editIngre(idIngre) {
    const url = "https://acinfo.inf.unap.cl/~brojas/interfaz2/milano_mvc/ingredientes/edit/" + idIngre;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.querySelector('#nombre_ingrediente').value = res[0].nombre_ingrediente;
            document.querySelector('#unidad_de_medida').value = res[0].unidad_de_medida;
            document.querySelector('#stock').value = res[0].stock;
            document.querySelector('#fecha_vencimiento').value = res[0].fecha_vencimiento;
            const codInput = document.querySelector('#cod_ingrediente');
            codInput.value = res[0].cod_ingrediente;
            codInput.setAttribute('readonly', true); // Hacer el campo cod_producto solo lectura
            btnAccion.textContent = 'Actualizar';
            document.getElementById('nuevoIngrediente').click();
            firstTab.show();
        }
    }
}