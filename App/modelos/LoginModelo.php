<?php

    class LoginModelo {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }


        public function loginUsu($usuario){
       
            $this->db->query("SELECT * FROM usuarios WHERE dni = :dni" );
            $this->db->bind(':dni',$usuario);
           
            return $this->db->registro();
        }
    }
