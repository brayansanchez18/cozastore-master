<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ControladorUsuario
{

  /* -------------------------------------------------------------------------- */
  /*                             REGISTRO DE USUARIO                            */
  /* -------------------------------------------------------------------------- */

  static public function ctrRegistroUsuario($correo)
  {

    if (isset($_POST['regUsuario'])) {

      if (
        preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST['regUsuario']) &&
        preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['regEmail']) &&
        preg_match('/^[a-zA-Z0-9]+$/', $_POST['regPassword'])
      ) {

        $encriptar = crypt($_POST['regPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        $encriptarEmail = md5($_POST['regEmail']);

        $datos = array(
          'nombre' => $_POST['regUsuario'],
          'password' => $encriptar,
          'email' => $_POST['regEmail'],
          'foto' => '',
          'modo' => 'directo',
          'verificacion' => 1,
          'emailEncriptado' => $encriptarEmail
        );

        // var_dump($datos);

        $tabla = 'usuarios';
        $respuesta = ModeloUsuario::mdlRegistroUsuario($tabla, $datos);

        // var_dump($respuesta);

        if ($respuesta == 'ok') {

          /* -------------------------------------------------------------------------- */
          /*                     VERIFICACION DE CORREO ELECTRONICO                     */
          /* -------------------------------------------------------------------------- */

          date_default_timezone_set('America/Mexico_City');
          $url = Ruta::ctrRuta();
          $mail = new PHPMailer(true);
          $mail->CharSet = 'UTF-8';
          $mail->isMail();
          $mail->setFrom($correo, '');
          $mail->addReplyTo($correo, '');
          $mail->Subject = 'Por favor verifique su direccion de correo electrónico';
          $mail->addAddress($_POST['regEmail']);
          $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
        			<center>
        				<img style="padding:20px; width:10%" src="http://tutorialesatualcance.com/tienda/logo.png">
        			</center>
        			<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
        				<center>
        				<img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-email.png">
        				<h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>
        				<hr style="border:1px solid #ccc; width:80%">
        				<h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta de Tienda Virtual, debe confirmar su dirección de correo electrónico</h4>
        				<a href="' . $url . 'verificar/' . $encriptarEmail . '" target="_blank" style="text-decoration:none">
        				<div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su dirección de correo electrónico</div>
        				</a>
        				<br>
        				<hr style="border:1px solid #ccc; width:80%">
        				<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
        				</center>
        			</div>
        		</div>');

          $envio = $mail->send();

          if (!$envio) {
            echo '<script>

              Swal.fire({
                title: "¡ERROR!",
                text: "Ha ocurrido un problema enviando verificación de correo electrónico a ' . $_POST['regEmail'] . $mail->ErrorInfo . '",
                icon: "error",
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
              })
              .then((isConfirm) => {
                if (isConfirm) {
                    window.location.href = "' . $url . 'register"
                }
              });

            </script>';
          } else {

            echo '<script>

              Swal.fire({
                title: "¡OK!",
                text: "Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico ' . $_POST["regEmail"] . ' para verificar la cuenta",
                icon: "success",
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
              })
              .then((isConfirm) => {
                if (isConfirm) {
                  window.location.href = "' . $url . 'login"
                }
              });

            </script>';
          }

          /* ------------------- VERIFICACION DE CORREO ELECTRONICO ------------------- */
        }
      } else {
        $url = Ruta::ctrRuta();
        echo '<script>

          Swal.fire({
              title: "¡ERROR!",
              text: "¡Error al registrar el usuario, no se permiten numeros ni caracteres especiales!",
              icon: "error",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
            })
            .then((isConfirm) => {
              if (isConfirm) {
                  window.location.href = "' . $url . 'register"
              }
            });

      </script>';
      }
    }
  }

  /* --------------------------- REGISTRO DE USUARIO -------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                               MOSTRAR USUARIO                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarUsuario($item, $valor)
  {
    $tabla = 'usuarios';
    $respuesta = ModeloUsuario::mdlMostrarUsuario($tabla, $item, $valor);
    return $respuesta;
  }

  /* ----------------------------- MOSTRAR USUARIO ---------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                             ACTUALIZAR USUARIO                             */
  /* -------------------------------------------------------------------------- */

  static public function ctrActualizarUsuario($id, $item, $valor)
  {
    $tabla = 'usuarios';
    $respuesta = ModeloUsuario::mdlActualizarUsuario($tabla, $id, $item, $valor);
    return $respuesta;
  }

  /* --------------------------- ACTUALIZAR USUARIO --------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                               INGRESO USUARIO                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrIngresoUsuario()
  {

    if (isset($_POST['ingEmail'])) {

      if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['ingEmail']) && preg_match('/^[a-zA-Z0-9]+$/', $_POST['ingPassword'])) {

        $encriptar = crypt($_POST['ingPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        $tabla = 'usuarios';
        $item = 'email';
        $valor = $_POST['ingEmail'];
        $respuesta = ModeloUsuario::mdlMostrarUsuario($tabla, $item, $valor);

        if (is_array($respuesta) && $respuesta['email'] == $_POST['ingEmail'] && $respuesta['password'] == $encriptar) {

          if ($respuesta['verificacion'] == 1) {

            echo '<script>

              Swal.fire({
                  title: "¡NO HA VERIFICADO SU CORREO ELECTRÓNICO!",
                  text: "Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo para verififcar la dirección de correo electrónico ' . $respuesta["email"] . '",
                  icon: "error",
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false
                })
                .then((isConfirm) => {
                  if (isConfirm) {
                    history.back();
                  }
                });

              </script>';
          } else {
            $url = Ruta::ctrRuta();
            $_SESSION['validarSesion'] = 'ok';
            $_SESSION['id'] = $respuesta['id'];
            $_SESSION['nombre'] = $respuesta['nombre'];
            $_SESSION['foto'] = $respuesta['foto'];
            $_SESSION['email'] = $respuesta['email'];
            $_SESSION['password'] = $respuesta['password'];
            $_SESSION['modo'] = $respuesta['modo'];

            // echo '<script>
            //   window.location = localStorage.getItem("rutaActual");
            // </script>';

            echo '<script>
              window.location.href = "' . $url . '"
            </script>';
          }
        } else {

          echo '<script>

          Swal.fire({
              title: "¡ERROR AL INGRESAR!",
              text: "Por favor revise que el email exista o que la contraseña coincida con la que uso al momento de registrarse",
              icon: "error",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
            })
            .then((isConfirm) => {
              if (isConfirm) {
                  history.back();
              }
            });

          </script>';
        }
      } else {

        echo '<script>

          Swal.fire({
              title: "¡ERROR!",
              text: "Error al ingresar al sistema, no se permiten caracteres especiales",
              icon: "error",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
            })
            .then((isConfirm) => {
              if (isConfirm) {
                  history.back();
              }
            });

          </script>';
      }
    }
  }

  /* ----------------------------- INGRESO USUARIO ---------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                            OLVIDO DE CONTRASEÑA                            */
  /* -------------------------------------------------------------------------- */

  static public function ctrOlvidoPassword($correo)
  {

    if (isset($_POST['passEmail'])) {

      if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST['passEmail'])) {

        /* -------------------------------------------------------------------------- */
        /*                        GENERAR CONTRASEÑA ALEATORIA                        */
        /* -------------------------------------------------------------------------- */

        function generarPassword($longitud)
        {

          $key = '';
          $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
          $max = strlen($pattern) - 1;

          for ($i = 0; $i < $longitud; $i++) {
            $key .= $pattern[mt_rand(0, $max)];
          }

          return $key;
        }

        $nuevaPassword = generarPassword(11);
        $encriptar = crypt($nuevaPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
        $tabla = 'usuarios';
        $item1 = 'email';
        $valor1 = $_POST['passEmail'];
        $respuesta1 = ModeloUsuario::mdlMostrarUsuario($tabla, $item1, $valor1);

        if ($respuesta1) {

          $id = $respuesta1['id'];
          $item2 = 'password';
          $valor2 = $encriptar;
          $respuesta2 = ModeloUsuario::mdlActualizarUsuario($tabla, $id, $item2, $valor2);

          if ($respuesta2  == 'ok') {

            /* -------------------------------------------------------------------------- */
            /*                            CAMBIO DE CONTRASEÑA                            */
            /* -------------------------------------------------------------------------- */

            date_default_timezone_set('America/Mexico_City');
            $url = Ruta::ctrRuta();
            $mail = new PHPMailer;
            $mail->CharSet = 'UTF-8';
            $mail->isMail();
            $mail->setFrom($correo, '');
            $mail->addReplyTo($correo, '');
            $mail->Subject = "Por favor verifique su dirección de correo electrónico";
            $mail->addAddress($_POST["regEmail"]);
            $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
                <center>
                  <img style="padding:20px; width:10%" src="http://tutorialesatualcance.com/tienda/logo.png">
                </center>

                <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                  <center>
                    <img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-pass.png">
                    <h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>
                    <hr style="border:1px solid #ccc; width:80%">
                    <h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>' . $nuevaPassword . '</h4>
                    <a href="' . $url . '" target="_blank" style="text-decoration:none">
                      <div style="line-height:60px; background:#0aa; width:60%; color:white">Ingrese nuevamente al sitio</div>
                    </a>
                    <br>
                    <hr style="border:1px solid #ccc; width:80%">
                    <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
                  </center>
                </div>
              </div>');

            $envio = $mail->Send();

            if (!$envio) {

              echo '<script>

                Swal.fire({
                    title: "¡ERROR!",
                    text: "Ha ocurrido un problema enviando cambio de contraseña a ' . $_POST["passEmail"] . $mail->ErrorInfo . '",
                    icon: "error",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                  })
                  .then((isConfirm) => {
                    if (isConfirm) {
                        window.location.href = "' . $url . '"recuperar-password
                    }
                  });

                </script>';
            } else {

              echo '<script>

                Swal.fire({
                    title: "¡OK!",
                    text: "Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico ' . $_POST["passEmail"] . ' para su cambio de contraseña",
                    icon: "success",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                  })
                  .then((isConfirm) => {
                    if (isConfirm) {
                        window.location.href = "' . $url . '"login
                    }
                  });

                </script>';
            }

            /* ----------------------- End of CAMBIO DE CONTRASEÑA ---------------------- */
          }
        } else {

          echo '<script>

            Swal.fire({
                title: "¡ERROR!",
                text: "Ha ocurrido un problema enviando cambio de contraseña a ' . $_POST["passEmail"]
            // . $mail->ErrorInfo 
            . '",
                icon: "error",
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
              })
              .then((isConfirm) => {
                if (isConfirm) {
                    history.back();
                }
              });

            </script>';
        }

        /* ------------------- End of GENERAR CONTRASEÑA ALEATORIA ------------------ */
      } else {

        echo '<script>

        Swal.fire({
            title: "¡ERROR!",
            text: "Error al enviar el correo electrónico, está mal escrito",
            icon: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false
          })
          .then((isConfirm) => {
            if (isConfirm) {
                history.back();
            }
          });

        </script>';
      }
    }
  }

  /* -------------------------- OLVIDO DE CONTRASEÑA -------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              ACTUALIZAR PERFIL                             */
  /* -------------------------------------------------------------------------- */

  static public function ctrActualizarPerfil()
  {

    if (isset($_POST['editarNombre'])) {

      /* -------------------------------------------------------------------------- */
      /*                               VALIDAR IMAGEN                               */
      /* -------------------------------------------------------------------------- */

      $ruta = $_POST['fotoUsuario'];

      if (isset($_FILES['datosImagen']['tmp_name']) && !empty($_FILES['datosImagen']['tmp_name'])) {

        /* -------------------------------------------------------------------------- */
        /*                 PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD                 */
        /* -------------------------------------------------------------------------- */

        $directorio = 'vistas/img/usuarios/' . $_POST['idUsuario'];

        if (!empty($_POST['fotoUsuario'])) {
          unlink($_POST['fotoUsuario']);
        } else {
          mkdir($directorio, 0755);
        }

        /* ------------ End of PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD ----------- */

        /* -------------------------------------------------------------------------- */
        /*                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO                    */
        /* -------------------------------------------------------------------------- */

        list($ancho, $alto) = getimagesize($_FILES['datosImagen']['tmp_name']);

        $nuevoAncho = 500;
        $nuevoAlto = 500;

        $aleatorio = mt_rand(100, 999);

        if ($_FILES['datosImagen']['type'] == 'image/jpeg') {
          $ruta = 'vistas/img/usuarios/' . $_POST['idUsuario'] . '/' . $aleatorio . '.jpg';

          /* --------------- End of GUARDAMOS LA IMAGEN EN EL DIRECTORIO -------------- */

          /* -------------------------------------------------------------------------- */
          /*                         MOFICAMOS TAMAÑO DE LA FOTO                        */
          /* -------------------------------------------------------------------------- */

          $origen = imagecreatefromjpeg($_FILES['datosImagen']['tmp_name']);
          $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
          imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
          imagejpeg($destino, $ruta);

          /* ------------------- End of MOFICAMOS TAMAÑO DE LA FOTO ------------------- */
        }

        if ($_FILES['datosImagen']['type'] == 'image/png') {

          $ruta = 'vistas/img/usuarios/' . $_POST['idUsuario'] . '/' . $aleatorio . '.png';

          /* -------------------------------------------------------------------------- */
          /*                         MOFICAMOS TAMAÑO DE LA FOTO                        */
          /* -------------------------------------------------------------------------- */

          $origen = imagecreatefrompng($_FILES['datosImagen']['tmp_name']);
          $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
          imagealphablending($destino, FALSE);
          imagesavealpha($destino, TRUE);
          imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
          imagepng($destino, $ruta);
        }
      }

      /* -------------------------- End of VALIDAR IMAGEN ------------------------- */

      if ($_POST['editarPassword'] == '') {
        $password = $_POST['passUsuario'];
      } else {
        $password = crypt($_POST['editarPassword'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
      }

      $datos = array(
        'nombre' => $_POST['editarNombre'],
        'email' => $_POST['editarEmail'],
        'password' => $password,
        'foto' => $ruta,
        'id' => $_POST['idUsuario']
      );

      $tabla = 'usuarios';

      $respuesta = ModeloUsuario::mdlActualizarPerfil($tabla, $datos);

      if ($respuesta == 'ok') {

        $_SESSION['validarSesion'] = 'ok';
        $_SESSION['id'] = $datos['id'];
        $_SESSION['nombre'] = $datos['nombre'];
        $_SESSION['foto'] = $datos['foto'];
        $_SESSION['email'] = $datos['email'];
        $_SESSION['password'] = $datos['password'];
        $_SESSION['modo'] = $_POST['modoUsuario'];

        echo '<script>

            Swal.fire({
              title: "¡OK!",
              text: "Su cuenta ha sido actualizada correctamente",
              icon: "success",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
            })
            .then((isConfirm) => {
              if (isConfirm) {
                history.back();
              }
            });

        </script>';
      }
    }
  }

  /* ------------------------ End of ACTUALIZAR PERFIL ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                               MOSTRAR COMPRAS                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarCompras($item, $valor)
  {

    $tabla = 'compras';
    $respuesta = ModeloUsuario::mdlMostrarCompras($tabla, $item, $valor);
    return $respuesta;
  }

  /* ------------------------- End of MOSTRAR COMPRAS ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                          AGREGAR A LISTA DE DESEOS                         */
  /* -------------------------------------------------------------------------- */

  static public function ctrAgregarDeseo($datos)
  {
    $tabla = 'deseos';
    $respuesta = ModeloUsuario::mdlAgregarDeseo($tabla, $datos);
    return $respuesta;
  }

  /* -------------------- End of AGREGAR A LISTA DE DESEOS -------------------- */

  /* -------------------------------------------------------------------------- */
  /*                           MOSTRAR LISTA DE DESEOS                          */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarDeseos($item)
  {
    $tabla = 'deseos';
    $respuesta = ModeloUsuario::mdlMostrarDeseos($tabla, $item);
    return $respuesta;
  }

  /* --------------------- End of MOSTRAR LISTA DE DESEOS --------------------- */

  /* -------------------------------------------------------------------------- */
  /*                     QUITAR PRODUCTO DE LISTA DE DESEOS                     */
  /* -------------------------------------------------------------------------- */

  static public function ctrQuitarDeseo($datos)
  {
    $tabla = 'deseos';
    $respuesta = ModeloUsuario::mdlQuitarDeseo($tabla, $datos);
    return $respuesta;
  }

  /* ---------------- End of QUITAR PRODUCTO DE LISTA DE DESEOS --------------- */

  /* -------------------------------------------------------------------------- */
  /*                              ELIMINAR USUARIO                              */
  /* -------------------------------------------------------------------------- */

  static public function ctrEliminarUsuario()
  {

    if (isset($_GET['id'])) {

      $tabla1 = 'usuarios';
      $tabla2 = 'comentarios';
      $tabla3 = 'compras';
      $tabla4 = 'deseos';
      $id = $_GET['id'];

      if ($_GET['foto'] != '') {
        unlink($_GET['foto']);
        rmdir('vistas/img/usuarios/' . $_GET['id']);
      }

      $respuesta = ModeloUsuario::mdlEliminarUsuario($tabla1, $id);
      ModeloUsuario::mdlEliminarCompras($tabla3, $id);
      ModeloUsuario::mdlEliminarListaDeseos($tabla4, $id);

      if ($respuesta == 'ok') {

        $url = Ruta::ctrRuta();

        echo '<script>

            Swal.fire({
              title: "¡SU CUENTA HA SIDO BORRADA!",
              text: "Debe registrarse nuevamente si desea ingresar",
              icon: "success",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
            })
            .then((isConfirm) => {
              if (isConfirm) {
                window.location = "' . $url . 'salir";
              }
            });

            </script>';
      }
    }
  }

  /* ------------------------- End of ELIMINAR USUARIO ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                           FORMULARIO CONTACTENOS                           */
  /* -------------------------------------------------------------------------- */

  static public function ctrFormularioContactenos($correo)
  {

    if (isset($_POST['mensajeContactenos'])) {

      if (
        preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreContactenos"]) &&
        preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["mensajeContactenos"]) &&
        preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailContactenos"])
      ) {

        /* -------------------------------------------------------------------------- */
        /*                          ENVÍO CORREO ELECTRÓNICO                          */
        /* -------------------------------------------------------------------------- */

        $url = Ruta::ctrRuta();
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->isMail();
        $mail->setFrom($_POST["emailContactenos"], '');
        $mail->addReplyTo($_POST["emailContactenos"], '');
        $mail->Subject = "Solicitud de nueva contraseña";
        $mail->addAddress($correo);
        $mail->msgHTML('
						<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
						<center><img style="padding:20px; width:10%" src="http://www.tutorialesatualcance.com/tienda/logo.png"></center>
						<div style="position:relative; margin:auto; width:600px; background:white; padding-bottom:20px">
							<center>
							<img style="padding-top:20px; width:15%" src="http://www.tutorialesatualcance.com/tienda/icon-email.png">
							<h3 style="font-weight:100; color:#999;">HA RECIBIDO UNA CONSULTA</h3>
							<hr style="width:80%; border:1px solid #ccc">
							<h4 style="font-weight:100; color:#999; padding:0px 20px; text-transform:uppercase">' . $_POST["nombreContactenos"] . '</h4>
							<h4 style="font-weight:100; color:#999; padding:0px 20px;">De: ' . $_POST["emailContactenos"] . '</h4>
							<h4 style="font-weight:100; color:#999; padding:0px 20px">' . $_POST["mensajeContactenos"] . '</h4>
							<hr style="width:80%; border:1px solid #ccc">
							</center>
						</div>
					</div>');

        $envio = $mail->Send();

        if (!$envio) {

          echo '<script>

            Swal.fire({
              title: "¡ERROR!",
              text: "Ha ocurrido un problema enviando el mensaje",
              icon: "error",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
            })
            .then((isConfirm) => {
              if (isConfirm) {
                history.back();
              }
            });

						</script>';
        } else {

          echo '<script>

            Swal.fire({
              title: "¡OK!",
              text: "Su mensaje ha sido enviado, muy pronto le responderemos",
              icon: "success",
              confirmButtonText: "Cerrar",
              closeOnConfirm: false
            })
            .then((isConfirm) => {
              if (isConfirm) {
                history.back();
              }
            });

						</script>';
        }

        /* --------------------- End of ENVÍO CORREO ELECTRÓNICO -------------------- */
      }
    }
  }

  /* ---------------------- End of FORMULARIO CONTACTENOS --------------------- */
}
