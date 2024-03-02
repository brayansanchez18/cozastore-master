<?php
$ordenar = 'vistas';
$item = 'estado';
$valor = 1;
$modo = ',Rand()';
$base = 0;
$tope = 16;
$vistas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo); ?>
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
      <?php foreach ($vistas as $key => $value) : ?>
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item value-<?= $value['id_categoria'] ?>">
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
      <?php endforeach ?>
    </div>
  </div>
</div>