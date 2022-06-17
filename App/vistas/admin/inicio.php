<?php require_once RUTA_APP.'/vistas/inc/header.php' ?>

<h1 class="text-center mb-5 mt-5">Zona Administrador</h1>

    <table class="table table-responsive table-hover">
        <thead>
            <tr>
                <!--  <th>Id</th>-->
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Centro</th>
                <th>Especialidad</th>
                <th>NRP</th>
                <th>Localidad</th>
                <th>Rol</th>
<?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                <th>Acciones</th>
<?php endif ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datos['usuarios'] as $uruario): ?>
                <tr>
                   <!--  <td><?php echo $uruario->id_usuario ?></td>-->
                    <td><?php echo $uruario->nombre ?></td>
                    <td><?php echo $uruario->apellidos ?></td>

                     
                        <td><?php echo $uruario->dni ?></td>
                        <td><?php echo $uruario->centro ?></td>
                        <td><?php echo $uruario->especialidad ?></td>
                        <td><?php echo $uruario->nrp ?></td>
                    
                    <td><?php echo $uruario->localidad ?></td>
                    <td>
                    <?php 
                        if ($uruario->id_rol == 3) {
                            echo ("Profesor");
                        } elseif ($uruario->id_rol == 2) {
                            echo ("Jefe de Estudios");
                        } elseif ($uruario->id_rol == 1) {
                            echo ("Administrador");
                        }
                    ?>
                </td>
                       
                    
<?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                    <td>
                        <a class="btn btn-primary" href="<?php echo RUTA_URL?>/admins/editar/<?php echo $uruario->id_usuario ?>">Editar</a>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-danger" href="<?php echo RUTA_URL?>/admins/borrar/<?php echo $uruario->id_usuario ?>">Borrar</a>
                        &nbsp;&nbsp;&nbsp;
                    </td>
<?php endif ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

<?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
    <div class="col text-center">
        <a class="btn btn-success" href="<?php echo RUTA_URL?>/admins/agregar/">Agregar Profesor</a>
    </div>

<br> <br>

<table class="table table-responsive table-hover">
    <thead>
        <tr>
            <!-- <th>Id</th> -->
            <th>Descripcion</th>
            <th>Codigo tipo permiso </th>
        
            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                <th>Acciones</th>
            <?php endif ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datos['tipoPermiso'] as $tpermiso): ?>
            <tr>
               <!--   <td><?php echo $tpermiso->idTipoPermiso ?></td> -->
                <td><?php echo $tpermiso->descripcionPermiso ?></td>
                <td><?php echo $tpermiso->codTipoPermiso ?></td>

            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                <td>
                    <a class="btn btn-primary" href="<?php echo RUTA_URL?>/admins/editarPermiso/<?php echo $tpermiso->idTipoPermiso ?>">Editar</a>
                    &nbsp;&nbsp;&nbsp;
                    <a class="btn btn-danger" href="<?php echo RUTA_URL?>/admins/borrarP/<?php echo $tpermiso->idTipoPermiso ?>">Borrar</a>
                </td>
        <?php endif ?>
        <?php endforeach ?>
        </tr>
    </tbody>
    
</table>    
<?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
    <div class="col text-center">
        <a class="btn btn-success" href="<?php echo RUTA_URL?>/admins/agregarPermisos/">Agregar Permiso</a>
    </div>
<?php endif ?>


<script>

    async function cerrarSesion(id_usuario,id_sesion){
        const data = new FormData();
        data.append('id_sesion', id_sesion);
        
        await fetch('<?php echo RUTA_URL?>/usuarios/cerrarSesion/', {
            method: "POST",
            body: data,
        })
            .then((resp) => resp.json())
            .then(function(data) {
    
                if (Boolean(data)){
                    getSesiones(id_usuario)
                } else {
                    alert('Error al Cerrar la sesión')
                }
                
            })
    }

</script>
<?php endif ?>

<?php require_once RUTA_APP.'/vistas/inc/footer.php' ?>
