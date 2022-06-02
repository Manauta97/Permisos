<?php require_once RUTA_APP.'/vistas/inc/header.php' ?>
<h1>profesor</h1>
<p>tabla permisos tuyos</p>
<table class="table table-responsive table-hover">
        <thead>
            <tr>
                <th>Descripcion Permiso</th>
                <th>Documento</th>
                <th>Fecha inicio permiso</th>
                <th>Fecha fin permiso</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datos['tipoPermiso_has_usuario'] as $permisoProp): ?>
                <tr>
                    <td><?php echo $permisoProp->descripcionPermiso ?></td>
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
<?php endif ?>

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>