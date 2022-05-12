<?php

    class Permiso{
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        public function obtenerTipoPermiso(){

            $this->db->query("SELECT * FROM tipoPermiso");
            return $this->db->registros();

        }




    }