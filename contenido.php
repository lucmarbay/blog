<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            
        </style>
    </head>
    <body>
        <?php
        session_start();
        if(!isset($_SESSION['usuario'])){
            header("Location:index.php");
        }
        require_once(dirname(__FILE__).'\controlador\Usuario_controlador.php'); 
        $usuarioControlador=new Usuario_controlador();
        $usuarioControlador->mantenerUsuario_modelo($_SESSION['usuario']);
        $usuarioControlador->mostrarCabecera();
        ?>
        
    </body>
</html>