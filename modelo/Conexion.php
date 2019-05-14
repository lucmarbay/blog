<?php

class Conexion {
    public function Conexion(){
        
    }
    public function ObtenerConexion() {
        try {
            $conexion = new PDO('mysql:host=localhost; dbname=blog', 'root', '');
            $conexion->exec("SET CHARACTER SET UTF8");
        } catch (Exception $ex) {
            die("Error " . $ex->getMessage());
            echo 'Linea del error' . $ex->getLine();
        }
        return $conexion;
    }

    public function crearBaseDeDatosBlog() {
        try {
            $conexion = new PDO('mysql:host=localhost;', 'root', '');
            $conexion->exec("SET CHARACTER SET UTF8");
            $sqlCrearBBDD = 'CREATE DATABASE IF NOT EXISTS blog';
            $resultado = $conexion->prepare($sqlCrearBBDD);
            $resultado->execute(array());
            $resultado->closeCursor();
        } catch (Exception $ex) {
            die("Error " . $ex->getMessage());
            echo 'Linea del error' . $ex->getLine();
        }
    }

    public function crearTablasBlog() {
        try {
            $conexion = new PDO('mysql:host=localhost; dbname=blog', 'root', '');
            $conexion->exec("SET CHARACTER SET UTF8");
            $sqlUsuarios = 'CREATE TABLE IF NOT EXISTS usuarios (email VARCHAR(50) PRIMARY KEY NOT NULL, pass VARCHAR(255), fechanac DATE, nombre VARCHAR(30), sexo VARCHAR(30), foto VARCHAR(300));';
            $sqlPublicaciones = 'CREATE TABLE IF NOT EXISTS publicaciones (idpub INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT, email VARCHAR(50), texto VARCHAR(200), fecha TIMESTAMP, CONSTRAINT fk_emailPublicaciones FOREIGN KEY (email) REFERENCES usuarios(email));';
            $sqlComentarios = 'CREATE TABLE IF NOT EXISTS comentarios (idcom INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT, idpub INTEGER, texto VARCHAR(200), email VARCHAR(50), fecha TIMESTAMP, CONSTRAINT fk_emailComentarios FOREIGN KEY (email) REFERENCES usuarios(email), CONSTRAINT fk_idpub FOREIGN KEY (idpub) REFERENCES publicaciones(idpub));';
            $resultado = $conexion->prepare($sqlUsuarios);
            $resultado->execute(array());
            $resultado = $conexion->prepare($sqlPublicaciones);
            $resultado->execute(array());
            $resultado = $conexion->prepare($sqlComentarios);
            $resultado->execute(array());
            $resultado->closeCursor();
        } catch (Exception $ex) {
            die("Error " . $ex->getMessage());
            echo 'Linea del error' . $ex->getLine();
        }
    }

}
