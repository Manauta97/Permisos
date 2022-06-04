<?php 
class Profesores extends Controlador{

    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->profesorModelo = $this->modelo('Profesor');

        $this->datos['menuActivo'] = 3;         // Definimos el menu que sera destacado en la vista
        
    }

    public function index(){
        //Obtenemos los usuarios
        $profesorPermiso = $this->profesorModelo->obtenerPermisosPropios($this->datos['usuarioSesion']->id_usuario);
        
        $this->datos['tipoPermiso_has_usuario'] = $profesorPermiso;
        // $this->vista('inicios/admin',$this->datos);  
        
        $this->vista('/inicios/profesor',$this->datos);   
    }


    public function solicitudPermisos(){
        $this->datos['rolesPermitidos'] = [3];   

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $solicitudPermiso = [
                
                'idTipoPermiso' => trim($_POST['permi']),
                'id_usuario' => $this->datos['usuarioSesion']->id_usuario,
                'id_estado'=> trim(3),
                'nombreDocumento' => trim($_POST['fotoDocumento']),
                'fechaInicio' => trim($_POST['fIni']),
                'fechaFin' => trim($_POST['fFin']),
                
            ];

            if ($this->profesorModelo->agregarSolicitud($solicitudPermiso)){
                redireccionar('/usuarios');
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->datos['tipoPermiso_has_usuario'] = (object) [
                
                'idTipoPermiso' => '',
                'id_usuario' => '',
                'id_estado'=>3,
                'nombreDocumento' => '',
                'fechaInicio' => '',
                'fechaFin' => '',
                
                    
            ];

            $this->datos['tipoPermiso'] = $this->profesorModelo->obtenerTiposPermiso();

            $this->vista('usuarios/solicitud',$this->datos);
        }

    }

    public function subirFoto($id){

        if($_SERVER['REQUEST_METHOD'] =='POST'){

            $dir="/var/www/html/Tragamillas/mvc_completo/public/docs/";
            
            // print_r($_FILES['imagen']['name']);exit();

            move_uploaded_file($_FILES['imagen']['tmp_name'], $dir.$_FILES['imagen']['name']);

            $id = $this->datos['usuarioSesion']->id_usuario;

            $fotoNueva = [
                'imagen' => $_FILES['imagen']['name']
            ];

            // print_r($fotoNueva); exit();
            if($this->usuarioModelo->agregarFoto($id, $fotoNueva)){
                // print_r($licenciaNueva);exit();
                redireccionar('/inicios/profesor');
            }else{
                die('Algo ha fallado!!');
            }
        }
    }

}

