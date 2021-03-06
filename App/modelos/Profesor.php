<?php

class Profesor {
    private $db;

    public function __construct(){
        $this->db = new Base;
    }
    public function obtenerTiposPermiso(){
        $this->db->query("SELECT * FROM tipoPermiso");

        return $this->db->registros();
    }

    public function obtenerPermisosPropios($idUsuario){

        $sql = "SELECT idPermisoUsuario, usuarios.id_usuario, descripcionPermiso, nombreDocumento,observaciones, fechaInicio, fechaFin, nombreEstado  FROM tipoPermiso_has_usuario 
        inner join tipoPermiso
        on tipoPermiso_has_usuario.idTipoPermiso = tipoPermiso.idTipoPermiso
        inner join usuarios
        on tipoPermiso_has_usuario.id_usuario = usuarios.id_usuario
        inner join estados
        on tipoPermiso_has_usuario.id_estado = estados.id_estado
        where usuarios.id_usuario ='$idUsuario';";
       
        $this->db->query($sql);

        return $this->db->registros();
    }
  
    
    public function agregarSolicitud($datos){

       
        $sql = "INSERT INTO tipoPermiso_has_usuario (idTipoPermiso,id_usuario,id_estado,nombreDocumento,fechaInicio,fechaFin,observaciones) 
        VALUES (:idTipoPermiso, :id_usuario, :id_estado, :nombreDocumento, :fechaInicio, :fechaFin, :observaciones)";

        $this->db->query($sql);

        //vinculamos los valores
        
        $this->db->bind(':idTipoPermiso',$datos['idTipoPermiso']);

        $this->db->bind(':id_usuario',$datos['id_usuario']);
        $this->db->bind(':id_estado',3);
        $this->db->bind(':nombreDocumento',$datos['nombreDocumento']);
        $this->db->bind(':fechaInicio',$datos['fechaInicio']);
        $this->db->bind(':fechaFin',$datos['fechaFin']);
        $this->db->bind(':observaciones',$datos['observaciones']);

        //ejecutamos
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function agregarFoto($id, $fotoNueva){
        
        $this->db->query("UPDATE tipoPermiso_has_usuario SET nombreDocumento = :foto WHERE idPermisoUsuario = $id");
        $this->db->bind(':foto', $fotoNueva['imagen']);
        
        
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }

    public function eliminarFoto($id){ 

        
        $this->db->query("UPDATE tipoPermiso_has_usuario SET nombreDocumento = '' WHERE nombreDocumento = :nombreDocumento");
        $this->db->bind(':nombreDocumento',$id);
          
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function eliminarSolicitud($id,$n){
        //print_r($id);
        //exit();

        $this->db->query("DELETE FROM tipoPermiso_has_usuario WHERE idPermisoUsuario = :id");
            $this->db->bind(':id',$id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }




}