<?php

class Publicaciones_vista{
    function mostrarPublicaciones($foto, $nombre, $fecha, $texto,$numComentarios){
        echo "<img class='avatarPublicacion' alt='".$foto."' src='/blog/imagen/".$foto."' width='70px'><p>$nombre</p>"
                . "<p>$fecha</p></br>"
                . "<p class='textoPublicacion'>$texto</p></br>"
                . "<p>Tienes ".$numComentarios." comentarios</p>";
    }
}
