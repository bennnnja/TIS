const frm = document.querySelector('#formulario');
const email = document.querySelector('#email');
const contrasena = document.querySelector('#contrasena');
document.addEventListener("DOMContentLoaded", function(){
    frm.addEventListener('submit', function(e){
        e.preventDefault();
        if(email.value == '' || contrasena.value == ''){
            alertas('todos los campos son requeridos', 'warning');
        } else {
            let data = {
                email: email.value,
                contrasena: contrasena.value
            };

            fetch('https://acinfo.inf.unap.cl/~brojas/interfaz2/milano_mvc/admin/validar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(res => {
                console.log(res);
                if (res.icono == 'success'){
                    setTimeout(() =>{
                        window.location = "https://acinfo.inf.unap.cl/~brojas/interfaz2/milano_mvc/admin/home";
                    }, 2000);
                }
                alertas(res.msg, res.icono);
            })
            .catch(error => console.error('Error:', error));
        }
    });
});


function alertas (msg, icono){
    Swal.fire(
        'Aviso',
        msg.toUpperCase(),
        icono
    )
}