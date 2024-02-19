/* -------------------------------------------------------------------------- */
/*                                MIGAS DE PAN                                */
/* -------------------------------------------------------------------------- */

let pagActiva = $(".pagActiva").html();

if (pagActiva != null) {
  var regPagActiva = pagActiva.replace(/-/g, " ");
  $(".pagActiva").html(regPagActiva);
}

/* ------------------------------ MIGAS DE PAN ------------------------------ */
