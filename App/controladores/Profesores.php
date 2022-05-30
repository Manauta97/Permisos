<?php 
class Profesores extends Controlador{

    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->usuarioModelo = $this->modelo('Profesor');

        $this->datos['menuActivo'] = 3;         // Definimos el menu que sera destacado en la vista
        
    }

    public function index(){
        //Obtenemos los usuarios
        $usuarios = $this->usuarioModelo->obtenerUsuarios();
        
        $this->datos['usuarios'] = $usuarios;
        // $this->vista('inicios/admin',$this->datos);  
        
        $this->vista('inicios/profesor',$this->datos);   
    }

}