<?php

class ControladorPlantilla
{
  /* -------------------------------------------------------------------------- */
  /*                            LLAMAMOS LA PLANTILLA                           */
  /* -------------------------------------------------------------------------- */

  static public function plantilla()
  {
    include 'views/plantilla.php';
  }

  /* -------------------------- LLAMAMOS LA PLANTILLA ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                TRAEMOS LOS ESTILOS DINAMICOS DE LA PLANTILLA               */
  /* -------------------------------------------------------------------------- */
  //TODO: TRAEMOS LOS ESTILOS DINAMICOS DE LA PLANTILLA
  /* -------------- TRAEMOS LOS ESTILOS DINAMICOS DE LA PLANTILLA ------------- */

  /* -------------------------------------------------------------------------- */
  /*                            TRAEMOS LAS CABECERAS                           */
  /* -------------------------------------------------------------------------- */

  static public function ctrTraerCabeceras($ruta)
  {
    $tabla = 'cabeceras';
    $respuesta = ModeloPlantilla::mdlTraerCabeceras($tabla, $ruta);
    return $respuesta;
  }

  /* -------------------------- TRAEMOS LAS CABECERAS ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                       TRAER DIVISA DE MANERA DINAMICA                      */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarDivisa()
  {
    $tabla = 'comercio';
    $respuesta = ModeloPlantilla::mdlMostrarDivisa($tabla);
    return $respuesta;
  }

  /* --------------------- TRAER DIVISA DE MANERA DINAMICA -------------------- */

  /* -------------------------------------------------------------------------- */
  /*                     MOSTRAMOS INFORMACION PARA CONTACTO                    */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarContacto()
  {
    $tabla = 'footer';
    $respuesta = ModeloPlantilla::mdlMostrarContacto($tabla);
    return $respuesta;
  }

  /* --------------- End of MOSTRAMOS INFORMACION PARA CONTACTO --------------- */

  /* -------------------------------------------------------------------------- */
  /*                       MOSTRAR INFORMACION DEL FOOTER                       */
  /* -------------------------------------------------------------------------- */

  static public function ctrMostrarFooter()
  {
    $tabla = 'footer';
    $respuesta = ModeloPlantilla::mdlMostrarFotter($tabla);
    return $respuesta;
  }

  /* --------------------- MOSTRAR INFORMACION DEL FOOTER --------------------- */
}
