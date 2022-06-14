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
        
        $profesorPermiso = $this->profesorModelo->obtenerPermisosPropios($this->datos['usuarioSesion']->id_usuario);
        
        $this->datos['tipoPermiso_has_usuario'] = $profesorPermiso;
        
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
                'nombreDocumento' => trim(''),
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

    public function subirFoto($idP){
        
       
        $this->datos['rolesPermitidos'] = [3];   

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }
        
        if($_SERVER['REQUEST_METHOD'] =='POST'){
           
            $carpetaUsuario = $this->datos['usuarioSesion']->id_usuario;

            $dir="/var/www/html/Permisos/public/docs/$carpetaUsuario/";

            if (!is_dir($dir) || !file_exists($dir)) {
                
                mkdir($dir, 7777, true);

            }

            move_uploaded_file($_FILES['imagen']['tmp_name'], $dir.$_FILES['imagen']['name']);

            $id = $this->datos['usuarioSesion']->id_usuario;

            $fotoNueva = [
                'imagen' => $_FILES['imagen']['name']
            ];        
            
            
            if($this->profesorModelo->agregarFoto($idP, $fotoNueva)){

                redireccionar('/inicios/profesor');
            }else{
                die('Algo ha fallado!!');
            }
        }
    }

    public function borrarFoto($id){
        
        $this->datos['rolesPermitidos'] = [3]; 
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol,$this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }
        print_r($id);
       
      


        $nDocu = $this->profesorModelo->obtenerPermisosPropios($this->datos['usuarioSesion']->id_usuario);
        $this->datos['tipoPermiso_has_usuario']= $nDocu;
       
        

        $carpetaUsuario = $this->datos['usuarioSesion']->id_usuario;

        $dir="/var/www/html/Permisos/public/docs/$carpetaUsuario/";

        
      ?>  <pre>  
          <?php 
          
          
         
          ?>  <pre> 
 <?php


        if($this->profesorModelo->eliminarFoto($id)){
            unlink($dir.$id);  
            redireccionar('/inicios/profesor');
        }else{
            die('Algo ha fallado!!');
        }        

    }





}