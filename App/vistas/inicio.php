<?php require_once RUTA_APP.'/vistas/inc/header.php' ?>

<?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
  <h1>admin</h1>
<?php endif ?>  
<?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>
  <h1>profesor</h1>
<?php endif ?> 
<?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[3])):?>
  <h1>alumno</h1>
<?php endif ?> 
<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>