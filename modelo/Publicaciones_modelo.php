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

    function hacerYMostrarComentarios($idpub) {
        $this->hacerComentario($idpub);
        $this->insertarComentarios($idpub);
        $this->mostrarComentarios($idpub);
    }

    function hacerComentario($idpub) {
        echo '<hr size="1px" color="black" />
        <form action="contenido.php" method="POST">
            <textarea rows="2" cols="30" name="comentario' . $idpub . '">¿Qué opinas?</textarea></br>
            <input class="botonDerecha" type="submit" value="Comentar">
        </form></br>
        <hr size="1px" color="black" />';
    }

    function insertarComentarios($idpub) {
        try {
            if (isset($_REQUEST['comentario' . $idpub . ''])) {
                $comentario = htmlentities(addslashes($_REQUEST['comentario' . $idpub . '']));
                $sqlComentario = "INSERT INTO comentarios (idpub, texto, email, fecha) VALUES (:idpub, :texto, :email, :fecha)";
                $insertar = $this->db->prepare($sqlComentario);
                date_default_timezone_set('Europe/Madrid');
                $fecha = date('Y-m-d H:i:s');
                $email = $_SESSION['usuario'];
                $insertar->execute(array(":idpub" => $idpub, ":email" => $email, ":texto" => $comentario, "fecha" => $fecha));
            }
        } catch (Exception $ex) {
            die('Error' . $ex->getMessage());
            echo 'Línea del error: ' . $ex->getLine();
        }
    }

    function mostrarComentarios($idpub) {
        try {
            
        } catch (Exception $ex) {
            die('Error' . $ex->getMessage());
            echo 'Línea del error: ' . $ex->getLine();
        }
    }

    function recopilarPublicacionesInicio() {
        try {
            
            $sqlConsultarUsuario = "SELECT * FROM publicaciones ORDER BY fecha DESC LIMIT 0,3"; //
            $resultado = $this->db->prepare($sqlConsultarUsuario);
            $resultado->execute(array());
            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $foto = "";
                $nombre = "";
                $numComentarios = "0"; //Tengo que hacer un inner join para sacar el numero de comentarios
                $fecha = $registro['fecha'];
                $email = $registro['email'];
                $texto = $registro['texto'];
                $idpub = $registro['idpub'];
                $sql = "SELECT nombre, foto FROM usuarios WHERE email=:email;";
                $resultado2 = $this->db->prepare($sql);
                $resultado2->execute(array(":email" => $email));
                while ($registro2 = $resultado2->fetch(PDO::FETCH_ASSOC)) {
                    $nombre = $registro2['nombre'];
                    $foto = $registro2['foto'];
                }
                echo "<img class='avatarPublicacion' alt='" . $foto . "' src='/blog/imagen/" . $foto . "' width='70px'><p><b>$nombre</b></p>"
                . "<p>$fecha</p>"
                . "<p class='textoPublicacion'>$texto</p>"
                . "<p><b>Tienes " . $numComentarios . " comentarios</b></p></br>";
                $this->hacerYMostrarComentarios($idpub);
            }
        } catch (Exception $ex) {
            die('Error' . $ex->getMessage());
            echo 'Línea del error: ' . $ex->getLine();
        }
    }

}
