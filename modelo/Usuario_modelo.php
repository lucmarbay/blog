<?php

class Usuario_modelo{
    private $db;
    private $email;
    private $password;
    private $nombre;
    private $fechaNacimiento;
    private $sexo;
    private $foto;
    
    public function __construct($email, $password, $nombre, $fechaNacimiento, $sexo, $foto) {
        require_once(dirname(__FILE__).'\Conexion.php');
        $conectar=new Conexion();
        $this->db=$conectar->ObtenerConexion();
        $this->email=$email;
        $this->password=$password;
        $this->nombre=$nombre;
        $this->fechaNacimiento=$fechaNacimiento;
        $this->sexo=$sexo;
        $this->foto=$foto;
    }
    
    public function insertarUsuario() {
        try{
            $sql="INSERT INTO usuarios (email, pass, fechanac, nombre, sexo, foto) VALUES (:email, :pass, :fechanac, :nombre, :sexo, :foto)";
            $insertar = $this->db->prepare($sql);
            $insertar->execute(array(":email"=>$this->email, ":pass"=>$this->password, ":nombre"=>$this->nombre, ":fechanac"=>$this->fechaNacimiento, ":sexo"=>$this->sexo, ":foto"=>$this->foto));
        } catch (Exception $ex) {
            die('Error' . $ex->getMessage());
            echo 'Línea del error: '.$ex->getLine();
        }
        
    }
    
}