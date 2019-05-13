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
                margin-left: 42%;     
            }
            #registrar{
                margin-left: 35%;
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
        ?>
        <h1>INICIAR SESION</h1>
        <hr size="1px" color="black" />
        <form id="iniciar" action="contenido.php" method="post">
            Email: <input type="email" required="required" placeholder="Introduce Email"><br>
            Password: <input type="text" required="required" placeholder="Introduce Password"><br>
            <input type="submit" value="Entrar">
        </form>
        <h1>REGISTRO DE NUEVO USUARIO</h1>
        <hr size="1px" color="black" />
        <form id="registrar" action="registro.php" method="post">
            Email: <input type="email" required="required" placeholder="Introduce Email"><br>
            Password: <input type="text" required="required" placeholder="Introduce Password"><br>
            Nombre: <input type="text" required="required" placeholder="Introduce tu Nombre"><br>
            Fecha de nacimiento: <input type="date" required="required"><br>
            Sexo: <select name="sexo">
                <option value="0">Masculino</option>
                <option value="1">Femenino</option>
                </select><br>
            Foto: <input type="file"><br>
            <input type="submit" value="Registrar">
        </form>
    </body>
</html>
