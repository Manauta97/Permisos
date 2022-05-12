<?php

    class Inicio extends Controlador{

        public function __construct(){

        }

        public function index(){
            if (Sesion::sesionCreada($this->datos)){
                
                if ($this->datos['usuarioSesion']->id_rol==1) {
                    redireccionar('/usuarios/obtenerUsuarios');
                }elseif ($this->datos['usuarioSesion']->id_rol==2){
                    $this->vista('inicios/no_socio',$this->datos);
                }elseif ($this->datos['usuarioSesion']->id_rol==3){
                    $this->vista('inicios/socio',$this->datos);
                }
                /* $this->vista('inicio',$this->datos); */
            } else {
                $this->vista('inicio_no_logueado');
            }
        }

    }
