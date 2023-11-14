const grid = new Muuri('.grid', {
    layout: {
      rounding: false
    }
  });
  
  window.addEventListener('load', () => {
    grid.refreshItems().layout();
    document.getElementById('grid').classList.add('imagenes-cargadas');
  
    // Agregamos los listener de los enlaces para filtrar por categoría.
    const enlaces = document.querySelectorAll('#categorias a');
    enlaces.forEach((elemento) => {
      elemento.addEventListener('click', (evento) => {
        evento.preventDefault();
        enlaces.forEach((enlace) => enlace.classList.remove('activo'));
        evento.target.classList.add('activo');
  
        const categoria = evento.target.innerHTML.toLowerCase();
        categoria === 'todos' ? grid.filter('[data-categoria]') : grid.filter(`[data-categoria="${categoria}"]`);
      });
    });
  
    // Agregamos el listener para la barra de búsqueda
    document.querySelector('#barra-busqueda').addEventListener('input', (evento) => {
      const busqueda = evento.target.value;
      grid.filter((item) => item.getElement().dataset.etiquetas.includes(busqueda));
    });
  
    // Agregamos listener para las pestañas de productos
    const opcionesProductos = document.querySelectorAll('.container-options span');
    opcionesProductos.forEach((opcion) => {
      opcion.addEventListener('click', (evento) => {
        opcionesProductos.forEach((op) => op.classList.remove('active'));
        evento.target.classList.add('active');
  
        const tipoProducto = evento.target.innerHTML.toLowerCase();
        // Aquí debes ajustar la lógica de filtrado según las pestañas de destacados, más recientes y más vendidos.
        // Por ejemplo:
        if (tipoProducto === 'destacados') {
          // Lógica para mostrar productos destacados
          grid.filter('[data-destacado="true"]');
        } else if (tipoProducto === 'más recientes') {
          // Lógica para mostrar productos más recientes
          grid.filter('[data-reciente="true"]');
        } else if (tipoProducto === 'mejores vendidos') {
          // Lógica para mostrar productos más vendidos
          grid.filter('[data-vendido="true"]');
        }
      });
    });
  // Agregamos listener para las imagenes
	const overlay = document.getElementById('overlay');
	document.querySelectorAll('.grid .item img').forEach((elemento) => {
		elemento.addEventListener('click', () => {
			const ruta = elemento.getAttribute('src');
			const descripcion = elemento.parentNode.parentNode.dataset.descripcion;

			overlay.classList.add('activo');
			document.querySelector('#overlay img').src = ruta;
			document.querySelector('#overlay .descripcion').innerHTML = descripcion;
		});
	});

	// Eventlistener del boton de cerrar
	document.querySelector('#btn-cerrar-popup').addEventListener('click', () => {
		overlay.classList.remove('activo');
	});

	// Eventlistener del overlay
	overlay.addEventListener('click', (evento) => {
		evento.target.id === 'overlay' ? overlay.classList.remove('activo') : '';
	});
});