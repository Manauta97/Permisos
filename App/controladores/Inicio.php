<?php

    class Inicio extends Controlador{

        public function __construct(){

        }

        public function index(){
            if (Sesion::sesionCreada($this->datos)){
                
                if ($this->datos['usuarioSesion']->id_rol==1) {
                    redireccionar('/usuarios/obtenerUsuarios');
                }elseif ($this->datos['usuarioSesion']->id_rol==2){
                    redireccionar('/jefeEstudios/obtenerPermisosUsuario');
                }elseif ($this->datos['usuarioSesion']->id_rol==3){
                    $this->vista('inicios/profesor',$this->datos);
                }
                /* $this->vista('inicio',$this->datos); */
            } else {
                $this->vista('inicio_no_logueado');
            }
        }

    }
