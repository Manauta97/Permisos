<?php

    class JefeEstudio {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        public function obtenerPermisosUsuario($centro){

            $sql = "SELECT idPermisoUsuario,descripcionPermiso, nombre, apellidos ,nombreDocumento, fechaInicio, fechaFin, nombreEstado  FROM tipoPermiso_has_usuario 
            inner join tipoPermiso
            on tipoPermiso_has_usuario.idTipoPermiso = tipoPermiso.idTipoPermiso
            inner join usuarios
            on tipoPermiso_has_usuario.id_usuario = usuarios.id_usuario
            inner join estados
            on tipoPermiso_has_usuario.id_estado = estados.id_estado
            where usuarios.centro ='$centro';";
           
            $this->db->query($sql);

            return $this->db->registros();
        }

        public function aceptar($idUsuPermiso){
            $this->db->query("UPDATE tipoPermiso_has_usuario SET id_estado=:id_estado WHERE idPermisoUsuario = $idUsuPermiso");
    
            $this->db->bind(':id_estado',1);
    
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function denegar($idUsuPermiso){
            $this->db->query("UPDATE tipoPermiso_has_usuario SET id_estado=:id_estado WHERE idPermisoUsuario = $idUsuPermiso");
    
            $this->db->bind(':id_estado',2);
    
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

    }
?>