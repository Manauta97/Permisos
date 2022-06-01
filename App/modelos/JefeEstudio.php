<?php

    class JefeEstudio {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        public function obtenerPermisosUsuario(){
            $this->db->query("SELECT descripcionPermiso, nombre, apellidos, nombreDocumento, fechaInicio, fechaFin, nombreEstado  FROM tipoPermiso_has_usuario 
            inner join tipoPermiso
            on tipoPermiso_has_usuario.idTipoPermiso = tipoPermiso.idTipoPermiso
            inner join usuarios
            on tipoPermiso_has_usuario.id_usuario = usuarios.id_usuario
            inner join estados
            on tipoPermiso_has_usuario.id_estado = estados.id_estado
            ;");

            return $this->db->registros();
        }
    }
?>