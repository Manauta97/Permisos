<?php require_once RUTA_APP.'/vistas/inc/header.php' ?>

<a href=".." class="btn btn-light"><i class="bi bi-chevron-double-left"></i>Volver</a>

<div class="card bg-light mt-5 w-75 card-center" style=" margin: auto;">
    <h2 class="card-header">Solicitar Permiso</h2>

    <form method="post" class="card-body">
        <div class="mt-3 mb-3">
            <label for="fIni">Fecha Inicio: <sup>*</sup></label>
            <input type="date" name="fIni" id="fIni" class="form-control form-control-lg">
        </div>
        <div class="mt-3 mb-3">
            <label for="fFin">Fecha Fin: <sup>*</sup></label>
            <input type="date" name="fFin" id="fFin" class="form-control form-control-lg">
        </div>
        <div class="mb-3">
            <label for="permi">Permiso: <sup>*</sup></label>
            <select name="permi" id="permi" class="form-select form-select-lg">
                <?php foreach($datos['tipoPermiso'] as $tPermiso): ?>
                    <?php if ($tPermiso->id_rol == $datos['usuario']->id_rol):?>
                        <option value="<?php echo $tPermiso->idTipoPermiso?>"><?php echo $tPermiso->descripcionPermiso?></option>
                    <?php else: ?>
                        <option value="<?php echo $tPermiso->idTipoPermiso?>"><?php echo $tPermiso->descripcionPermiso?></option>
                    <?php endif ?>
                <?php endforeach ?>
            </select>
        </div>
        <input type="submit" class="btn btn-success" value="Agregar">
    </form>
    
</div>

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>