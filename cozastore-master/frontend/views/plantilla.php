<?php session_start();
$frontend = Ruta::ctrRuta();
$backend = Ruta::ctrRutaServidor();
$comercio = ControladorPlantilla::ctrMostrarDivisa();
$divisa = $comercio['divisa'];
$plantilla = ControladorPlantilla::ctrEstiloPlantilla(); ?>
<?php

/* -------------------------------------------------------------------------- */
/*                            MARCADO DE CABECERAS                            */
/* -------------------------------------------------------------------------- */

$rutas = array();

if (isset($_GET['ruta'])) {
	$rutas = explode("/", $_GET['ruta']);
	$ruta = $rutas[0];
} else {
	$ruta = 'inicio';
}

$cabeceras = ControladorPlantilla::ctrTraerCabeceras($ruta);

if (!is_array($cabeceras)) {
	$ruta = 'inicio';
	$cabeceras = ControladorPlantilla::ctrTraerCabeceras($ruta);
}

/* -------------------------- MARCADO DE CABECERAS -------------------------- */

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- -------------------------------------------------------------------------- */
	/*                                    ICONO                                   */
	/* -------------------------------------------------------------------------- -->
	<!-- ---------------------------------- ICONO --------------------------------- -->

	<title><?= $cabeceras['titulo'] ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="title" content="<?= $cabeceras['titulo'] ?>">
	<meta name="description" content="<?= $cabeceras['descripcion'] ?>">
	<meta name="keyword" content="<?= $cabeceras['palabrasClaves'] ?>">

	<!-- -------------------------------------------------------------------------- */
	/*                       Marcado de Open Graph FACEBOOK                       */
	/* -------------------------------------------------------------------------- -->

	<meta property="og:title" content="<?= $cabeceras['titulo'] ?>">
	<meta property="og:url" content="<?= $frontend . $cabeceras['ruta'] ?>">
	<meta property="og:description" content="<?= $cabeceras['descripcion'] ?>">
	<meta property="og:image" content="<?= $cabeceras['portada'] ?>">
	<meta property="og:type" content="website">
	<meta property="og:site_name" content="Tu logo">
	<meta property="og:locale" content="es_MX">

	<!-- --------------------- Marcado de Open Graph FACEBOOK --------------------- -->

	<!-- -------------------------------------------------------------------------- */
	/*                             Marcado de TWITTER                             */
	/* -------------------------------------------------------------------------- -->

	<meta name="twitter:card" content="summary">
	<meta name="twitter:title" content="<?= $cabeceras['titulo'] ?>">
	<meta name="twitter:url" content="<?= $frontend . $cabeceras['ruta'] ?>">
	<meta name="twitter:description" content="<?= $cabeceras['descripcion'] ?>">
	<meta name="twitter:image" content="<?= $cabeceras['portada'] ?>">
	<meta name="twitter:site" content="@tu-usuario">

	<!-- --------------------------- Marcado de TWITTER --------------------------- -->

	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?= $frontend ?>views/images/icons/favicon.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= $frontend ?>views/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= $frontend ?>views/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= $frontend ?>views/fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= $frontend ?>views/fonts/linearicons-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= $frontend ?>views/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= $frontend ?>views/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= $frontend ?>views/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= $frontend ?>views/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= $frontend ?>views/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= $frontend ?>views/vendor/slick/slick.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= $frontend ?>views/vendor/MagnificPopup/magnific-popup.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= $frontend ?>views/vendor/perfect-scrollbar/perfect-scrollbar.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= $frontend ?>views/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= $frontend ?>views/css/main.css">
	<link rel="stylesheet" href="<?= $frontend ?>views/css/plantilla.css">
	<!--===============================================================================================-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="animsition">

	<?php include_once 'modules/header.php'; ?>
	<?php include_once 'modules/cariito.php'; ?>

	<?php
	$rutas = array();
	$ruta = null;
	$infoProductos = null;

	if (isset($_GET['ruta'])) {
		$rutas = explode('/', $_GET['ruta']);
		$item = 'ruta';
		$valor = $rutas[0];

		/* -------------------------------------------------------------------------- */
		/*                        URL'S AMIGABLES DE CATEGORIAS                       */
		/* -------------------------------------------------------------------------- */

		$rutaCategorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

		if (is_array($rutaCategorias) && $valor == $rutaCategorias['ruta'] && $rutaCategorias['estado'] == 1) {
			$ruta = $valor;
		}

		/* ---------------------- URL'S AMIGABLES DE CATEGORIAS --------------------- */

		/* -------------------------------------------------------------------------- */
		/*                      URL'S AMIGABLES DE SUB-CATEGORIAS                     */
		/* -------------------------------------------------------------------------- */

		$rutaSubCategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

		foreach ($rutaSubCategorias as $key => $value) {
			if (is_array($value) && $valor == $value['ruta'] && $value['estado'] == 1) {
				$ruta = $valor;
			}
		}

		/* -------------------- URL'S AMIGABLES DE SUB-CATEGORIAS ------------------- */

		/* -------------------------------------------------------------------------- */
		/*                        URL'S AMIGABLES DE PRODUCTOS                        */
		/* -------------------------------------------------------------------------- */

		$rutaProductos = ControladorProductos::ctrMostrarInfoproducto($item, $valor);

		if (is_array($rutaProductos) && $rutas[0] == $rutaProductos['ruta'] && $rutaProductos['estado'] == 1) {
			$infoProductos = $valor;
		}

		/* ---------------------- URL'S AMIGABLES DE PRODUCTOS ---------------------- */

		/* -------------------------------------------------------------------------- */
		/*                               URL'S AMIGABLES                              */
		/* -------------------------------------------------------------------------- */

		if ($ruta != null || $rutas[0] == 'articulos-recientes' || $rutas[0] == 'lo-mas-vendido' || $rutas[0] == 'lo-mas-visto') {

			include_once 'modules/productos.php';
		} else if ($infoProductos != null) {

			include_once 'modules/infoproducto.php';
		} else if ($rutas[0] == 'buscador' || $rutas[0] == 'verificar' || $rutas[0] == 'salir' || $rutas[0] == 'perfil' || $rutas[0] == 'carrito-de-compras' || $rutas[0] == 'error' || $rutas[0] == 'finalizar-compra' || $rutas[0] == 'ofertas' || $rutas[0] == 'cancelado' || $rutas[0] == 'tienda' || $rutas[0] == 'login' || $rutas[0] == 'register' || $rutas[0] == 'blog-inicio' || $rutas[0] == 'nosotros' || $rutas[0] == 'contacto' || $rutas[0] == 'recuperar-password') {

			include 'modules/' . $rutas[0] . '.php';
		} else if ($rutas[0] == 'inicio') {

			include_once 'modules/slide.php';
			include_once 'modules/banner-cta.php';
			include_once 'modules/productos-home.php';
		} else {

			include 'modules/error404.php';
		}

		/* ----------------------------- URL'S AMIGABLES ---------------------------- */
	} else {
		include_once 'modules/slide.php';
		include_once 'modules/banner-cta.php';
		include_once 'modules/productos-home.php';
	}

	include_once 'modules/footer.php';
	?>

	<input type="hidden" value="<?= $frontend ?>" id="rutaOculta">

	<!--========================================
	=            SCRIPT DE FACEBOOK            =
	=========================================-->

	<?php echo $plantilla['apiFacebook']; ?>

	<!--====  End of SCRIPT DE FACEBOOK  ====-->


	<!--===============================================================================================-->
	<script src="<?= $frontend ?>views/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= $frontend ?>views/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= $frontend ?>views/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= $frontend ?>views/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= $frontend ?>views/vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function() {
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
	<!--===============================================================================================-->
	<script src="<?= $frontend ?>views/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= $frontend ?>views/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="<?= $frontend ?>views/vendor/slick/slick.min.js"></script>
	<script src="<?= $frontend ?>views/js/slick-custom.js"></script>
	<!--===============================================================================================-->
	<script src="<?= $frontend ?>views/vendor/parallax100/parallax100.js"></script>
	<script>
		$('.parallax100').parallax100();
	</script>
	<!--===============================================================================================-->
	<script src="<?= $frontend ?>views/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
				delegate: 'a', // the selector for gallery item
				type: 'image',
				gallery: {
					enabled: true
				},
				mainClass: 'mfp-fade'
			});
		});
	</script>
	<!--===============================================================================================-->
	<script src="<?= $frontend ?>views/vendor/isotope/isotope.pkgd.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?= $frontend ?>views/vendor/sweetalert/sweetalert.min.js"></script>
	<script>
		$('.js-addwish-b2').on('click', function(e) {
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function() {
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function() {
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function() {
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function() {
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function() {
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function() {
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	</script>
	<!--===============================================================================================-->
	<script src="<?= $frontend ?>views/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function() {
			$(this).css('position', 'relative');
			$(this).css('overflow', 'hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function() {
				ps.update();
			})
		});
	</script>
	<!--===============================================================================================-->
	<script src="<?= $frontend ?>views/js/main.js"></script>
	<script src="<?= $frontend ?>views/js/plantilla.js"></script>
	<script src="<?= $frontend ?>views/js/buscador.js"></script>
	<script src="<?= $frontend ?>views/js/usuarios.js"></script>
	<script src="<?= $frontend ?>views/js/registroFacebook.js"></script>

</body>

</html>