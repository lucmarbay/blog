<?php
    
    class Usuario_controlador{
        private $usuario_modelo;
        private $usuario_vista; 
        
        function Usuario_controlador(){
            require_once(dirname(__FILE__).'\..\modelo\Usuario_modelo.php');
            require_once(dirname(__FILE__).'\..\vista\Usuario_vista.php');
            
            $this->usuario_vista= new Usuario_vista();
        }
        
        function verificarUsuario(){
            $this->usuario_vista->mostrarLogin();
            if($_SESSION){
                
            }
        }
        
        function registrarUsuario(){
            $this->usuario_vista->mostrarRegistro();
            if(isset($_REQUEST['emailRegistro']) && isset($_REQUEST['passwordRegistro']) && isset($_REQUEST['nombreRegistro']) && isset($_REQUEST['fechaRegistro']) && isset($_REQUEST['sexoRegistro']) && $_FILES['fotoRegistro']['error'] === UPLOAD_ERR_OK){
                $contrasenia= $_REQUEST["passwordRegistro"];
                $pass_cifrado= password_hash($contrasenia, PASSWORD_DEFAULT);
                $nombreFoto=$_FILES['fotoRegistro']['name'];
                $carpetaImagen=$_SERVER['DOCUMENT_ROOT'].'/blog/imagen/';
                move_uploaded_file($_FILES['fotoRegistro']['tmp_name'], $carpetaImagen.$nombreFoto);
                $this->usuario_modelo= new Usuario_modelo($_REQUEST['emailRegistro'], $pass_cifrado, $_REQUEST['nombreRegistro'], $_REQUEST['fechaRegistro'], $_REQUEST['sexoRegistro'], $nombreFoto);
                $this->usuario_modelo->insertarUsuario();
            } else {
                echo 'No se ha podido realizar el registro.';
            }
        }
    }