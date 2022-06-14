<?php require_once RUTA_APP.'/vistas/inc/header.php' ?>
<h1>profesor</h1>

<table class="table table-responsive table-hover">
   
        <thead>
            <tr>
                <th>Descripcion Permiso</th>
                <th>Documento</th>
                <th>Fecha inicio permiso</th>
                <th>Fecha fin permiso</th>
                <th>Estado</th>
                <th>Subir documento</th>
                 <?php foreach($datos['tipoPermiso_has_usuario'] as $permisoProp): ?>
                <?php if ($permisoProp->nombreDocumento!='') { ?>          
                <td>eliminar documento</td>
                <?php } ?>             
            </tr>
        </thead>
        <tbody>
            
                <tr>
                    <td><?php echo $permisoProp->descripcionPermiso ?></td>
                    <td>
                        <?php if ($permisoProp->nombreDocumento==''){echo '';} else {?> <img width="200" height="200" class="rounded img-fluid" src="<?php echo RUTA_ImgDatos.$permisoProp->id_usuario."/".$permisoProp->nombreDocumento ?>"><?php ;}?>
                    </td>
                    <td><?php echo $permisoProp->fechaInicio ?></td>
                    <td><?php echo $permisoProp->fechaFin ?></td>
                    <td><?php echo $permisoProp->nombreEstado ?></td>
                    <td> 
                        <div>
                            <form action="<?php echo RUTA_URL?>/Profesores/subirFoto/<?php echo $permisoProp->idPermisoUsuario ?>" ENCTYPE="multipart/form-data" method="post">        

                                <div class="mb-3">
                                    <input accept="image/*" type="file" id="img" name="imagen" >
                                </div>

                             

                                <?php if ($permisoProp->nombreDocumento=='') {
                                    ?>
                                        <input type="submit" class="btn btn-success" value="Adjuntar documento" id="botonS">
                                    <?php
                                }else {
                                    ?>
                                        <input type="submit" class="btn btn-success" value="Adjuntar documento" id="botonS" disabled>
                                    <?php
                                }?>
                                
                            </form>
                        </div>
                    </td>
                    <td>
                    <?php if ($permisoProp->nombreDocumento!='') { ?>
                        <form action="<?php echo RUTA_URL?>/Profesores/borrarFoto/<?php echo $permisoProp->nombreDocumento ?>" method="post">
                        
                            <input type="text" name="photo" id="photo" value="<?php echo $permisoProp->nombreDocumento ?>" disabled>
                            <input type="submit" class="btn btn-danger" value="borrar" id="botonBorrar">
                        </form>
                    <?php   } ?>  
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