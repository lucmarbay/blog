<?php

class Publicaciones_vista{
    function mostrarPublicaciones($array){
        $foto=$array[0];
        $nombre=$array[1];
        $fecha=$array[2];
        $texto=$array[3];
        $numComentarios=$array[4];
        echo "<img class='avatarPublicacion' alt='".$foto."' src='/blog/imagen/".$foto."' width='70px'><p>$nombre</p>"
                . "<p>$fecha</p></br>"
                . "<p class='textoPublicacion'>$texto</p></br>"
                . "<p>Tienes ".$numComentarios." comentarios</p>";
    }
    function enlacePaginacion() {
        echo '<a href="paginacion.php">MOSTRAR PUBLICACIONES ANTIGUAS</a>';
    }
}
