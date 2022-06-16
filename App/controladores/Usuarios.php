<?php

    class Usuarios extends Controlador{

        public function __construct(){
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }

            $this->usuarioModelo = $this->modelo('Usuario');

            $this->datos['menuActivo'] = 1;         // Definimos el menu que sera destacado en la vista
            
        }

        public function index(){
            //Obtenemos los usuarios
            $usuarios = $this->usuarioModelo->obtenerUsuarios();
            $this->datos['usuarios'] = $usuarios;
            // $this->vista('inicios/admin',$this->datos);  

            $permiso = $this->usuarioModelo->obtenerTipoPermiso();
            $this->datos['tipoPermiso'] = $permiso;

            
            $this->vista('admin/inicio',$this->datos);   
        }


        public function agregar(){
            $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/usuarios');
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                $usuarioNuevo = [
                    'nombre' => trim($_POST['nombre']),
                    'apellidos' => trim($_POST['apellidos']),
                    'dni' => trim($_POST['dni']),
                    'centro' => trim($_POST['centro']),
                    'especialidad' => trim($_POST['especialidad']),
                    'nrp' => trim($_POST['nrp']),
                    'localidad' => trim($_POST['localidad']),
                    'id_rol' => trim($_POST['rol']),
                ];

                if ($this->usuarioModelo->agregarUsuario($usuarioNuevo)){
                    redireccionar('/usuarios');
                } else {
                    die('Algo ha fallado!!!');
                }
            } else {
                $this->datos['usuario'] = (object) [
                    'nombre' => '',
                    'apellidos' => '',

                    'dni' => '',
                    'centro' => '',
                    'especialidad' => '',
                    'nrp' => '',

                    'localidad' => '',
                
                    'id_rol' => 3
                ];

                $this->datos['listaRoles'] = $this->usuarioModelo->obtenerRoles();

                $this->vista('admin/agregar_editar',$this->datos);
            }
        }

        public function agregarPermisos(){
            $this->datos['rolesPermitidos'] = [1];   

            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/usuarios');
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                $permisoNuevo = [
                    'descripcionPermiso' => trim($_POST['descripcion']),
                    'codTipoPermiso' => trim($_POST['codtipo']),
                ];

                if ($this->usuarioModelo->agregarPermiso($permisoNuevo)){
                    redireccionar('/usuarios');
                } else {
                    die('Algo ha fallado!!!');
                }
            } else {
                $this->datos['usuario'] = (object) [
                    'descripcionPermiso' => '',
                    'codTipoPermiso' => '',

                ];

                $this->datos['listaestado'] = $this->usuarioModelo->obtenerEstados();

                $this->vista('admin/agregarPermiso',$this->datos);
            }

        }


        public function editar($id){
            $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/usuarios');
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $usuarioModificado = [
                    'id_usuario' => $id,
                    'nombre' => trim($_POST['nombre']),
                    'apellidos' => trim($_POST['apellidos']),
                    
                    'dni' => trim($_POST['dni']),
                    'centro' => trim($_POST['centro']),
                    'especialidad' => trim($_POST['especialidad']),
                    'nrp' => trim($_POST['nrp']),

                    'localidad' => trim($_POST['localidad']),
                    'id_rol' => trim($_POST['rol']),
                ];

                if ($this->usuarioModelo->actualizarUsuario($usuarioModificado)){
                    redireccionar('/usuarios');
                } else {
                    die('Algo ha fallado!!!');
                }
            } else {
                //obtenemos información del usuario y el listado de roles desde del modelo
                $this->datos['usuario'] = $this->usuarioModelo->obtenerUsuarioId($id);
                $this->datos['listaRoles'] = $this->usuarioModelo->obtenerRoles();

                $this->vista('admin/agregar_editar',$this->datos);
            }
        }

        public function editarPermiso($id){
            $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/usuarios');
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $permisoModificado = [
                    'idTipoPermiso' => $id,
                    'descripcionPermiso' => trim($_POST['descripcion']),
                    'codTipoPermiso' => trim($_POST['codtipo']),
                ];

                if ($this->usuarioModelo->actualizarPermiso($permisoModificado)){
                    redireccionar('/usuarios');
                } else {
                    die('Algo ha fallado!!!');
                }
            } else {
                //obtenemos información del permiso y el listado de roles desde del modelo
                
                $this->datos['tipoPermiso'] = $this->usuarioModelo->obtenerPermisoId($id);

                //$this->datos['listaRoles'] = $this->usuarioModelo->obtenerRoles();

                $this->vista('admin/editpermiso',$this->datos);
            }
        }


        public function borrar($id){
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($this->usuarioModelo->borrarUsuario($id)){
                    redireccionar('/usuarios');
                } else {
                    die('Algo ha fallado!!!');
                }
            } else {
                //obtenemos información del usuario desde del modelo
                $this->datos['usuario'] = $this->usuarioModelo->obtenerUsuarioId($id);

                $this->vista('admin/borrar',$this->datos);
            }
        }

        public function borrarP($id){
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($this->usuarioModelo->borrarPermiso($id)){
                    redireccionar('/usuarios');
                } else {
                    die('Algo ha fallado!!!');
                }
            } else {
                //obtenemos información del usuario desde del modelo
                $this->datos['tipoPermiso'] = $this->usuarioModelo->obtenerPermisoId($id);

                $this->vista('admin/borrarPermiso',$this->datos);
            }
        }

        
        public function sesiones($id_usuario){
            $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
                exit();
            }

            // En __construct() verificamos que se haya iniciado la sesion
            $sesiones = $this->usuarioModelo->obtenerSesionesUsuario($id_usuario);
            $usuario = $this->usuarioModelo->obtenerUsuarioId($id_usuario);

            // utilizamos $datos en lugar de $this->datos ya que no necesitamos los datos del usuario de sesion
            $datos['sesiones'] = $sesiones;
            $datos['usuario'] = $usuario;

            $this->vistaApi($datos);
        }


        public function cerrarSesion(){
            $this->datos['rolesPermitidos'] = [1,20];          // Definimos los roles que tendran acceso

            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
                exit();
            }
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id_sesion = $_POST['id_sesion'];
                
                $resultado = $this->usuarioModelo->cerrarSesion($id_sesion);

                unlink(session_save_path().'\\sess_'.$id_sesion);
                $this->vistaApi($resultado);
            }
        }
    }
