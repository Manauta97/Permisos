<?php require_once RUTA_APP.'/vistas/inc/header.php' ?>
<div id="container">
    <h1>jefe de estudios</h1>

    <table class="table table-responsive table-hover">
        <thead>
            <tr>
               <th>id</th>
                <th>Descripcion Permiso</th>
                <th>Profesor Solicitante</th>
                <th>Documento</th>
                <th>Fecha inicio permiso</th>
                <th>Fecha fin permiso</th>
                <th>Estado</th>
                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>
                    <th>Acciones</th>
                <?php endif ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datos['tipoPermiso_has_usuario'] as $permisoUsu): ?>
                
                <tr>
                <td><?php echo $permisoUsu->idPermisoUsuario ?></td>
                    <td><?php echo $permisoUsu->descripcionPermiso ?></td>
                    <td><?php echo $permisoUsu->nombre ." " . $permisoUsu->apellidos?></td>
                    <td><?php echo $permisoUsu->nombreDocumento ?></td>
                    <td><?php echo $permisoUsu->fechaInicio ?></td>
                    <td><?php echo $permisoUsu->fechaFin ?></td>
                    <td><?php echo $permisoUsu->nombreEstado ?></td>
       
                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>
                        <td>
                            <a href="<?php echo RUTA_URL?>/JefeEstudios/aceptarPermiso/<?php echo $permisoUsu->idPermisoUsuario ?>">Aceptar</a>
                            &nbsp;&nbsp;&nbsp;
                            <a href="<?php echo RUTA_URL?>/JefeEstudios/denegarPermiso/<?php echo $permisoUsu->idPermisoUsuario ?>">Denegar</a>
                            &nbsp;&nbsp;&nbsp;
                        </td>
                <?php endif ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>        
<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>