// alert("usuarios.js esta funcionando correctamente");

/* -------------------------------------------------------------------------- */
/*                               CAPTURA DE RUTA                              */
/* -------------------------------------------------------------------------- */

// let rutaActual = location.href;

// $(".btnIngreso, .facebook, .google").click(function() {
// 	localStorage.setItem("rutaActual", rutaActual);
// })

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

$(".inputCorreo").change(function () {
  let email = $(".inputCorreo").val();
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
      if (respuesta == "false") {
        $(".alert").remove();
        validarEmailRepetido = false;
      } else {
        var modo = JSON.parse(respuesta).modo;

        if (modo == "directo") {
          modo = "esta página";
        }

        $(".inputCorreo")
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

function registroUsuario() {
  /* -------------------------------------------------------------------------- */
  /*                              VALIDAR EL NOMBRE                             */
  /* -------------------------------------------------------------------------- */

  let nombre = $(".inputNombre").val();
  console.log(
    "%cMyProject%cline:79%cnombre",
    "color:#fff;background:#ee6f57;padding:3px;border-radius:2px",
    "color:#fff;background:#1f3c88;padding:3px;border-radius:2px",
    "color:#fff;background:rgb(3, 38, 58);padding:3px;border-radius:2px",
    nombre
  );

  if (nombre != "") {
    let expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;

    if (!expresion.test(nombre)) {
      $(".inputNombre")
        .parent()
        .before(
          '<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten números ni caracteres especiales</div>'
        );

      return false;
    }
  } else {
    $(".inputNombre")
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

  var email = $(".inputCorreo").val();
  console.log(
    "%cMyProject%cline:116%cemail",
    "color:#fff;background:#ee6f57;padding:3px;border-radius:2px",
    "color:#fff;background:#1f3c88;padding:3px;border-radius:2px",
    "color:#fff;background:rgb(153, 80, 84);padding:3px;border-radius:2px",
    email
  );

  if (email != "") {
    var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

    if (!expresion.test(email)) {
      $(".inputCorreo")
        .parent()
        .before(
          '<div class="alert alert-warning"><strong>ERROR:</strong> Escriba correctamente el correo electrónico</div>'
        );

      return false;
    }

    if (validarEmailRepetido) {
      $(".inputCorreo")
        .parent()
        .before(
          '<div class="alert alert-danger"><strong>ERROR:</strong> El correo electrónico ya existe en la base de datos, por favor ingrese otro diferente</div>'
        );

      return false;
    }
  } else {
    $(".inputCorreo")
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

  let password = $(".inputPassword").val();

  if (password != "") {
    let expresion = /^[a-zA-Z0-9]*$/;

    if (!expresion.test(password)) {
      $(".inputPassword")
        .parent()
        .before(
          '<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten caracteres especiales</div>'
        );

      return false;
    }
  } else {
    $(".inputPassword")
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

/* -------------------------------------------------------------------------- */
/*                                CAMBIAR FOTO                                */
/* -------------------------------------------------------------------------- */

// $("#btnCambiarFoto").click(function () {
//   $("#imgPerfil").toggle();
//   $("#subirImagen").toggle();
// });

// $("#datosImagen").change(function () {
//   let imagen = this.files[0];

//   /* -------------------------------------------------------------------------- */
//   /*                      VALIDAMOS EL FORMATO DE LA IMAGEN                     */
//   /* -------------------------------------------------------------------------- */

//   if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
//     $("#datosImagen").val("");

//     swal(
//       {
//         title: "Error al subir la imagen",
//         text: "¡La imagen debe estar en formato JPG o PNG!",
//         type: "error",
//         confirmButtonText: "¡Cerrar!",
//         closeOnConfirm: false,
//       },
//       function (isConfirm) {
//         if (isConfirm) {
//           window.location = rutaOculta + "perfil";
//         }
//       }
//     );
//   } else if (Number(imagen["size"]) > 2000000) {
//     $("#datosImagen").val("");

//     swal(
//       {
//         title: "Error al subir la imagen",
//         text: "¡La imagen no debe pesar más de 2 MB!",
//         type: "error",
//         confirmButtonText: "¡Cerrar!",
//         closeOnConfirm: false,
//       },
//       function (isConfirm) {
//         if (isConfirm) {
//           window.location = rutaOculta + "perfil";
//         }
//       }
//     );
//   } else {
//     var datosImagen = new FileReader();
//     datosImagen.readAsDataURL(imagen);

//     $(datosImagen).on("load", function (event) {
//       var rutaImagen = event.target.result;
//       $(".previsualizar").attr("src", rutaImagen);
//     });
//   }

//   /* -------------------- VALIDAMOS EL FORMATO DE LA IMAGEN ------------------- */
// });

/* ------------------------------ CAMBIAR FOTO ------------------------------ */

/* -------------------------------------------------------------------------- */
/*                               COMENTARIOS ID                               */
/* -------------------------------------------------------------------------- */

// $(".calificarProducto").click(function () {
//   var idComentario = $(this).attr("idComentario");
//   $("#idComentario").val(idComentario);
// });

/* ----------------------------- COMENTARIOS ID ----------------------------- */

/* -------------------------------------------------------------------------- */
/*                       COMENTARIOS CAMBIO DE ESTRELLAS                      */
/* -------------------------------------------------------------------------- */

// $("input[name='puntaje']").change(function () {
//   var puntaje = $(this).val();

//   switch (puntaje) {
//     case "0.5":
//       $("#estrellas").html(
//         '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i>'
//       );
//       break;

//     case "1.0":
//       $("#estrellas").html(
//         '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i>'
//       );
//       break;

//     case "1.5":
//       $("#estrellas").html(
//         '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i>'
//       );
//       break;

//     case "2.0":
//       $("#estrellas").html(
//         '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i>'
//       );
//       break;

//     case "2.5":
//       $("#estrellas").html(
//         '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i>'
//       );
//       break;

//     case "3.0":
//       $("#estrellas").html(
//         '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i>'
//       );
//       break;

//     case "3.5":
//       $("#estrellas").html(
//         '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i>'
//       );
//       break;

//     case "4.0":
//       $("#estrellas").html(
//         '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-o text-success" aria-hidden="true"></i>'
//       );
//       break;

//     case "4.5":
//       $("#estrellas").html(
//         '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>'
//       );
//       break;

//     case "5.0":
//       $("#estrellas").html(
//         '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star text-success" aria-hidden="true"></i> ' +
//           '<i class="fa fa-star text-success" aria-hidden="true"></i>'
//       );
//       break;
//   }
// });

/* --------------------- COMENTARIOS CAMBIO DE ESTRELLAS -------------------- */

/* -------------------------------------------------------------------------- */
/*                            VALIDAR EL COMENTARIO                           */
/* -------------------------------------------------------------------------- */

// function validarComentario() {
//   var comentario = $("#comentario").val();

//   if (comentario != "") {
//     var expresion = /^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;

//     if (!expresion.test(comentario)) {
//       $("#comentario")
//         .parent()
//         .before(
//           '<div class="alert alert-danger"><strong>ERROR:</strong> No se permiten caracteres especiales como por ejemplo !$%&/?¡¿[]*</div>'
//         );

//       return false;
//     }
//   } else {
//     $("#comentario")
//       .parent()
//       .before(
//         '<div class="alert alert-warning"><strong>ERROR:</strong> Campo obligatorio</div>'
//       );

//     return false;
//   }

//   return true;
// }

/* -------------------------- VALIDAR EL COMENTARIO ------------------------- */

/* -------------------------------------------------------------------------- */
/*                               LISTA DE DESEOS                              */
/* -------------------------------------------------------------------------- */

// $(".deseos").click(function () {
//   var idProducto = $(this).attr("idProducto");
//   var idUsuario = localStorage.getItem("usuario");

//   if (idUsuario == null) {
//     swal(
//       {
//         title: "Debe ingresar al sistema",
//         text: "¡Para agregar un producto a la 'lista de deseos' debe primero ingresar al sistema!",
//         type: "warning",
//         confirmButtonText: "¡Cerrar!",
//         closeOnConfirm: true,
//       },
//       function (isConfirm) {
//         if (isConfirm) {
//           //window.location = rutaOculta;
//         }
//       }
//     );
//   } else {
//     $(this).addClass("btn-danger");

//     var datos = new FormData();
//     datos.append("idUsuario", idUsuario);
//     datos.append("idProducto", idProducto);

//     $.ajax({
//       url: rutaOculta + "ajax/usuarios.ajax.php",
//       method: "POST",
//       data: datos,
//       cache: false,
//       contentType: false,
//       processData: false,
//       success: function (respuesta) {
//         if (respuesta == "existe") {
//           swal(
//             {
//               title: "PRODUCTO DUPLICADO",
//               text: "¡Este producto ya se encuentra registrado en la lista de deseos!",
//               type: "warning",
//               confirmButtonText: "¡Cerrar!",
//               closeOnConfirm: true,
//             },
//             function (isConfirm) {
//               if (isConfirm) {
//                 //window.location = rutaOculta;
//               }
//             }
//           );
//         } else if (respuesta == "ok") {
//           swal(
//             {
//               title: "AGREGADO",
//               text: "¡El producto se ha agregado a la lista de deseos!",
//               type: "success",
//               confirmButtonText: "¡Cerrar!",
//               closeOnConfirm: true,
//             },
//             function (isConfirm) {
//               if (isConfirm) {
//                 //window.location = rutaOculta;
//               }
//             }
//           );
//         }
//       },
//     });
//   }
// });

/* ----------------------------- LISTA DE DESEOS ---------------------------- */

/* -------------------------------------------------------------------------- */
/*                    BORRAR PRODUCTO DE LA LISTA DE DESEOS                   */
/* -------------------------------------------------------------------------- */

// $(".quitarDeseo").click(function () {
//   var idDeseo = $(this).attr("idDeseo");

//   $(this).parent().parent().parent().remove();

//   var datos = new FormData();
//   datos.append("idDeseo", idDeseo);

//   $.ajax({
//     url: rutaOculta + "ajax/usuarios.ajax.php",
//     method: "POST",
//     data: datos,
//     cache: false,
//     contentType: false,
//     processData: false,
//     success: function (respuesta) {},
//   });
// });

/* ------------------ BORRAR PRODUCTO DE LA LISTA DE DESEOS ----------------- */
