<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            body{
                text-align: center;
            }
            #iniciar{
                text-align: center;
            }
            #registrar{
                text-align: center;
            }
            form{
                margin-top: 40px;
                text-align: left;
            }
        </style>
    </head>
    <body>
        <?php
        session_start();
        require_once(dirname(__FILE__).'\modelo\Conexion.php');
        require_once(dirname(__FILE__).'\controlador\Usuario_controlador.php');
        $conectar=new Conexion();
        $conectar->crearBaseDeDatosBlog();
        $conectar->crearTablasBlog();
        $usuario_controlador=new Usuario_controlador();
        $usuario_controlador->verificarUsuario();
        $usuario_controlador->registrarUsuario();
        ?>
        
    </body>
</html>
