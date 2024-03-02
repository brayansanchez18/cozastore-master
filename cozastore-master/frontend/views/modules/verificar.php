<?php
$usuarioVerificado = false;
$item = 'EmailEncriptado';
$valor =  $rutas[1];
$respuesta = ControladorUsuario::ctrMostrarUsuario($item, $valor);

if (is_array($respuesta) && $valor == $respuesta['emailEncriptado']) {
  $id = $respuesta['id'];
  $item2 = 'verificacion';
  $valor2 = 0;
  $respuesta2 = ControladorUsuario::ctrActualizarUsuario($id, $item2, $valor2);

  if ($respuesta2 == 'ok') {
    $usuarioVerificado = true;
  }
}

?>

<div class="container">
  <div class="row">
    <div class="col-12 text-center verificar" style="margin-top: 160px;margin-bottom: 60px;">
      <?php if ($usuarioVerificado) : ?>
        <h3>Gracias</h3>
        <h2><small>¡Hemos verificado su correo electrónico, ya puede ingresar al sistema!</small></h2>
        <br>
        <a href="<?= $frontend ?>login">
          <button class="btn" type="submit" style="background-color: #6c7ae0; color:#fff;">INGRESAR</button>
        </a>
      <?php else : ?>
        <h1>Error</h1>
        <h2><small>¡No se ha podido verificar el correo electrónico, vuelva a registrarse!</small></h2>
        <br>
        <a href="<?= $frontend ?>register">
          <button class="btn" type="submit" style="background-color: #6c7ae0; color:#fff;">REGISTRO</button>
        </a>
      <?php endif ?>
    </div>
  </div>
</div>