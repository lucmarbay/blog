<?php

class Usuario_modelo {

    private $db;
    private $email;
    private $password;
    private $nombre;
    private $fechaNacimiento;
    private $sexo;
    private $foto;

    public function __construct() {
        $params = func_get_args();
        $num_params = func_num_args();
        $funcion_constructor = '__construct' . $num_params;
        if (method_exists($this, $funcion_constructor)) {
            call_user_func_array(array($this, $funcion_constructor), $params);
        }
    }

    public function __construct1($email) {
        try {
            require_once(dirname(__FILE__) . '\Conexion.php');
            $conectar = new Conexion();
            $this->db = $conectar->ObtenerConexion();
            $this->email = $email;
            //Cargamos el id del usuario
            $sqlConsultarUsuario = "SELECT * FROM usuarios WHERE email= :email";
            $resultado = $this->db->prepare($sqlConsultarUsuario);
            $resultado->execute(array(":email" => $this->email));
            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $this->password = $registro['pass'];
                $this->nombre = $registro['nombre'];
                $this->fechaNacimiento = $registro['fechanac'];
                $this->sexo = $registro['sexo'];
                $this->foto = $registro['foto'];
            }
        } catch (Exception $ex) {
            die('Error' . $ex->getMessage());
            echo 'Línea del error: ' . $ex->getLine();
        }
    }

    public function __construct2($email, $password) {
        try {
            require_once(dirname(__FILE__) . '\Conexion.php');
            $conectar = new Conexion();
            $this->db = $conectar->ObtenerConexion();
            $this->email = $email;
            $this->password = $password;
            //Cargamos el id del usuario
            $sqlConsultarUsuario = "SELECT * FROM usuarios WHERE email= :email";
            $resultado = $this->db->prepare($sqlConsultarUsuario);
            $resultado->execute(array(":email" => $this->email));
            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $this->nombre = $registro['nombre'];
                $this->fechaNacimiento = $registro['fechanac'];
                $this->sexo = $registro['sexo'];
                $this->foto = $registro['foto'];
            }
        } catch (Exception $ex) {
            die('Error' . $ex->getMessage());
            echo 'Línea del error: ' . $ex->getLine();
        }
    }

    public function __construct6($email, $password, $nombre, $fechaNacimiento, $sexo, $foto) {
        require_once(dirname(__FILE__) . '\Conexion.php');
        $conectar = new Conexion();
        $this->db = $conectar->ObtenerConexion();
        $this->email = $email;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->sexo = $sexo;
        $this->foto = $foto;
    }

    function getEmail() {
        return $this->email;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getFoto() {
        return $this->foto;
    }

    public function insertarUsuario() {
        try {
            $sql = "INSERT INTO usuarios (email, pass, fechanac, nombre, sexo, foto) VALUES (:email, :pass, :fechanac, :nombre, :sexo, :foto)";
            $insertar = $this->db->prepare($sql);
            $insertar->execute(array(":email" => $this->email, ":pass" => $this->password, ":nombre" => $this->nombre, ":fechanac" => $this->fechaNacimiento, ":sexo" => $this->sexo, ":foto" => $this->foto));
        } catch (Exception $ex) {
            die('Error' . $ex->getMessage());
            echo 'Línea del error: ' . $ex->getLine();
        }
    }

    public function verificarUsuario() {
        try {
            $existeUsuario = false;
            $sqlConsultarUsuario = "SELECT * FROM usuarios WHERE email= :email";
            $resultado = $this->db->prepare($sqlConsultarUsuario);
            $resultado->execute(array(":email" => $this->email));
            while ($registro = $resultado->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($this->password, $registro['pass'])) {
                    $existeUsuario = true;
                }
            }
            return $existeUsuario;
        } catch (Exception $ex) {
            die('Error' . $ex->getMessage());
            echo 'Línea del error: ' . $ex->getLine();
        }
    }

    public function insertarPublicacion($publicacion) {
        try {
            $sqlPublicacion = "INSERT INTO publicaciones (email, texto, fecha) VALUES (:email, :texto, :fecha)";
            $insertar = $this->db->prepare($sqlPublicacion);
            date_default_timezone_set('Europe/Madrid');
            $fecha =date('Y-m-d H:i:s');
            $insertar->execute(array(":email" => $this->email, ":texto" => $publicacion, "fecha" => $fecha));
        } catch (Exception $ex) {
            die('Error' . $ex->getMessage());
            echo 'Línea del error: ' . $ex->getLine();
        }
    }

}
