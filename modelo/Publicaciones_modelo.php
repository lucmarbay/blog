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

    function recopilarPublicacionesInicio() {
        $listaPublicaciones=array();
        $sqlConsultarUsuario = "SELECT * FROM publicaciones ORDER BY fecha DESC LIMIT 0,3";
        $resultado = $this->db->prepare($sqlConsultarUsuario);
        $resultado->execute(array());
        $registro = $resultado->fetch(PDO::FETCH_ASSOC);
        $this->listaPublicaciones=$registro;
    }
    function mostrarPublicacionesInicio() {
        while($this->listaPublicaciones){
            $foto="";
            $nombre="";
            $numComentarios= "0";//Tengo que hacer un inner join para sacar el numero de comentarios
            $fecha= $this->listaPublicaciones['fecha'];
            $email= $this->listaPublicaciones['email'];
            $sql="SELECT nombre, foto FROM usuarios WHERE email=:email;";
            $resultado = $this->db->prepare($sql);
            $resultado->execute(array(":email" => $email));
            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)){
                $nombre=$registro['nombre'];
                $foto=$registro['foto'];
            }
            $datosPublicacion=array($foto, $nombre, $fecha, $texto,$numComentarios);
            return $datosPublicacion;
        }
    }

}
