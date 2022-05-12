<?php 
    class Permisos extends Controlador {
        public function __construct(){
            $this->tipospermisos = $this->modelo('Permiso');
        }

        public function index(){
            //Obtenemos los permisos
            $tipoPermisos = $this->tipospermisos->obtenerTipoPermiso();
            $this->datos['tipoPermiso'] = $tipoPermisos;
            $this->vista('inicios/admin',$this->datos);   
        }

    }

?>