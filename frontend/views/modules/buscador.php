<?php

if (isset($rutas[1])) {
  if (isset($rutas[2])) {
    if ($rutas[2] == 'antiguos') {
      $modo = 'ASC';
      $_SESSION['ordenar'] = 'ASC';
    } else {
      $modo = 'DESC';
      $_SESSION['ordenar'] = 'DESC';
    }
  } else {
    $modo = $_SESSION['ordenar'];
  }

  $base = ($rutas[1] - 1) * 16;
  $tope = 16;
} else {
  $rutas[1] = 1;
  $modo = 'DESC';
  $base = 0;
  $tope = 16;
}

/* -------------------------------------------------------------------------- */
/*                      LLAMADO DE PRODUCTOS POR BÚSQUEDA                     */
/* -------------------------------------------------------------------------- */

$productos = null;
$listaProductos = null;
$ordenar = 'id';

if (isset($rutas[2])) {
  $busqueda = $rutas[2];
  $productos = ControladorProductos::ctrBuscarProductos($busqueda, $ordenar, $modo, $base, $tope);
  $listaProductos = ControladorProductos::ctrListarProductosBusqueda($busqueda);
}
/* -------------------- LLAMADO DE PRODUCTOS POR BÚSQUEDA ------------------- */

?>
<!-- Product -->
<div class="bg0 m-t-23 p-b-140" style="margin-top: 80px;">
  <div class="container">
    <div class="flex-w flex-sb-m p-b-52">
      <div class="flex-w flex-l-m filter-tope-group m-tb-10">
      </div>

      <div class="flex-w flex-c-m m-tb-10">
        <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter" style="padding: 10px;">
          <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
          <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
          Categorias
        </div>
      </div>

      <!-- Search product -->
      <div class="dis-none panel-search w-full p-t-10 p-b-15">
        <div class="bor8 dis-flex p-l-15">
          <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
            <i class="zmdi zmdi-search"></i>
          </button>

          <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
        </div>
      </div>

      <?php
      $item = null;
      $valor = null;

      $categorias = ControladorProductos::ctrMostrarCategorias($item, $valor);
      ?>

      <!-- Filter -->
      <div class="dis-none panel-filter w-full p-t-10">
        <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
          <?php foreach ($categorias as $key => $value) : ?>
            <?php if ($value['estado'] != 0) : ?>
              <div class="filter-col1 p-r-15 p-b-27">
                <div class="mtext-102 cl2 p-b-15">
                  <a href="<?= $frontend . $value['ruta'] ?>" style="color: black;"><?= $value['categoria'] ?></a>
                </div>

                <ul>
                  <?php $item = 'id_categoria';
                  $valor = $value['id'];
                  $subCategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor); ?>

                  <?php foreach ($subCategorias as $key => $value) : ?>
                    <?php if ($value['estado'] != 0) : ?>
                      <li class="p-b-6">
                        <a href="<?= $frontend . $value['ruta'] ?>" class="filter-link stext-106 trans-04">
                          <?= $value['subcategoria'] ?>
                        </a>
                      </li>
                    <?php endif ?>
                  <?php endforeach ?>
                </ul>
              </div>
            <?php endif ?>
          <?php endforeach ?>
        </div>
      </div>
    </div>

    <div class="row isotope-grid">
      <?php if (!$productos) : ?>
        <?php $estado = 0; ?>
        <div class="col-12 error404 text-center">
          <h1><small>¡Oops!</small></h1>
          <h2>Aún no hay productos en esta sección</h2>
        </div>
      <?php else : ?>
        <?php $estado = 1; ?>
        <?php foreach ($productos as $key => $value) : ?>
          <?php if ($value['estado'] != 0) : ?>
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
              <!-- Block2 -->
              <div class="block2">
                <div class="block2-pic hov-img0">
                  <img src="<?= $backend . $value['portada'] ?>" alt="<?= $value['titulo'] ?>">

                  <a href="<?= $frontend . $value['ruta'] ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                    Ver Producto
                  </a>
                </div>

                <div class="block2-txt flex-w flex-t p-t-14">
                  <div class="block2-txt-child1 flex-col-l ">
                    <a href="<?= $frontend . $value['ruta'] ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                      <?= $value['titulo'] ?>
                    </a>

                    <span class="stext-105 cl3">
                      <?php if ($value['precio'] != 0) : ?>
                        <?php if ($value['oferta'] == 0) : ?>
                          $<?= number_format($value['precio'], 2) ?> <?= $divisa ?>
                        <?php else : ?>
                          $<?= number_format($value['precioOferta'], 2) ?> <?= $divisa ?>
                        <?php endif ?>
                      <?php else : ?>
                        GRATIS
                      <?php endif ?>
                    </span>
                  </div>

                  <div class="block2-txt-child2 flex-r p-t-3">
                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                      <img class="icon-heart1 dis-block trans-04" src="<?= $backend ?>views/images/icons/icon-heart-01.png" alt="ICON">
                      <img class="icon-heart2 dis-block trans-04 ab-t-l" src="<?= $backend ?>views/images/icons/icon-heart-02.png" alt="ICON">
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php else : ?>
            <?php $estado = 0; ?>
          <?php endif ?>
        <?php endforeach ?>
      <?php endif ?>
    </div>

    <div class="flex-c-m flex-w w-full p-t-45">
      <?php if ($estado != 0) : ?>
        <?php if (count($listaProductos) != 0) : ?>
          <?php $pagProductos = ceil(count($listaProductos) / 16); ?>

          <?php if ($pagProductos > 4) : ?>
            <?php if ($rutas[1] == 1) : ?>
              <!-- -------------------------------------------------------------------------- */
              /*            LOS BOTONES DE LAS PRIMERAS 4 PÁGINAS Y LA ÚLTIMA PÁG           */
              /* -------------------------------------------------------------------------- -->
              <ul class="pagination modal-3">
                <?php for ($i = 1; $i <= 4; $i++) : ?>
                  <li><a id="item<?= $i ?>" href="<?= $frontend . $rutas[0] . '/' . $i . '/' . $rutas[2] ?>"><?= $i ?></a></li>
                <?php endfor ?>
                <li><a class="disabled">...</a></li>
                <li><a id="item<?= $pagProductos ?>" href="<?= $frontend . $rutas[0] . '/' . $pagProductos . '/' . $rutas[2] ?>"><?= $pagProductos ?></a></li>
                <li><a href="<?= $frontend . $rutas[0] . '/2/' . $rutas[2] ?>" class="next">&raquo;</a></li>
              </ul>
              <!-- ---------- LOS BOTONES DE LAS PRIMERAS 4 PÁGINAS Y LA ÚLTIMA PÁG --------- -->

            <?php elseif (
              $rutas[1] != $pagProductos &&
              $rutas[1] != 1 &&
              $rutas[1] <  ($pagProductos / 2) &&
              $rutas[1] < ($pagProductos - 3)
            ) : ?>
              <!-- -------------------------------------------------------------------------- */
              /*               LOS BOTONES DE LA MITAD DE PÁGINAS HACIA ABAJO               */
              /* -------------------------------------------------------------------------- -->

              <?php $numPagActual = $rutas[1]; ?>
              <ul class="pagination modal-3">
                <li><a href="<?= $frontend . $rutas[0] . '/' . ($numPagActual - 1) . '/' . $rutas[2] ?>" class="prev">&laquo</a></li>

                <?php for ($i = $numPagActual; $i <= ($numPagActual + 3); $i++) : ?>
                  <li><a id="item<?= $i ?>" href="<?= $frontend . $rutas[0] . '/' . $i . '/' . $rutas[2] ?>"><?= $i ?></a></li>
                <?php endfor ?>

                <li><a class="disabled">...</a></li>
                <li><a id="item<?= $pagProductos ?>" href="<?= $frontend . $rutas[0] . '/' . $pagProductos . '/' . $rutas[2] ?>"><?= $pagProductos ?></a></li>
                <li><a href="<?= $frontend . $rutas[0] . '/' . ($numPagActual + 1) . '/' . $rutas[2] ?>" class="next">&raquo;</a></li>
              </ul>

              <!-- ------------- LOS BOTONES DE LA MITAD DE PÁGINAS HACIA ABAJO ------------- -->

            <?php elseif (
              $rutas[1] != $pagProductos &&
              $rutas[1] != 1 &&
              $rutas[1] >=  ($pagProductos / 2) &&
              $rutas[1] < ($pagProductos - 3)
            ) : ?>

              <!-- -------------------------------------------------------------------------- */
            /*               LOS BOTONES DE LA MITAD DE PÁGINAS HACIA ARRIBA              */
            /* -------------------------------------------------------------------------- -->

              <?php $numPagActual = $rutas[1]; ?>

              <ul class="pagination modal-3">
                <li><a href="<?= $frontend . $rutas[0] . '/' . ($numPagActual - 1) . '/' . $rutas[2] ?>" class="prev">&laquo</a></li>
                <li><a href="<?= $frontend . $rutas[0] . '/1/' . $rutas[2] ?>">1</a></li>
                <li><a class="disabled">...</a></li>

                <?php for ($i = $numPagActual; $i <= ($numPagActual + 3); $i++) : ?>
                  <li><a id="item<?= $i ?>" href="<?= $frontend . $rutas[0] . '/' . $i . '/' . $rutas[2] ?>"><?= $i ?></a></li>
                <?php endfor ?>
                <li><a href="<?= $frontend . $rutas[0] . '/' . ($numPagActual + 1) . '/' . $rutas[2] ?>" class="next">&raquo;</a></li>
              </ul>

              <!-- ------------- LOS BOTONES DE LA MITAD DE PÁGINAS HACIA ARRIBA ------------ -->

            <?php else : ?>

              <!-- -------------------------------------------------------------------------- */
              /*            LOS BOTONES DE LAS ÚLTIMAS 4 PÁGINAS Y LA PRIMERA PÁG           */
              /* -------------------------------------------------------------------------- -->

              <?php $numPagActual = $rutas[1]; ?>

              <ul class="pagination modal-3">
                <li><a href="<?= $frontend . $rutas[0] . '/' . ($numPagActual - 1) . '/' . $rutas[2] ?>" class="prev">&laquo</a></li>
                <li><a href="<?= $frontend . $rutas[0] . '/1/' . $rutas[2] ?>">1</a></li>
                <li><a class="disabled">...</a></li>

                <?php for ($i = ($pagProductos - 3); $i <= $pagProductos; $i++) : ?>
                  <li><a id="item<?= $i ?>" href="<?= $frontend . $rutas[0] . '/' . $i . '/' . $rutas[2] ?>"><?= $i ?></a></li>
                <?php endfor ?>
              </ul>

              <!-- ---------- LOS BOTONES DE LAS ÚLTIMAS 4 PÁGINAS Y LA PRIMERA PÁG --------- -->

            <?php endif ?>
          <?php else : ?>
            <ul class="pagination modal-3">
              <?php for ($i = 1; $i <= $pagProductos; $i++) : ?>
                <li><a id="item<?= $i ?>" href="<?= $frontend . $rutas[0] . '/' . $i . '/' . $rutas[2] ?>"><?= $i ?></a></li>
              <?php endfor ?>
            </ul><br>
          <?php endif ?>
        <?php endif ?>
      <?php endif ?>
    </div>
  </div>
</div>