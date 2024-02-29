<section class="vh-100 pt-6" style="padding: 80px;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <form method="post">
              <h3 class="mb-5">Ingresar</h3>

              <div class="form-outline mb-4">
                <input type="email" id="ingEmail" name="ingEmail" class="form-control form-control-lg ingEmail" required />
                <label class="form-label" for="typeEmailX-2">Correo Electronico</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="ingPassword" name="ingPassword" class="form-control form-control-lg ingPassword" required />
                <label class="form-label" for="typePasswordX-2">Contraseña</label>
              </div>

              <?php
              $ingreso = new ControladorUsuario();
              $ingreso->ctrIngresoUsuario();
              ?>
              <button class="btn btn-lg btn-block" type="submit" style="background-color: #6c7ae0; color:#fff;">Ingresar</button>
            </form>

            <hr class="my-4">

            <button class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;" type="submit">Registrarse con <i class="fa fa-google me-2"></i></button>
            <button class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;" type="submit">Registrarse con <i class="fa fa-facebook me-2"></i></button>

            <hr>
            Aun no tienes una cuenta? <a href="<?= $frontend ?>register">Registrate</a><br>
            <a href="<?= $frontend ?>recuperar-password" target="_blank">Recuperar Contraseña</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>