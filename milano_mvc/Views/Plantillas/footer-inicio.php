<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title"><i class="fas fa-solid fa-basket-shopping">Carrito</h5>
				<button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<footer class="footer">
			<div class="container container-footer">
				<div class="menu-footer">
					<div class="contact-info">
						<p class="title-footer">Información de Contacto</p>
						<ul>
							<li>
								Dirección: Vicente Zegers 999, Iquique, Chile
							</li>
							<li>Teléfono: +56-572-412571</li>
							<li>WhatsApp: +569-44982963</li>
							<li>Email: info@gelateriamilano.cl</li>
						</ul>
						<div class="social-icons">
							<span class="facebook">
								<i class="fa-brands fa-facebook-f"></i>
							</span>
							<span class="twitter">
								<i class="fa-brands fa-twitter"></i>
							</span>
							<span class="youtube">
								<i class="fa-brands fa-youtube"></i>
							</span>
							<span class="instagram">
								<i class="fa-brands fa-instagram"></i>
							</span>
						</div>
					</div>

					<div class="information">
						<p class="title-footer">Información</p>
						<ul>
							<li><a href="#">Acerca de Nosotros</a></li>
							<li><a href="#">Politicas de Privacidad</a></li>
							<li><a href="#">Términos y condiciones</a></li>
						</ul>
					</div>

					<div class="my-account">
						<p class="title-footer">Mi cuenta</p>

						<ul>
							<li><a href="#">Mi cuenta</a></li>
							<li><a href="#">Historial de ordenes</a></li>
							<li><a href="#">Lista de deseos</a></li>
						</ul>
					</div>
				</div>

				<div class="copyright">
					<p>
						Desarrollado por Estudiantes UNAP
					</p>
				</div>
			</div>
		</footer>

<script>
  const base_url = '<?php echo BASE_URL; ?>';

  function alertaPerzanalizada(mensaje, type, titulo = '') {
    toastr[type](mensaje, titulo)

    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  }

  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }
</script>
<script src="<?php echo BASE_URL; ?>Assets/js/carrito.js"></script>
<script src="<?php echo BASE_URL; ?>Assets/js/sweetalert2.all.min"></script>
<!-- <script src="<?php echo BASE_URL; ?>Assets/js/login.js"></script>-->