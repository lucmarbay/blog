<?php

class Usuario_controlador {

    private $usuario_modelo;
    private $usuario_vista;

    function Usuario_controlador() {
        require_once(dirname(__FILE__) . '\..\modelo\Usuario_modelo.php');
        require_once(dirname(__FILE__) . '\..\vista\Usuario_vista.php');

        $this->usuario_vista = new Usuario_vista();
    }

    public function verificarUsuario() {
        try {
            $this->usuario_vista->mostrarLogin();
            if (isset($_REQUEST['nombreLogin']) && isset($_REQUEST['passwordLogin'])) {
                $email = htmlentities(addslashes($_REQUEST['nombreLogin']));
                $password = htmlentities(addslashes($_REQUEST['passwordLogin']));
                $this->usuario_modelo= new Usuario_modelo($email, $password);
                if($this->usuario_modelo->verificarUsuario()){
                    $_SESSION['usuario']=$email;
                    header("Location:contenido.php");
                } else{
                    echo 'Usuario no registrado';
                }
            }
        } catch (Exception $ex) {
            die('Error' . $ex->getMessage());
            echo 'Línea del error: ' . $ex->getLine();
        }
    }

    public function registrarUsuario() {
        $this->usuario_vista->mostrarRegistro();
        if (isset($_REQUEST['emailRegistro']) && isset($_REQUEST['passwordRegistro']) && isset($_REQUEST['nombreRegistro']) && isset($_REQUEST['fechaRegistro']) && isset($_REQUEST['sexoRegistro']) && $_FILES['fotoRegistro']['error'] === UPLOAD_ERR_OK) {
            $contrasenia = htmlentities(addslashes($_REQUEST["passwordRegistro"]));
            $pass_cifrado = password_hash($contrasenia, PASSWORD_DEFAULT);
            $nombreFoto = $_FILES['fotoRegistro']['name'];
            $carpetaImagen = $_SERVER['DOCUMENT_ROOT'] . '/blog/imagen/';
            move_uploaded_file($_FILES['fotoRegistro']['tmp_name'], $carpetaImagen . $nombreFoto);
            $this->usuario_modelo = new Usuario_modelo($_REQUEST['emailRegistro'], $pass_cifrado, $_REQUEST['nombreRegistro'], $_REQUEST['fechaRegistro'], $_REQUEST['sexoRegistro'], $nombreFoto);
            $this->usuario_modelo->insertarUsuario();
            echo 'Registro realizado correctamente';
        }
        
    }
    public function mantenerUsuario_modelo($usuario) {
        $this->usuario_modelo= new Usuario_modelo($usuario);
    }
    
    public function mostrarCabecera(){
        $nombre=  $this->usuario_modelo->getNombre();
        $foto=  $this->usuario_modelo->getFoto();
        $this->usuario_vista->mostrarCabecera($nombre, $foto);
    }
    function getUsuario_modelo() {
        return $this->usuario_modelo;
    }
    function publicarPublicacion() {
        $this->usuario_vista->publicarComentario();
        if(isset($_REQUEST['publicacion'])){
            $publicacion=htmlentities(addslashes($_REQUEST['publicacion']));
            $this->usuario_modelo= new Usuario_modelo($_SESSION['usuario']);
            $this->usuario_modelo->insertarPublicacion($publicacion);
        }
    }

}
