<?php

class Publicaciones_controlador{
    private $publicacionesModelo;
    private $publicacionesVista;
    
    function __construct() {
        require_once(dirname(__FILE__) . '\..\modelo\Publicaciones_modelo.php');
        require_once(dirname(__FILE__) . '\..\vista\Publicaciones_vista.php');
        $this->publicacionesModelo= new Publicaciones_modelo();
        $this->publicacionesVista= new Publicaciones_vista();
    }
    function mostrarPublicacionesInicio(){
        $this->publicacionesModelo->recopilarPublicacionesInicio();
        $array= $this->publicacionesModelo->mostrarPublicacionesInicio();
        foreach ($array as $key => $value) {
            //Tengo que guardar el array con los datos de esta publicacion en las variables que paso por parametros en el metodo de abajo
        }
        $this->publicacionesVista->mostrarPublicaciones($foto, $nombre, $fecha, $texto, $numComentarios);
    }
}