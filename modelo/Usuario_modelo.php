<?php

class Usuario_modelo{
    private $db;
    private $usuario;
    
    public function __construct() {
        require 'Conectar.php';
        $this->db=Conectar::Conectar();
    }
    
    public function insertarUsuario($usuario) {
        $sql="INSERT INTO usuarios (email) VALUES (:email)";
        $insertar = $this->db->prepare($sql);
        $resultado->execute(array(":email"=> $usuario->email));
    }
    
}