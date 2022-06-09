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
            
            $SolicitudPermisos = $this->jefeEstudioModelo->obtenerPermisosUsuario($this->datos['usuarioSesion']->centro);
           
            $this->datos['tipoPermiso_has_usuario'] = $SolicitudPermisos;
            
            $this->vista('inicios/jefeEstudios',$this->datos);   
        }
        

        public function aceptarPermiso($usuarioPermiso){
            $this->datos['rolesPermitidos'] = [2];
            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                
                $permisoAceptado = [
                    'Aceptado' => 1,                    
                ];
                if ($this->jefeEstudioModelo->aceptar($usuarioPermiso, $idUsuPermiso)){
                    redireccionar('/inicios/jefeEstudios');
                } else {
                    die('Algo ha fallado!!!');
                }
            } else {
                $this->datos['tipoPermiso_has_usuario'] = (object) [
                    'Aceptado' => 0, 
                ];
                $this->datos['tipoPermiso_has_usuario'] = $this->JefeEstudio->aceptar($idUsuPermiso, $this->datos['tipoPermiso_has_usuario']);

                $this->vista('/inicios/jefeEstudios',$this->datos);   
            }

        }

        public function denegarPermiso($usuarioPermiso){
            $this->datos['rolesPermitidos'] = [2];
            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
                redireccionar('/');
            }

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                
                $permisoAceptado = [
                    'Denegado' => 2,                    
                ];
                if ($this->jefeEstudioModelo->denegar($usuarioPermiso, $idUsuPermiso)){
                    redireccionar('/inicios/jefeEstudios');
                } else {
                    die('Algo ha fallado!!!');
                }
            } else {
                $this->datos['tipoPermiso_has_usuario'] = (object) [
                    'Denegado' => 0, 
                ];
                $this->datos['tipoPermiso_has_usuario'] = $this->JefeEstudio->denegar($idUsuPermiso, $this->datos['tipoPermiso_has_usuario']);

                $this->vista('/inicios/jefeEstudios',$this->datos);   
            }

        }


    }

    


?>