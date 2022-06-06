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
                <th>Subir documento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datos['tipoPermiso_has_usuario'] as $permisoProp): ?>
                <tr>
                    <td><?php echo $permisoProp->descripcionPermiso ?></td>
                    <td>
                    <?php if ($permisoProp->nombreDocumento==''){echo '';} else {?> <img width="200" height="200" class="rounded img-fluid" src="<?php echo RUTA_ImgDatos.$permisoProp->nombreDocumento?>"><?php ;}?>
                    </td>
                    <td><?php echo $permisoProp->fechaInicio ?></td>
                    <td><?php echo $permisoProp->fechaFin ?></td>
                    <td><?php echo $permisoProp->nombreEstado ?></td>
                    <td> 
                        <div>
                            <form action="<?php echo RUTA_URL?>/Profesores/subirFoto/<?php echo $permisoProp->idPermisoUsuario ?>" ENCTYPE="multipart/form-data" method="post">        
                                    

                                <div class="mb-3">
                                    <input accept="image/*" type="file" id="" name="imagen" >
                                </div>
                                
                                <input type="submit" class="btn btn-success" value="Adjuntar documento"> <!-- onclick="return confirm('¿Seguro que quieres actualizar la foto de perfil?');" -->
                            </form>
                        </div>
                    </td>
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