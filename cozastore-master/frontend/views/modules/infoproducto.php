<?php
$item = 'ruta';
$valor = $rutas[0];
$infoproducto = ControladorProductos::ctrMostrarInfoproducto($item, $valor);
$multimedia = json_decode($infoproducto['multimedia'], true); ?>

<?php $item_relacionados = 'id';
$valor_relacinoados = $infoproducto['id_subcategoria'];
$rutaDestacados = ControladorProductos::ctrMostrarSubCategorias($item_relacionados, $valor_relacinoados);
// var_dump($rutaDestacados[0]['id_categoria']);
$categoria_infoProductos = ControladorProductos::ctrMostrarCategorias('id', $rutaDestacados[0]['id_categoria']);
// var_dump($categoria_infoProductos['categoria']);
?>

<!-- breadcrumb -->
<div class="container" style="margin-top: 80px;">
  <div class=" bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
    <a href="<?= $frontend ?>" class="stext-109 cl8 hov-cl1 trans-04">
      INICIO
      <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
    </a>

    <a href="<?= $categoria_infoProductos['ruta'] ?>" target="_blank" class="stext-109 cl8 hov-cl1 trans-04">
      <?= $categoria_infoProductos['categoria'] ?>
      <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
    </a>

    <span class="stext-109 cl4 pagActiva text-uppercase">
      <?= $infoproducto['titulo'] ?>
    </span>
  </div>
</div>


<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-7 p-b-30">
        <div class="p-l-25 p-r-30 p-lr-0-lg">
          <div class="wrap-slick3 flex-sb flex-w">
            <div class="wrap-slick3-dots"></div>
            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

            <?php if ($multimedia != null) : ?>
              <div class="slick3 gallery-lb">
                <?php for ($i = 0; $i < count($multimedia); $i++) : ?>
                  <div class="item-slick3" data-thumb="<?= $backend . $multimedia[$i]['foto'] ?>">
                    <div class="wrap-pic-w pos-relative">
                      <img src="<?= $backend . $multimedia[$i]['foto'] ?>" alt="IMG-PRODUCT">

                      <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?= $backend . $multimedia[$i]['foto'] ?>">
                        <i class="fa fa-expand"></i>
                      </a>
                    </div>
                  </div>
                <?php endfor ?>
              </div>
            <?php endif ?>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-5 p-b-30">
        <div class="p-r-50 p-t-5 p-lr-0-lg">
          <h4 class="mtext-105 cl2 js-name-detail p-b-14">
            <?= $infoproducto['titulo'] ?>
            <span style="font-size: 15px;">
              (<?= ($infoproducto['stock'] != 0) ? $infoproducto['stock'] : 'Sin ' ?> Unidades)
            </span>
          </h4>

          <?php if ($infoproducto['precio'] != 0) : ?>
            <?php if ($infoproducto['oferta'] == 0) : ?>
              <span class="mtext-106 cl2">
                $<?= number_format($infoproducto['precio'], 2) ?> <?= $divisa ?>
              </span>
            <?php else : ?>
              <span class="mtext-106 cl2">
                <del class="font-italic mr-2">$<?= number_format($infoproducto['precio'], 2) ?></del> $<?= number_format($infoproducto['precioOferta'], 2) ?> <?= $divisa ?>
              </span>
            <?php endif ?>
          <?php else : ?>
            <span class="mtext-106 cl2">
              GRATIS
            </span>
          <?php endif ?>


          <p class="stext-102 cl3 p-t-23">
            <?= $infoproducto['titular'] ?>
          </p>

          <!--  -->

          <?php if ($infoproducto['stock'] != 0) : ?>
            <?php if ($infoproducto['detalles'] != null) : ?>
              <?php $detalles = json_decode($infoproducto['detalles'], true); ?>
              <?php if ($infoproducto['tipo'] == 'fisico') : ?>
                <div class="p-t-33">
                  <?php if ($detalles['Talla'] != null) : ?>
                    <div class="flex-w flex-r-m p-b-10">
                      <div class="size-203 flex-c-m respon6">
                        Talla
                      </div>

                      <div class="size-204 respon6-next">
                        <div class="rs1-select2 bor8 bg0">
                          <select class="js-select2 seleccionarDetalle" id="seleccionarTalla">
                            <option value="">Elige una opcion</option>
                            <?php for ($i = 0; $i < count($detalles["Talla"]); $i++) : ?>
                              <option value="<?= $detalles['Talla'][$i] ?>"><?= $detalles['Talla'][$i] ?></option>
                            <?php endfor ?>
                          </select>
                          <div class="dropDownSelect2"></div>
                        </div>
                      </div>
                    </div>
                  <?php endif ?>

                  <?php if ($detalles['Color'] != null) : ?>
                    <div class="flex-w flex-r-m p-b-10">
                      <div class="size-203 flex-c-m respon6">
                        Color
                      </div>

                      <div class="size-204 respon6-next">
                        <div class="rs1-select2 bor8 bg0">
                          <select class="js-select2 seleccionarDetalle" id="seleccionarColor">
                            <option value="">Elige una opcion</option>
                            <?php for ($i = 0; $i < count($detalles['Color']); $i++) : ?>
                              <option value="<?= $detalles['Color'][$i] ?>"><?= $detalles['Color'][$i] ?></option>
                            <?php endfor ?>
                          </select>
                          <div class="dropDownSelect2"></div>
                        </div>
                      </div>
                    </div>
                  <?php endif ?>

                  <?php if ($detalles['Marca'] != null) : ?>
                    <div class="flex-w flex-r-m p-b-10">
                      <div class="size-203 flex-c-m respon6">
                        Marca
                      </div>

                      <div class="size-204 respon6-next">
                        <div class="rs1-select2 bor8 bg0">
                          <select class="js-select2" name="time">
                            <option value="">Elige una opcion</option>
                            <?php for ($i = 0; $i < count($detalles['Marca']); $i++) : ?>
                              <option value="<?= $detalles['Marca'][$i] ?>"><?= $detalles['Marca'][$i] ?></option>
                            <?php endfor ?>
                          </select>
                          <div class="dropDownSelect2"></div>
                        </div>
                      </div>
                    </div>
                  <?php endif ?>

                  <div class="flex-w flex-r-m p-b-10">
                    <div class="size-204 flex-w flex-m respon6-next">
                      <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                        Agregar al Carrito
                      </button>
                    </div>
                  </div>
                </div>
              <?php endif ?>
            <?php endif ?>
          <?php else : ?>
            <div class="p-t-33">
              <div class="flex-w flex-r-m p-b-10">
                <div class="size-204 flex-w flex-m respon6-next">
                  <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                    Agregar a Favoritos
                  </button>
                </div>
              </div>
            </div>
          <?php endif ?>

          <!--  -->
          <div class="flex-w flex-m p-l-100 p-t-40 respon7">
            <?php if ($infoproducto['stock'] != 0) : ?>
              <div class="flex-m bor9 p-r-10 m-r-11">
                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Agregar a Lista de Deseos">
                  <i class="zmdi zmdi-favorite"></i>
                </a>
              </div>
            <?php endif ?>

            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Compartir en Facebook">
              <i class="fa fa-facebook"></i>
            </a>

            <!-- <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
              <i class="fa fa-twitter"></i>
            </a> -->
          </div>
        </div>
      </div>
    </div>

    <div class="bor10 m-t-50 p-t-43 p-b-40">
      <!-- Tab01 -->
      <div class="tab01">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item p-b-10">
            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Descripción</a>
          </li>


          <li class="nav-item p-b-10">
            <a class="nav-link" data-toggle="tab" href="#information" role="tab">Información adicional</a>
          </li>

          <li class="nav-item p-b-10">
            <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reseñas (1)</a>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content p-t-43">
          <!-- - -->
          <div class="tab-pane fade show active" id="description" role="tabpanel">
            <div class="how-pos2 p-lr-15-md">
              <p class="stext-102 cl6">
                <?= $infoproducto['descripcion'] ?>
              </p>
            </div>
          </div>

          <!-- - -->
          <div class="tab-pane fade" id="information" role="tabpanel">
            <div class="row">
              <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                <ul class="p-lr-28 p-lr-15-sm">
                  <?php if ($infoproducto['tipo'] != 'fisico') : ?>
                    <li class="flex-w flex-t p-b-7">
                      <span class="stext-102 cl3 size-205">
                        Marca
                      </span>

                      <span class="stext-102 cl6 size-206">
                        <?= $detalles['Marca'] ?>
                      </span>
                    </li>

                    <li class="flex-w flex-t p-b-7">
                      <span class="stext-102 cl3 size-205">
                        Tipo de Archivo
                      </span>

                      <span class="stext-102 cl6 size-206">
                        <?= $detalles['Archivo'] ?>
                      </span>
                    </li>

                    <li class="flex-w flex-t p-b-7">
                      <span class="stext-102 cl3 size-205">
                        Tamaño del Archivo
                      </span>

                      <span class="stext-102 cl6 size-206">
                        <?= $detalles['Tamaño'] ?>
                      </span>
                    </li>

                    <li class="flex-w flex-t p-b-7">
                      <span class="stext-102 cl3 size-205">
                        Medio de Envio
                      </span>

                      <span class="stext-102 cl6 size-206">
                        <?= $detalles['Entrega'] ?>
                      </span>
                    </li>

                    <li class="flex-w flex-t p-b-7">
                      <span class="stext-102 cl3 size-205">
                        Dispositivo
                      </span>

                      <span class="stext-102 cl6 size-206">
                        <?= $detalles['Dispositivo'] ?>
                      </span>
                    </li>

                    <li class="flex-w flex-t p-b-7">
                      <span class="stext-102 cl3 size-205">
                        Vigencia
                      </span>

                      <span class="stext-102 cl6 size-206">
                        <?= $detalles['Vigencia'] ?>
                      </span>
                    </li>

                    <li class="flex-w flex-t p-b-7">
                      <span class="stext-102 cl3 size-205">
                        Entrega
                      </span>

                      <span class="stext-102 cl6 size-206">
                        <?= ($infoproducto['entrega'] == 0) ? 'Inmediata' : $infoproducto['entrega'] ?> <?= ($infoproducto['entrega'] == 0 ? '' : 'dias') ?>
                      </span>
                    </li>

                    <li class="flex-w flex-t p-b-7">
                      <span class="stext-102 cl3 size-205">
                        Ventas
                      </span>

                      <span class="stext-102 cl6 size-206">
                        <?= $infoproducto['ventas'] ?> unidades vendidas
                      </span>
                    </li>

                    <li class="flex-w flex-t p-b-7">
                      <span class="stext-102 cl3 size-205">
                        Visto por
                      </span>

                      <span class="stext-102 cl6 size-206">
                        <?= $infoproducto['vistas'] ?> personas
                      </span>
                    </li>
                  <?php else : ?>
                    <?php if ($infoproducto['entrega'] != 0) : ?>
                      <li class="flex-w flex-t p-b-7">
                        <span class="stext-102 cl3 size-205">
                          Entrega
                        </span>

                        <span class="stext-102 cl6 size-206">
                          <?= $infoproducto['entrega'] ?> dias
                        </span>
                      </li>

                      <li class="flex-w flex-t p-b-7">
                        <span class="stext-102 cl3 size-205">
                          Ventas
                        </span>

                        <span class="stext-102 cl6 size-206">
                          <?= $infoproducto['ventas'] ?> unidades vendidas
                        </span>
                      </li>

                      <li class="flex-w flex-t p-b-7">
                        <span class="stext-102 cl3 size-205">
                          Visto por
                        </span>

                        <span class="stext-102 cl6 size-206">
                          <?= $infoproducto['vistas'] ?> personas
                        </span>
                      </li>
                    <?php endif ?>
                  <?php endif ?>
                </ul>
              </div>
            </div>
          </div>

          <!-- - -->
          <div class="tab-pane fade" id="reviews" role="tabpanel">
            <div class="row">
              <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                <div class="p-b-30 m-lr-15-sm">
                  <!-- Review -->
                  <div class="flex-w flex-t p-b-68">
                    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                      <img src="<?= $backend ?>views/images/avatar-01.jpg" alt="AVATAR">
                    </div>

                    <div class="size-207">
                      <div class="flex-w flex-sb-m p-b-17">
                        <span class="mtext-107 cl2 p-r-20">
                          Ariana Grande
                        </span>

                        <span class="fs-18 cl11">
                          <i class="zmdi zmdi-star"></i>
                          <i class="zmdi zmdi-star"></i>
                          <i class="zmdi zmdi-star"></i>
                          <i class="zmdi zmdi-star"></i>
                          <i class="zmdi zmdi-star-half"></i>
                        </span>
                      </div>

                      <p class="stext-102 cl6">
                        Quod autem in homine praestantissimum atque optimum est, id deseruit. Apud ceteros autem philosophos
                      </p>
                    </div>
                  </div>

                  <!-- Add review -->
                  <form class="w-full">
                    <h5 class="mtext-108 cl2 p-b-7">
                      Add a review
                    </h5>

                    <p class="stext-102 cl6">
                      Your email address will not be published. Required fields are marked *
                    </p>

                    <div class="flex-w flex-m p-t-50 p-b-23">
                      <span class="stext-102 cl3 m-r-16">
                        Your Rating
                      </span>

                      <span class="wrap-rating fs-18 cl11 pointer">
                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                        <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                        <input class="dis-none" type="number" name="rating">
                      </span>
                    </div>

                    <div class="row p-b-25">
                      <div class="col-12 p-b-5">
                        <label class="stext-102 cl3" for="review">Your review</label>
                        <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
                      </div>

                      <div class="col-sm-6 p-b-5">
                        <label class="stext-102 cl3" for="name">Name</label>
                        <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name">
                      </div>

                      <div class="col-sm-6 p-b-5">
                        <label class="stext-102 cl3" for="email">Email</label>
                        <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
                      </div>
                    </div>

                    <button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                      Submit
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
    <span class="stext-107 cl6 p-lr-25">
      CATEGORIA: <a href="<?= $frontend . $categoria_infoProductos['ruta'] ?>" target="_blank" style="color: black;"><?= $categoria_infoProductos['categoria'] ?></a>
    </span>

    <span class="stext-107 cl6 p-lr-25 text-uppercase">
      SUBCATEGORIA: <a href="<?= $frontend . $rutaDestacados[0]['ruta'] ?>" target="_blank" style="color: black;"><?= $rutaDestacados[0]['subcategoria'] ?></a>
    </span>
  </div>
</section>


<!-- Related Products -->
<section class="sec-relate-product bg0 p-t-45 p-b-105">
  <div class="container">
    <div class="p-b-45">
      <h3 class="ltext-106 cl5 txt-center">
        Productos relacionados
      </h3>
    </div>

    <?php
    $ordenar = '';
    $item = 'id_subcategoria';
    $valor = $infoproducto['id_subcategoria'];
    $base = 0;
    $tope = 12;
    $modo = 'Rand()';
    $relacionados = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);
    ?>
    <!-- Slide2 -->
    <?php if (!$relacionados) : ?>
      <div class="col-xs-12 text-center">
        <h1><small>¡Oops!</small></h1>
        <h2>No hay productos relacionados</h2>
      </div>
    <?php else : ?>
      <div class="wrap-slick2">
        <div class="slick2">
          <?php foreach ($relacionados as $key => $value) : ?>
            <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
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
                      $16.64
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
    <?php endif ?>
  </div>
</section>