<?php

    class Admin {
        private $db;

        public function __construct(){
            $this->db = new Base;
        }

        public function obtenerUsuarios(){
            $this->db->query("SELECT * FROM usuarios");

            return $this->db->registros();
        }

        public function obtenerTipoPermiso(){

            $this->db->query("SELECT * FROM tipoPermiso");
            return $this->db->registros();
        }

        public function obtenerRoles(){
            $this->db->query("SELECT * FROM roles");

            return $this->db->registros();
        }

        public function obtenerEstados(){
            $this->db->query("SELECT * FROM estados");

            return $this->db->registros();
        }

        public function agregarUsuario($datos){
            $this->db->query("INSERT INTO usuarios (nombre, apellidos, dni, centro, especialidad, nrp, localidad, id_rol) 
                                        VALUES (:nombre, :apellidos, :dni, :centro, :especialidad, :nrp, :localidad, :id_rol)");
            //vinculamos los valores
            $this->db->bind(':nombre',$datos['nombre']);
            $this->db->bind(':apellidos',$datos['apellidos']);
            $this->db->bind(':dni',$datos['dni']);
            $this->db->bind(':centro',strtolower($datos['centro']));
            $this->db->bind(':especialidad',$datos['especialidad']);
            $this->db->bind(':nrp',$datos['nrp']);
            $this->db->bind(':localidad',$datos['localidad']);
            $this->db->bind(':id_rol',$datos['id_rol']);

            //ejecutamos
            if($this->db->execute()){
                 return true;
             } else {
                 return false;
             }
        }

        public function agregarPermiso($datos){
            $this->db->query("INSERT INTO tipoPermiso (descripcionPermiso, codTipoPermiso) 
                                        VALUES (:descripcionPermiso, :codTipoPermiso)");

            //vinculamos los valores
            
            $this->db->bind(':descripcionPermiso',$datos['descripcionPermiso']);
            $this->db->bind(':codTipoPermiso',$datos['codTipoPermiso']);

            //ejecutamos
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function obtenerUsuarioId($id){
            $this->db->query("SELECT * FROM usuarios WHERE id_usuario = :id");
            $this->db->bind(':id',$id);

            return $this->db->registro();
        }

        public function obtenerPermisoId($id){
            $this->db->query("SELECT * FROM tipoPermiso WHERE idTipoPermiso = :id");
            $this->db->bind(':id',$id);

            return $this->db->registro();
        }

        //cambiar el where!!!!
        
        public function actualizarUsuario($datos){
            $this->db->query("UPDATE usuarios SET nombre=:nombre, apellidos=:apellidos, dni=:dni, centro=:centro, especialidad=:especialidad, nrp=:nrp, localidad=:localidad, id_rol=:id_rol
                                                WHERE id_usuario = :id");

            //vinculamos los valores
            $this->db->bind(':id',$datos['id_usuario']);
            $this->db->bind(':nombre',$datos['nombre']);
            $this->db->bind(':apellidos',$datos['apellidos']);

            $this->db->bind(':dni',$datos['dni']);
            $this->db->bind(':centro',strtolower($datos['centro']));
            $this->db->bind(':especialidad',$datos['especialidad']);
            $this->db->bind(':nrp',$datos['nrp']);

            $this->db->bind(':localidad',$datos['localidad']);
            $this->db->bind(':id_rol',$datos['id_rol']);

            //ejecutamos
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
        
        public function actualizarPermiso($datos){
            $this->db->query("UPDATE tipoPermiso SET descripcionPermiso=:descripcionPermiso, codTipoPermiso=:codTipoPermiso
                                                WHERE idTipoPermiso = :id"); //cambiar el where!!!!

            //vinculamos los valores
            $this->db->bind(':id',$datos['idTipoPermiso']);
            $this->db->bind(':descripcionPermiso',$datos['descripcionPermiso']);
            $this->db->bind(':codTipoPermiso',$datos['codTipoPermiso']);

            //ejecutamos
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }


        public function borrarUsuario($id){
            $this->db->query("DELETE FROM usuarios WHERE id_usuario = :id");
            $this->db->bind(':id',$id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function borrarPermiso($id){
            $this->db->query("DELETE FROM tipoPermiso WHERE idTipoPermiso = :id");
            $this->db->bind(':id',$id);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

///////////////////////////////////////////////// Sesion //////////////////////////////////////////////

        public function obtenerSesionesUsuario($id){
            $this->db->query("SELECT * FROM sesiones 
                                        WHERE id_usuario = :id
                                        ORDER BY fecha_inicio");
            $this->db->bind(':id',$id);

            return $this->db->registros();
        }


        public function cerrarSesion($id_sesion){
            $this->db->query("UPDATE sesiones SET fecha_fin = NOW()  
                                    WHERE id_sesion = :id_sesion");

            $this->db->bind(':id_sesion',$id_sesion);

            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
    }
