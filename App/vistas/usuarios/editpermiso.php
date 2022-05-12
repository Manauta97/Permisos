<?php require_once RUTA_APP.'/vistas/inc/header.php' ?>

<?php
    if (isset($datos['usuario']->id_usuario)){
        $accion = "Modificar";
    } else {
        $accion = "Agregar";
    }
?>

<a href=".." class="btn btn-light"><i class="bi bi-chevron-double-left"></i>Volver</a>

<div class="card bg-light mt-5 w-75 card-center" style=" margin: auto;">
    <h2 class="card-header"><?php echo $accion ?> Usuario</h2>

    <form method="post" class="card-body">
        <div class="mt-3 mb-3">
            <label for="descripcion">Descripcion: <sup>*</sup></label>
            <input type="text" name="descripcion" id="descripcion" class="form-control form-control-lg" value="<?php echo $datos['usuario']->nombre ?>">
        </div>
        <div class="mt-3 mb-3">
            <label for="nombre">Codigo Tipo Permiso: <sup>*</sup></label>
            <input type="text" name="codtipo" id="codtipo" class="form-control form-control-lg" value="<?php echo $datos['usuario']->apellidos ?>">
        </div>
        <div class="mb-3">
            <label for="email">Foto: <sup>*</sup></label>
            <input type="text" name="foto" id="foto" class="form-control form-control-lg" value="<?php echo $datos['usuario']->email ?>">
        </div>
        
        <div class="mb-3">
            <label for="rol">Rol: <sup>*</sup></label>
            <select name="rol" id="rol" class="form-select form-select-lg">
                <?php foreach($datos['listaRoles'] as $rol): ?>
                    <?php if ($rol->id_rol == $datos['usuario']->id_rol):?>
                        <option value="<?php echo $rol->id_rol?>" selected><?php echo $rol->rol?></option>
                    <?php else: ?>
                        <option value="<?php echo $rol->id_rol?>"><?php echo $rol->rol?></option>
                    <?php endif ?>
                <?php endforeach ?>
            </select>
        </div>
        <input type="submit" class="btn btn-success" value="<?php echo $accion ?> Usuario">
    </form>
    
</div>

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>