<?php
/* -------------------------------------------------------------------------- */
/*                          INICIO DE SESION USUARIO                          */
/* -------------------------------------------------------------------------- */

if (isset($_SESSION['validarSesion'])) {
  if ($_SESSION['validarSesion'] == 'ok') {
    echo '<script>
				localStorage.setItem("usuario","' . $_SESSION["id"] . '");
			</script>';
  }
}

/* ------------------------ INICIO DE SESION USUARIO ------------------------ */

/* -------------------------------------------------------------------------- */
/*                      CREAR EL OBJETO DE LA API GOOGLE                      */
/* -------------------------------------------------------------------------- */

// $cliente = new Google\Client();
// $cliente->setAuthConfig('modelos/client_secret.json');
// $cliente->setAccessType("offline");
// $cliente->setScopes(['profile', 'email']);

/* -------------------- CREAR EL OBJETO DE LA API GOOGLE -------------------- */

/* -------------------------------------------------------------------------- */
/*                        RUTA PARA EL LOGIN DE GOOGLE                        */
/* -------------------------------------------------------------------------- */

// $rutaGoogle = $cliente->createAuthUrl();

/* ---------------------- RUTA PARA EL LOGIN DE GOOGLE ---------------------- */

/* -------------------------------------------------------------------------- */
/*              RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE              */
/* -------------------------------------------------------------------------- */

// if (isset($_GET['code'])) {
//   $token = $cliente->authenticate($_GET['code']);
//   $_SESSION['id_token_google'] = $token;
//   $cliente->setAccessToken($token);
// }

/* ------------ RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE ------------ */

/* -------------------------------------------------------------------------- */
/*             RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY             */
/* -------------------------------------------------------------------------- */

// if ($cliente->getAccessToken()) {
//   $item = $cliente->verifyIdToken();
//   $datos = [
//     'nombre' => $item['name'],
//     'email' => $item['email'],
//     'foto' => $item['picture'],
//     'password' => 'null',
//     'modo' => 'google',
//     'verificacion' => 0,
//     'emailEncriptado' => 'null'
//   ];

// $respuesta = ControladorUsuario::ctrRegistroRedesSociales($datos);
// }

/* ----------- RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY ----------- */
?>
<!-- Header -->
<header>
  <!-- Header desktop -->
  <div class="container-menu-desktop">
    <!-- Topbar -->
    <div class="top-bar">
      <div class="content-topbar flex-sb-m h-full container">
        <div class="left-top-bar">
          <!-- Envio gratis en compras mayores a $101 -->
        </div>

        <div class="right-top-bar flex-w h-full">
          <?php if (isset($_SESSION['validarSesion'])) : ?>
            <?php if ($_SESSION['validarSesion'] == 'ok') : ?>
              <?php if ($_SESSION['modo'] == 'directo') : ?>
                <a href="<?= $frontend ?>perfil" class="flex-c-m trans-04 p-lr-25 text-capitalize">
                  <?= $_SESSION['nombre'] ?>
                </a>

                <a href="<?= $frontend ?>salir" class="flex-c-m trans-04 p-lr-25">
                  Salir
                </a>
              <?php endif ?>
            <?php endif ?>
          <?php else : ?>
            <a href="<?= $frontend ?>login" class="flex-c-m trans-04 p-lr-25">
              Ingresar
            </a>

            <a href="<?= $frontend ?>register" class="flex-c-m trans-04 p-lr-25">
              Registrarse
            </a>
          <?php endif ?>
        </div>
      </div>
    </div>

    <div class="wrap-menu-desktop">
      <nav class="limiter-menu-desktop container">

        <!-- Logo desktop -->
        <a href="<?= $frontend ?>" class="logo">
          <img src="<?= $backend ?>views/images/icons/logo-01.png" alt="IMG-LOGO">
        </a>

        <!-- Menu desktop -->
        <div class="menu-desktop">
          <ul class="main-menu">
            <li class="active-menu">
              <a href="<?= $frontend ?>">Inicio</a>
            </li>

            <li>
              <a href="<?= $frontend ?>tienda">Tienda</a>
            </li>

            <li class="label1" data-label1="hot">
              <a href="<?= $frontend ?>ofertas">Ofertas</a>
            </li>

            <li>
              <a href="<?= $frontend ?>blog-inicio">Blog</a>
            </li>

            <li>
              <a href="<?= $frontend ?>nosotros">Nosotros</a>
            </li>

            <li>
              <a href="<?= $frontend ?>contacto">Contacto</a>
            </li>
          </ul>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m">
          <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
            <i class="zmdi zmdi-search"></i>
          </div>

          <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="2">
            <i class="zmdi zmdi-shopping-cart"></i>
          </div>

          <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
            <i class="zmdi zmdi-favorite-outline"></i>
          </a>
        </div>
      </nav>
    </div>
  </div>

  <!-- Header Mobile -->
  <div class="wrap-header-mobile">
    <!-- Logo moblie -->
    <div class="logo-mobile">
      <a href="index.html"><img src="<?= $backend ?>views/images/icons/logo-01.png" alt="IMG-LOGO"></a>
    </div>

    <!-- Icon header -->
    <div class="wrap-icon-header flex-w flex-r-m m-r-15">
      <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
        <i class="zmdi zmdi-search"></i>
      </div>

      <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
        <i class="zmdi zmdi-shopping-cart"></i>
      </div>

      <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
        <i class="zmdi zmdi-favorite-outline"></i>
      </a>
    </div>

    <!-- Button show menu -->
    <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
      <span class="hamburger-box">
        <span class="hamburger-inner"></span>
      </span>
    </div>
  </div>


  <!-- Menu Mobile -->
  <div class="menu-mobile">
    <ul class="topbar-mobile">
      <li>
        <div class="left-top-bar">
          <!-- Free shipping for standard order over $100 -->
        </div>
      </li>

      <li>
        <div class="right-top-bar flex-w h-full">
          <?php if (isset($_SESSION['validarSesion'])) : ?>
            <?php if ($_SESSION['validarSesion'] == 'ok') : ?>
              <?php if ($_SESSION['modo'] == 'directo') : ?>
                <a href="<?= $frontend ?>perfil" class="flex-c-m trans-04 p-lr-10 text-capitalize">
                  <?= $_SESSION['nombre'] ?>
                </a>

                <a href="<?= $frontend ?>salir" class="flex-c-m trans-04 p-lr-10">
                  Salir
                </a>
              <?php endif ?>
            <?php endif ?>
          <?php else : ?>
            <a href="<?= $frontend ?>login" class="flex-c-m trans-04 p-lr-10">
              Ingresar
            </a>

            <a href="<?= $frontend ?>register" class="flex-c-m trans-04 p-lr-10">
              Registrarse
            </a>
          <?php endif ?>
        </div>
      </li>
    </ul>

    <ul class="main-menu-m">
      <li>
        <a href="<?= $frontend ?>">Inicio</a>
      </li>

      <li>
        <a href="<?= $frontend ?>tienda">Tienda</a>
      </li>

      <li>
        <a href="<?= $frontend ?>ofertas" class="label1 rs1" data-label1="hot">Ofertas</a>
      </li>

      <li>
        <a href="<?= $frontend ?>blog-inicio">Blog</a>
      </li>

      <li>
        <a href="<?= $frontend ?>nosotros">Nosotros</a>
      </li>

      <li>
        <a href="<?= $frontend ?>contacto">Contacto</a>
      </li>
    </ul>
  </div>

  <!-- Modal Search -->
  <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
    <div class="container-search-header">
      <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
        <img src="<?= $backend ?>views/images/icons/icon-close2.png" alt="CLOSE">
      </button>

      <div class="wrap-search-header flex-w p-l-15" id="buscador">
        <button class="flex-c-m trans-04">
          <a href="<?= $frontend ?>buscador/1" class="linkBuscador">
            <i class="zmdi zmdi-search"></i>
          </a>
        </button>
        <input id="search-input" placeholder="Buscar...">
        </form>
      </div>
    </div>
</header>