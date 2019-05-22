<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
        <?php
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location:index.php");
        }
        require_once(dirname(__FILE__) . '\controlador\Usuario_controlador.php');
        require_once(dirname(__FILE__) . '\controlador\Publicaciones_controlador.php');
        $usuarioControlador = new Usuario_controlador();
        $publicacionesControlador = new Publicaciones_controlador();
        $usuarioControlador->mantenerUsuario_modelo($_SESSION['usuario']);
        $usuarioControlador->mostrarCabecera();
        ?>
        <div class="cuerpoCentral">
            <?php
            $publicacionesControlador->paginacion();
            ?>
        </div>
    </body>
</html>