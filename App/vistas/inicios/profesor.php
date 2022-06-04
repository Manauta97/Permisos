<?php require_once RUTA_APP.'/vistas/inc/header.php' ?>
<h1>profesor</h1>
<p>tabla permisos tuyos</p>
<table class="table table-responsive table-hover">
        <thead>
            <tr>
                <th>Descripcion Permiso</th>
                <th>Documento</th>
                <th>doc</th>
                <th>Fecha inicio permiso</th>
                <th>Fecha fin permiso</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datos['tipoPermiso_has_usuario'] as $permisoProp): ?>
                <tr>
                    <td><?php echo $permisoProp->descripcionPermiso ?></td>
                    <td>
                    <?php if ($permisoProp->nombreDocumento==''){echo '';} else {?> <img class="mt-auto img-fluid p-4" src="<?php echo RUTA_ImgDatos. $permisoProp->nombreDocumento?>"><?php ;}?>
                    </td>
                    <td><?php echo $permisoProp->nombreDocumento ?></td>
                    <td><?php echo $permisoProp->fechaInicio ?></td>
                    <td><?php echo $permisoProp->fechaFin ?></td>
                    <td><?php echo $permisoProp->nombreEstado ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[3])):?>
    <div class="col text-center">
        <a class="btn btn-success" href="<?php echo RUTA_URL?>/Profesores/solicitudPermisos/">Solicitar Permiso</a>
    </div>

    <div>
        <form action="<?php echo RUTA_URL?>/usuarios/subirFoto/<?php echo $permisoProp->id_usuario ?>" ENCTYPE="multipart/form-data" method="post">
            <div class="mb-3">
                <input accept="image/*" type="file" id="" name="imagen" >
            </div>
            <input type="submit" class="btn btn-success" value="Adjuntar documento" onclick="return confirm('¿Seguro que quieres actualizar la foto de perfil?');">
        </form>
    </div>
<?php endif ?>

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>