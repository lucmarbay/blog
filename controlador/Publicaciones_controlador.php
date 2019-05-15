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
    function mostrarPublicaciones(){
        $this->publicacionesModelo->recopilarPublicaciones();
        
    }
}