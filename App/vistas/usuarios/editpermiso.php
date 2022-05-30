<?php require_once RUTA_APP.'/vistas/inc/header.php' ?>

<a href=".." class="btn btn-light"><i class="bi bi-chevron-double-left"></i>Volver</a>

<div class="card bg-light mt-5 w-75 card-center" style=" margin: auto;">
    <h2 class="card-header">Editar Permiso</h2>

    <form method="post" class="card-body">
        <div class="mt-3 mb-3">
            <label for="descripcion">Descripcion: <sup>*</sup></label>
            <input type="text" name="descripcion" id="descripcion" class="form-control form-control-lg" value="<?php echo $datos['tipoPermiso']->descripcionPermiso ?>">
        </div>
        <div class="mt-3 mb-3">
            <label for="codtipo">Codigo: <sup>*</sup></label>
            <input type="text" name="codtipo" id="codtipo" class="form-control form-control-lg" value="<?php echo $datos['tipoPermiso']->codTipoPermiso ?>">
        </div>
       
        <input type="submit" class="btn btn-success" value="Editar">
    </form>
    
</div>

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>