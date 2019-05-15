<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .divTitulo{
                float: left;
                width: 200px;
            }
            .divUsuario{
                float: right;
                width: 200px;
            }
            .avatar{
                position: relative;
            }
            a.enlaceInicio:link{
                text-decoration:none;
            }
            .botonDerecha{
                float: right;
            }
            .cuerpoCentral{

            }
        </style>
    </head>
    <body>
        <?php
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location:index.php");
        }
        require_once(dirname(__FILE__) . '\controlador\Usuario_controlador.php');
        $usuarioControlador = new Usuario_controlador();
        $usuarioControlador->mantenerUsuario_modelo($_SESSION['usuario']);
        $usuarioControlador->mostrarCabecera();
        ?>
        <div class="cuerpoCentral">
            <?php
            $usuarioControlador->publicarPublicacion();
            $usuarioControlador->mostrarPublicaciones();
            ?>

        </div>




    </body>
</html>