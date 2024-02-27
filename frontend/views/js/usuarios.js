/* -------------------------------------------------------------------------- */
/*                               CAPTURA DE RUTA                              */
/* -------------------------------------------------------------------------- */

// let rutaActual = location.href;
// $(".btnIngreso, .facebook, .google").click(function () {
//   localStorage.setItem("rutaActual", rutaActual);
// });

/* ----------------------------- CAPTURA DE RUTA ---------------------------- */

/* -------------------------------------------------------------------------- */
/*                             FORMATEAR LOS IPUNT                            */
/* -------------------------------------------------------------------------- */

$("input").focus(function () {
  $(".alert").remove();
});

/* --------------------------- FORMATEAR LOS IPUNT -------------------------- */

/* -------------------------------------------------------------------------- */
/*                           VALIDAR EMAIL REPETIDO                           */
/* -------------------------------------------------------------------------- */

let validarEmailRepetido = false;

$("#regEmail").change(function () {
  let email = $("#regEmail").val();
  let datos = new FormData();

  datos.append("validarEmail", email);

  $.ajax({
    url: rutaOculta + "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      console.log(
        "%cMyProject%cline:41%crespuesta",
        "color:#fff;background:#ee6f57;padding:3px;border-radius:2px",
        "color:#fff;background:#1f3c88;padding:3px;border-radius:2px",
        "color:#fff;background:rgb(1, 77, 103);padding:3px;border-radius:2px",
        respuesta
      );
      if (respuesta == "false") {
        $(".alert").remove();
        validarEmailRepetido = false;
      } else {
        var modo = JSON.parse(respuesta).modo;

        if (modo == "directo") {
          modo = "esta página";
        }

        $("#regEmail")
          .parent()
          .before(
            '<div class="alert alert-warning"><strong>ERROR:</strong> El correo electrónico ya existe en la base de datos, fue registrado a través de ' +
              modo +
              ", por favor ingrese otro diferente</div>"
          );

        validarEmailRepetido = true;
      }
    },
  });
});

/* ------------------------- VALIDAR EMAIL REPETIDO ------------------------- */

/* -------------------------------------------------------------------------- */
/*                       VALIDAR EL REGISTRO DE USUARIO                       */
/* -------------------------------------------------------------------------- */

function registroUsuario1() {
  /* -------------------------------------------------------------------------- */
  /*                              VALIDAR EL NOMBRE                             */
  /* -------------------------------------------------------------------------- */

  let nombre = $("#regUsuario").val();

  if (nombre != "") {
    let expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;

    if (!expresion.test(nombre)) {
      $("#regUsuario")
        .parent()
        .before(
          '<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten números ni caracteres especiales</div>'
        );

      return false;
    }
  } else {
    $("#regUsuario")
      .parent()
      .before(
        '<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>'
      );

    return false;
  }

  /* ---------------------------- VALIDAR EL NOMBRE --------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                              VALIDAR EL EMAIL                              */
  /* -------------------------------------------------------------------------- */

  let email = $("#regEmail").val();

  if (email != "") {
    let expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

    if (!expresion.test(email)) {
      $("#regEmail")
        .parent()
        .before(
          '<div class="alert alert-warning"><strong>ERROR:</strong> Escriba correctamente el correo electrónico</div>'
        );

      return false;
    }

    if (validarEmailRepetido) {
      $("#regEmail")
        .parent()
        .before(
          '<div class="alert alert-danger"><strong>ERROR:</strong> El correo electrónico ya existe en la base de datos, por favor ingrese otro diferente</div>'
        );

      return false;
    }
  } else {
    $("#regEmail")
      .parent()
      .before(
        '<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>'
      );

    return false;
  }

  /* ---------------------------- VALIDAR EL EMAIL ---------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                             VALIDAR CONTRASEÑA                             */
  /* -------------------------------------------------------------------------- */

  let password = $("#regPassword").val();

  if (password != "") {
    let expresion = /^[a-zA-Z0-9]*$/;

    if (!expresion.test(password)) {
      $("#regPassword")
        .parent()
        .before(
          '<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten caracteres especiales</div>'
        );

      return false;
    }
  } else {
    $("#regPassword")
      .parent()
      .before(
        '<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>'
      );

    return false;
  }

  /* --------------------------- VALIDAR CONTRASEÑA --------------------------- */

  /* -------------------------------------------------------------------------- */
  /*                       VALIDAR POLÍTICAS DE PRIVACIDAD                      */
  /* -------------------------------------------------------------------------- */

  // let politicas = $("#regPoliticas:checked").val();

  // if (politicas != "on") {
  //   $("#regPoliticas")
  //     .parent()
  //     .before(
  //       '<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Debe aceptar nuestras condiciones de uso y políticas de privacidad</div>'
  //     );

  //   return false;
  // }

  // return true;

  /* --------------------- VALIDAR POLÍTICAS DE PRIVACIDAD -------------------- */
}

/* --------------------- VALIDAR EL REGISTRO DE USUARIO --------------------- */
