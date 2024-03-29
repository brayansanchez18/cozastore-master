<?php

/* -------------------------------------------------------------------------- */
/*                                CONTROLADORES                               */
/* -------------------------------------------------------------------------- */

require_once 'controllers/plantilla.controlador.php';
require_once 'controllers/productos.controlador.php';
require_once 'controllers/slide.controlador.php';
require_once 'controllers/usuarios.controlador.php';
require_once 'controllers/carrito.controlador.php';
require_once 'controllers/visitas.controlador.php';

/* ------------------------------ CONTROLADORES ----------------------------- */

/* -------------------------------------------------------------------------- */
/*                                   MODELOS                                  */
/* -------------------------------------------------------------------------- */

require_once 'models/plantilla.modelo.php';
require_once 'models/productos.modelo.php';
require_once 'models/slide.modelo.php';
require_once 'models/usuarios.modelo.php';
require_once 'models/carrito.modelo.php';
require_once 'models/visitas.modelo.php';

require_once 'models/rutas.php';

/* --------------------------------- MODELOS -------------------------------- */

/* -------------------------------------------------------------------------- */
/*                                  EXTENSION                                 */
/* -------------------------------------------------------------------------- */

require_once 'extenciones/phpmailer/vendor/autoload.php';
require_once 'extenciones/google/vendor/autoload.php';

/* -------------------------------- EXTENSION ------------------------------- */

$plantilla = new ControladorPlantilla();
$plantilla->plantilla();
