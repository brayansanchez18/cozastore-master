var rutaOculta = $("#rutaOculta").val();

/* -------------------------------------------------------------------------- */
/*                                MIGAS DE PAN                                */
/* -------------------------------------------------------------------------- */

let pagActiva = $(".pagActiva").html();

if (pagActiva != null) {
  var regPagActiva = pagActiva.replace(/-/g, " ");
  $(".pagActiva").html(regPagActiva);
}

/* ------------------------------ MIGAS DE PAN ------------------------------ */

/* -------------------------------------------------------------------------- */
/*                             ENLACES PAGINACION                             */
/* -------------------------------------------------------------------------- */

let url = window.location.href;
let indice = url.split("/");
let pagActual = indice[7];

if (isNaN(pagActual)) {
  $("#item1").addClass("active");
} else {
  $("#item" + pagActual).addClass("active");
}

/* --------------------------- ENLACES PAGINACION --------------------------- */
