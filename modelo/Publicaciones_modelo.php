<?php

class Publicaciones_modelo {

    private $listaPublicaciones;
    private $db;

    function __construct() {
        try {
            require_once(dirname(__FILE__) . '\Conexion.php');
            $conectar = new Conexion();
            $this->db = $conectar->ObtenerConexion();
        } catch (Exception $ex) {
            die('Error' . $ex->getMessage());
            echo 'Línea del error: ' . $ex->getLine();
        }
    }

    function getListaPublicaciones() {
        return $this->listaPublicaciones;
    }

    function recopilarPublicaciones() {
        $listaPublicaciones=array();
        $sqlConsultarUsuario = "SELECT * FROM publicaciones";
        $resultado = $this->db->prepare($sqlConsultarUsuario);
        $resultado->execute(array());
        $registro = $resultado->fetch(PDO::FETCH_ASSOC);
        $this->listaPublicaciones=$registro;
    }
    function mostrarPublicaciones() {
        
    }

}
