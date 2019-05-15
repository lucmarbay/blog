<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .divTitulo{
                position: fixed;
                top: 5px;
                left: 5px;
                float: left;
                width: 200px;
            }
            .divUsuario{
                position: fixed;
                top: 5px;
                right: 5px;
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
                position: fixed;
                top: 200px;
                right: 200px;
                left: 200px;
            }
            .textoPublicacion{
                background-color: 8cfbf3;
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
        require_once(dirname(__FILE__) . '\controlador\Publicaciones_controlador.php');
        $usuarioControlador = new Usuario_controlador();
        $publicacionesControlador = new Publicaciones_controlador();
        $usuarioControlador->mantenerUsuario_modelo($_SESSION['usuario']);
        $usuarioControlador->mostrarCabecera();
        ?>
        <div class="cuerpoCentral">
            <?php
            $usuarioControlador->publicarPublicacion();
            $publicacionesControlador->mostrarPublicacionesInicio();
            ?>

        </div>
        



    </body>
</html>