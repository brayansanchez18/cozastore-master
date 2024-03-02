<?php
require_once '../controllers/usuarios.controlador.php';
require_once '../models/usuarios.modelo.php';

class AjaxUsuarios
{
  /* -------------------------------------------------------------------------- */
  /*                           VALIDAR EMAIL EXISTENTE                          */
  /* -------------------------------------------------------------------------- */

  public $validarEmail;

  public function ajaxValidarEmail()
  {
    $datos = $this->validarEmail;
    $respuesta = ControladorUsuario::ctrMostrarUsuario('email', $datos);
    echo json_encode($respuesta);
  }

  /* ------------------------- VALIDAR EMAIL EXISTENTE ------------------------ */

  /* -------------------------------------------------------------------------- */
  /*                            REGISTRO CON FACEBOOK                           */
  /* -------------------------------------------------------------------------- */

  public $email;
  public $nombre;
  public $foto;

  public function ajaxRegistroFacebook()
  {
    $datos = [
      'nombre' => $this->nombre,
      'email' => $this->email,
      'foto' => $this->foto,
      'password' => 'null',
      'modo' => 'facebook',
      'verificacion' => 0,
      'emailEncriptado' => 'null'
    ];

    // $respuesta = ControladorUsuario::ctrRegistroRedesSociales($datos);
    // echo $respuesta;
  }

  /* -------------------------- REGISTRO CON FACEBOOK ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                          AGREGAR A LISTA DE DESEOS                         */
  /* -------------------------------------------------------------------------- */

  public $idUsuario;
  public $idProducto;

  public function ajaxAgregarDeseo()
  {
    $datos = [
      'idUsuario' => $this->idUsuario,
      'idProducto' => $this->idProducto
    ];

    $respuesta = ControladorUsuario::ctrAgregarDeseo($datos);
    echo $respuesta;
  }

  /* ------------------------ AGREGAR A LISTA DE DESEOS ----------------------- */

  /* -------------------------------------------------------------------------- */
  /*                     QUITAR PRODUCTO DE LISTA DE DESEOS                     */
  /* -------------------------------------------------------------------------- */

  public $idDeseo;

  public function ajaxQuitarDeseo()
  {
    $datos = $this->idDeseo;
    $respuesta = ControladorUsuario::ctrQuitarDeseo($datos);
    echo $respuesta;
  }

  /* ------------------- QUITAR PRODUCTO DE LISTA DE DESEOS ------------------- */
}

/* -------------------------------------------------------------------------- */
/*                           VALIDAR EMAIL EXISTENTE                          */
/* -------------------------------------------------------------------------- */

if (isset($_POST['validarEmail'])) {
  $valEmail = new AjaxUsuarios();
  $valEmail->validarEmail = $_POST['validarEmail'];
  $valEmail->ajaxValidarEmail();
}

/* ------------------------- VALIDAR EMAIL EXISTENTE ------------------------ */

/* -------------------------------------------------------------------------- */
/*                            REGISTRO CON FACEBOOK                           */
/* -------------------------------------------------------------------------- */

if (isset($_POST['email'])) {
  $regFacebook = new AjaxUsuarios();
  $regFacebook->email = $_POST['email'];
  $regFacebook->nombre = $_POST['nombre'];
  $regFacebook->foto = $_POST['foto'];
  $regFacebook->ajaxRegistroFacebook();
}

/* -------------------------- REGISTRO CON FACEBOOK ------------------------- */

/* -------------------------------------------------------------------------- */
/*                          AGREGAR A LISTA DE DESEOS                         */
/* -------------------------------------------------------------------------- */

if (isset($_POST['idUsuario'])) {
  $deseo = new AjaxUsuarios();
  $deseo->idUsuario = $_POST['idUsuario'];
  $deseo->idProducto = $_POST['idProducto'];
  $deseo->ajaxAgregarDeseo();
}

/* ------------------------ AGREGAR A LISTA DE DESEOS ----------------------- */

/* -------------------------------------------------------------------------- */
/*                     QUITAR PRODUCTO DE LISTA DE DESEOS                     */
/* -------------------------------------------------------------------------- */

if (isset($_POST['idDeseo'])) {
  $quitarDeseo = new AjaxUsuarios();
  $quitarDeseo->idDeseo = $_POST['idDeseo'];
  $quitarDeseo->ajaxQuitarDeseo();
}

/* ------------------- QUITAR PRODUCTO DE LISTA DE DESEOS ------------------- */