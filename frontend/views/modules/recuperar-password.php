<section class="vh-100 pt-6" style="padding: 80px;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <form method="post">
              <h3 class="mb-5">Recuperar Contraseña</h3>

              <div class="form-outline mb-4">
                <p>Ingresa tu correo electronico y te mandaremos una nueva contraseña, una vez dentro podras ingresar a tu perfil y cambiarla.</p>
                <hr>
                <input type="email" id="passEmail" name="passEmail" class="form-control form-control-lg passEmail" required />
                <label class="form-label" for="typeEmailX-2">Correo Electronico</label>
              </div>
              <?php $password = new ControladorUsuario();
              $password->ctrOlvidoPassword($correo); ?>
              <button class="btn btn-lg btn-block" type="submit" style="background-color: #6c7ae0; color:#fff;">
                Recuperar
              </button>
            </form>
            <hr>
            Ya tienes una cuenta? <a href="<?= $frontend ?>login">Ingresa aqui</a><br>
            o <a href="<?= $frontend ?>register">Registrate</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>