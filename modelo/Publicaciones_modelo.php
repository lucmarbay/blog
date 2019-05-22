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
        echo '<div class="cuerpoComentarios">';
        $this->insertarComentarios($idpub);
        $this->mostrarComentarios($idpub);
        $this->hacerComentario($idpub);
        echo '</div>';
    }

    function hacerComentario($idpub) {
        try {
            $email = $_SESSION['usuario'];
            $sqlFoto = "SELECT foto FROM usuarios WHERE email=:email";
            $resultado = $this->db->prepare($sqlFoto);
            $resultado->execute(array(":email" => $email));
            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $foto = $registro['foto'];
            }
            echo '
            <form action="contenido.php" method="POST">
            <img class="avatar" alt="' . $foto . '" src="/blog/imagen/' . $foto . '" width="50px">
            <textarea rows="2" cols="30" name="comentario' . $idpub . '">¿Qué opinas?</textarea></br>
            <input class="botonDerecha" type="submit" value="Comentar">
            </form></br>
            <hr size="1px" color="black" />';
        } catch (Exception $ex) {
            die('Error' . $ex->getMessage());
            echo 'Línea del error: ' . $ex->getLine();
        }
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
            $sqlComentarios = "SELECT * FROM comentarios WHERE idpub=:idpub"; //
            $resultado = $this->db->prepare($sqlComentarios);
            $resultado->execute(array(":idpub" => $idpub));
            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {

                $foto = "";
                $nombre = "";
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
                echo "<img class='avatarComentario' alt='" . $foto . "' src='/blog/imagen/" . $foto . "' width='40px'> <b>$nombre</b>"
                . " $fecha"
                . "<p class='textoComentario'>$texto</p><hr size='1px' color='black' />";
            }
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
                $numComentarios = "0";
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

                $sql = "SELECT COUNT(*) FROM comentarios WHERE idpub=$idpub;";
                $resultado3 = $this->db->prepare($sql);
                $resultado3->execute(array());
                $numComentarios = $resultado3->fetchColumn();

                echo "<img class='avatarPublicacion' alt='" . $foto . "' src='/blog/imagen/" . $foto . "' width='70px'> <b>$nombre</b>"
                . " $fecha</br>"
                . "<p class='textoPublicacion'>$texto</p>"
                . "<p><b>Tiene " . $numComentarios . " comentarios</b></p><hr size='1px' color='black' />";
                $this->hacerYMostrarComentarios($idpub);
            }
        } catch (Exception $ex) {
            die('Error' . $ex->getMessage());
            echo 'Línea del error: ' . $ex->getLine();
        }
    }

    function paginacion() {
        try {
            $tamanio_paginas = 3;
            if (isset($_GET['pagina'])) {
                if ($_GET['pagina'] == 1) {
                    header("Location: paginacion.php");
                } else {
                    $pagina = $_GET['pagina'];
                }
            } else {
                $pagina = 1;
            }
            $empezar_desde = ($pagina - 1) * $tamanio_paginas;

            $sqlContar = "SELECT * FROM publicaciones";
            $resultado = $this->db->prepare($sqlContar);
            $resultado->execute(array());
            $num_filas = $resultado->rowCount();
            $total_paginas = ceil($num_filas / $tamanio_paginas);

            $sqlPaginacion = "SELECT * FROM publicaciones ORDER BY fecha DESC LIMIT $empezar_desde, $tamanio_paginas";
            $resultado2 = $this->db->prepare($sqlPaginacion);
            $resultado2->execute(array());
            while ($registro = $resultado2->fetch(PDO::FETCH_ASSOC)) {
                $fecha = $registro['fecha'];
                $email = $registro['email'];
                $texto = $registro['texto'];
                $idpub = $registro['idpub'];
                $sql = "SELECT nombre, foto FROM usuarios WHERE email=:email;";
                $resultado3 = $this->db->prepare($sql);
                $resultado3->execute(array(":email" => $email));
                while ($registro2 = $resultado3->fetch(PDO::FETCH_ASSOC)) {
                    $nombre = $registro2['nombre'];
                    $foto = $registro2['foto'];
                }
                $sql = "SELECT COUNT(*) FROM comentarios WHERE idpub=$idpub;";
                $resultado4 = $this->db->prepare($sql);
                $resultado4->execute(array());
                $numComentarios = $resultado4->fetchColumn();

                echo"<img class='avatarPublicacion' alt='" . $foto . "' src='/blog/imagen/" . $foto . "' width='70px'> <b>$nombre</b>"
                . " $fecha</br>"
                . "<p class='textoPublicacion'>$texto</p>"
                . "<p><b>Tiene " . $numComentarios . " comentarios</b></p><hr size='1px' color='black' />";
                $this->hacerYMostrarComentarios($idpub);
            }
            for ($i = 1; $i <= $total_paginas; $i++) {
                echo '<a href="?paginacion="' . $i . '">' . $i . '</a> ';
            }
        } catch (Exception $ex) {
            die('Error' . $ex->getMessage());
            echo 'Línea del error: ' . $ex->getLine();
        }
    }

}
