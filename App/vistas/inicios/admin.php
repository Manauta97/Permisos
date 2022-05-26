<?php require_once RUTA_APP.'/vistas/inc/header.php' ?>
<h1>zona administrador</h1>

    <table class="table table-responsive table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                   
                    <th>DNI</th>
                    <th>Centro</th>
                    <th>Especialidad</th>
                    <th>NRP</th>
                
                <th>Email</th>
                <th>Teléfono</th>
                <th>Rol</th>
<?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                <th>Acciones</th>
<?php endif ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datos['usuarios'] as $uruario): ?>
                <tr>
                    <td><?php echo $uruario->id_usuario ?></td>
                    <td><?php echo $uruario->nombre ?></td>
                    <td><?php echo $uruario->apellidos ?></td>

                     
                        <td><?php echo $uruario->dni ?></td>
                        <td><?php echo $uruario->centro ?></td>
                        <td><?php echo $uruario->especialidad ?></td>
                        <td><?php echo $uruario->nrp ?></td>
                    
                    <td><?php echo $uruario->email ?></td>
                    <td><?php echo $uruario->telefono ?></td>
                    <td><?php echo $uruario->id_rol ?></td>
                    
<?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                    <td>
                        <a href="<?php echo RUTA_URL?>/usuarios/editar/<?php echo $uruario->id_usuario ?>">Editar</a>
                        &nbsp;&nbsp;&nbsp;
                        <a href="<?php echo RUTA_URL?>/usuarios/borrar/<?php echo $uruario->id_usuario ?>">Borrar</a>
                        &nbsp;&nbsp;&nbsp;
                       <!--   <a href="javascript:getSesiones(<?php echo $uruario->id_usuario ?>)">Sesiones</a>-->
                    </td>
<?php endif ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

<?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
    <div class="col text-center">
        <a class="btn btn-success" href="<?php echo RUTA_URL?>/usuarios/agregar/">+</a>
    </div>

    <div class="container" id="listadoSesiones" style="display:none">
        <br><br>
        <h2>Sesiones de: <span id="usuarioSesion"></span></h2>
        <table class="table text-center">
            <thead>
                <tr>
                <th scope="col">id_sesion</th>
                <th scope="col">id_usuario</th>
                <th scope="col">fecha_inicio</th>
                <th scope="col">fecha_fin</th>
                
                </tr>
            </thead>
            <tbody id="tbodyTablaSesiones">

                
            </tbody>
        </table>
    </div>

<br> <br>

<table class="table table-responsive table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Descripcion</th>
            <th>Codigo tipo permiso </th>
            <th>Foto</th>
            <th>Estado</th>
            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                <th>Acciones</th>
            <?php endif ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($datos['tipoPermiso'] as $tpermiso): ?>
            <tr>
                <td><?php echo $tpermiso->idTipoPermiso ?></td>
                <td><?php echo $tpermiso->descripcionPermiso ?></td>
                <td><?php echo $tpermiso->codTipoPermiso ?></td>
                <td><?php echo $tpermiso->foto ?></td>
                <td><?php echo $tpermiso->id_estado ?></td>
            
            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                <td>
                    <a href="<?php echo RUTA_URL?>/usuarios/editarPermiso/<?php echo $tpermiso->idTipoPermiso ?>">Editar</a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="<?php echo RUTA_URL?>/usuarios/borrarP/<?php echo $tpermiso->idTipoPermiso ?>">Borrar</a>
                </td>
        <?php endif ?>
        <?php endforeach ?>
        </tr>
    </tbody>
    
</table>    
<?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
    <div class="col text-center">
        <a class="btn btn-success" href="<?php echo RUTA_URL?>/usuarios/agregarPermisos/">+</a>
    </div>
<?php endif ?>
<script>
    function getSesiones(id_usuario){
        fetch('<?php echo RUTA_URL?>/usuarios/sesiones/'+id_usuario, {
            headers: {
                "Content-Type": "application/json"
            },
            credentials: 'include'
        })
            .then((resp) => resp.json())
            .then(function(data) {
                let sesiones = data.sesiones
                let usuario = data.usuario

                document.getElementById("tbodyTablaSesiones").innerHTML = ""
                document.getElementById("usuarioSesion").innerHTML = usuario.nombre

                document.getElementById("listadoSesiones").style.display="block";

                for (i = 0; i < sesiones.length; i++){
                    let fechaInicio = new Date(sesiones[i].fecha_inicio)
                    let fechaFin = new Date(sesiones[i].fecha_fin)
                    let fechaFinOut = "-"
                    let estado
                    if (sesiones[i].fecha_fin) {
                        fechaFinOut = fechaFin.toLocaleString()
                        estado = "cerrada"
                    } else {
                        estado = '<div class="col text-center"> \
                                    <a class="btn btn-success" href="javascript:cerrarSesion(\''+id_usuario+'\',\''+sesiones[i].id_sesion+'\')"> \
                                        Cerrar \
                                    </a> \
                                </div>'
                    }
                    
                    document.getElementById("tbodyTablaSesiones").insertRow(-1).innerHTML = 
                                '<td>' + sesiones[i].id_sesion + '</td>' + 
                                '<td>' + sesiones[i].id_usuario + '</td>' + 
                                '<td>' + fechaInicio.toLocaleString() + '</td>' + 
                                '<td>' + fechaFinOut + '</td>' +
                                '<td>' + estado + '</td>'
                }
            })
    }


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
