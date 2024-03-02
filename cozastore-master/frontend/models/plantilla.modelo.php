<?php
require_once 'conexion.php';

class ModeloPlantilla
{

  /* -------------------------------------------------------------------------- */
  /*                TRAEMOS LOS ESTILOS DINAMICOS DE LA PLANTILLA               */
  /* -------------------------------------------------------------------------- */

  /* -------------- TRAEMOS LOS ESTILOS DINAMICOS DE LA PLANTILLA ------------- */

  /* -------------------------------------------------------------------------- */
  /*                            TRAEMOS LAS CABECERAS                           */
  /* -------------------------------------------------------------------------- */

  static public function mdlTraerCabeceras($tabla, $ruta)
  {
    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ruta = :ruta");
    $stmt->bindParam(':ruta', $ruta, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch();
    $stmt =  null;
  }

  /* -------------------------- TRAEMOS LAS CABECERAS ------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                       TRAER DIVISA DE MANERA DINAMICA                      */
  /* -------------------------------------------------------------------------- */

  static public function mdlMostrarDivisa($tabla)
  {
    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
    $stmt->execute();
    return $stmt->fetch();
    $stmt =  null;
  }

  /* --------------------- TRAER DIVISA DE MANERA DINAMICA -------------------- */

  /* -------------------------------------------------------------------------- */
  /*                     MOSTRAMOS INFORMACION PARA CONTACTO                    */
  /* -------------------------------------------------------------------------- */

  static public function mdlMostrarContacto($tabla)
  {
    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
    $stmt->execute();
    return $stmt->fetch();
    $stmt = null;
  }

  /* --------------- End of MOSTRAMOS INFORMACION PARA CONTACTO --------------- */

  /* -------------------------------------------------------------------------- */
  /*                       MOSTRAR INFORMACION DEL FOOTER                       */
  /* -------------------------------------------------------------------------- */

  static public function mdlMostrarFotter($tabla)
  {
    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
    $stmt->execute();
    return $stmt->fetch();
    $stmt = null;
  }

  /* --------------------- MOSTRAR INFORMACION DEL FOOTER --------------------- */
}
