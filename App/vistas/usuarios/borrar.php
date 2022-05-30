<?php require_once RUTA_APP.'/vistas/inc/header.php' ?>

<a href=".." class="btn btn-light"><i class="bi bi-chevron-double-left"></i>Volver</a>

<div class="card bg-light mt-5 w-75 card-center" style=" margin: auto;">
    <h2 class="card-header">Borrar Usuario</h2>

    <form method="post" class="card-body">
        <div class="mt-3 mb-3">
            <label for="nombre">Nombre: <sup>*</sup></label>
            <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" value="<?php echo $datos['usuario']->nombre ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="apellidos">Apellidos: <sup>*</sup></label>
            <input type="text" name="apellidos" id="apellidos" class="form-control form-control-lg" value="<?php echo $datos['usuario']->apellidos ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="dni">Dni: <sup>*</sup></label>
            <input type="text" name="dni" id="dni" class="form-control form-control-lg" value="<?php echo $datos['usuario']->dni ?>" disabled>
        </div>
        <input type="submit" class="btn btn-success" value="Borrar Usuario">
    </form>
    
</div>

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>

