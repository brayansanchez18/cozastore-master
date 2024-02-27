<section class="vh-100 pt-6" style="padding: 80px;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <form method="post" onsubmit="return registroUsuario()">
              <h3 class="mb-5">Registrarse</h3>

              <div class="form-outline mb-4">
                <input type="text" id="typeEmailX-2 regUsuario" name="regUsuario" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX-2">Nombre Completo</label>
              </div>

              <!-- <div class="form-outline mb-4">
              <input type="email" id="typeEmailX-2" class="form-control form-control-lg" />
              <label class="form-label" for="typeEmailX-2">Apellidos</label>
            </div> -->

              <div class="form-outline mb-4">
                <input type="email" id="typeEmailX-2 regEmail" name="regEmail" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX-2">Correo Electronico</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="typePasswordX-2 regPassword" name="regPassword" class="form-control form-control-lg" />
                <label class="form-label" for="typePasswordX-2">Contraseña</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="typePasswordX-2 validarPassword" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX-2">Validar Contraseña</label>
              </div>

              <?php
              $footer = ControladorPlantilla::ctrMostrarFooter();
              $correo = $footer['correo'];

              $registro = new ControladorUsuario();
              $registro->ctrRegistroUsuario($correo);
              ?>

              <button class="btn btn-lg btn-block" type="submit" style="background-color: #6c7ae0; color:#fff;">Registrate</button>

            </form>

            <hr class="my-4">

            <button class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;" type="submit">Registrarse con <i class="fa fa-google me-2"></i></button>
            <button class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;" type="submit">Registrarse con <i class="fa fa-facebook me-2"></i></button>

            <hr>
            Ya tienes una cuenta? <a href="<?= $frontend ?>login">Ingresa aqui</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>