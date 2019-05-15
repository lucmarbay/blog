<?php

class Usuario_vista{
    function mostrarLogin() {
        echo '<h1>INICIAR SESION</h1>
        <hr size="1px" color="black" />
        <form id="iniciar" action="index.php" method="post">
            Email: <input type="email" name="nombreLogin" required="required" placeholder="Introduce Email"><br>
            Password: <input type="text" name="passwordLogin" required="required" placeholder="Introduce Password"><br>
            <input type="submit" value="Entrar">
        </form>';
    }
    function mostrarRegistro(){
        echo '<h1>REGISTRO DE NUEVO USUARIO</h1>
        <hr size="1px" color="black" />
        <form id="registrar" action="index.php" method="post" enctype="multipart/form-data">
            Email: <input type="email" name="emailRegistro" required="required" placeholder="Introduce Email"><br>
            Password: <input type="text" name="passwordRegistro" required="required" placeholder="Introduce Password"><br>
            Nombre: <input type="text" name="nombreRegistro" required="required" placeholder="Introduce tu Nombre"><br>
            Fecha de nacimiento: <input type="date" name="fechaRegistro" required="required"><br>
            Sexo: <select name="sexoRegistro">
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                </select><br>
            Foto: <input type="file" name="fotoRegistro"><br>
            <input type="submit" value="Registrar">
        </form>';
    }
    function mostrarCabecera($nombre, $foto) {
        echo "<div class='divTitulo'><h1>Blog #Práctica PHP</h1><button class='botonInicio'><a class='enlaceInicio' href='contenido.php'>Inicio</a></button></div>
        <div class='divUsuario'><img class='avatar' alt='".$foto."' src='/blog/imagen/".$foto."' width='100px'><p>$nombre</p><a href='logout.php'>Cerrar Sesion</a></div>";
    }
    function publicarComentario() {
        echo '<hr size="1px" color="black" />
        <form action="contenido.php" method="POST">
            <textarea rows="4" cols="50" name="publicacion">¿Qué estas pensando?</textarea></br>
            <input class="botonDerecha" type="submit" value="Publicar">
        </form></br>
        <hr size="1px" color="black" />';
    }
}