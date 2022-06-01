<?php
    class JefeEstudios extends Controlador{

        public function __construct(){
            Sesion::iniciarSesion($this->datos);
            $this->datos['rolesPermitidos'] = [2];

            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }

            $this->jefeEstudioModelo = $this->modelo('JefeEstudio');

            $this->datos['menuActivo'] = 1; 
        }

        public function index(){
            //Obtenemos los usuarios
            
            $SolicitudPermisos = $this->jefeEstudioModelo->obtenerPermisosUsuario();
            print_r($SolicitudPermisos);
            $this->datos['tipoPermiso_has_usuario'] = $SolicitudPermisos;
            
            $this->vista('inicios/jefeEstudios',$this->datos);   
        }

    }


?>