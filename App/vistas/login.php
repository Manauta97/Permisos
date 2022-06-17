<?php require_once RUTA_APP.'/vistas/inc/header_no_logueado.php' ?>

<!--  <a href=".." class="btn btn-light"><i class="bi bi-chevron-double-left"></i>Volver</a>-->

<div class="container">
  <div class="jumbotron mb-5 text-center">
    <h1>Gestión de Permisos</h1>
  </div>   

  <div class="card-body text-center shadow">
    <div class="mb-md-5 mt-md-5">
      <form method="post" class="card-body">
        <div class="form-floating mb-3">
          <input type="text" name="dnisesion" class="form-control" id="dnisesion" placeholder="" required maxlength="9">
          <label for="dnisesion">DNI</label>
        </div>
        <input type="submit" class="btn btn-primary" value="Login">
    </form> 
    </div>
  </div>          

  <?php if (isset($datos['error']) && $datos['error'] == 'error_1' ): ?>

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
      </symbol>
    </svg>

    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
      <div>
        Intentelo de nuevo. <strong>Usuario o Contraseña incorrecta</strong>
      </div>
    </div>

  <?php endif ?>

</div>
<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>