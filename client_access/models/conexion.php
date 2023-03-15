<?php
	class Conexion{
    //LOCAL
		private $host = "localhost";
		private $user = "root";
		private $pass = "";
		private $db = "salud_web";

    //WEB
    /*private $host = "localhost";
		private $user = "protex";
		private $pass = "<SoloLaSaVePr2022>";
		private $db = "protex_client_access";*/
    
		public $conectar;

		public function __construct(){
			$this->conectar = new mysqli($this->host, $this->user, $this->pass, $this->db);
		}

		public function consultaSimple($sql){
      $this->conectar->set_charset("utf8");
			$this->conectar->query($sql);
		}

		public function consultaRetorno($sql){
      $this->conectar->set_charset("utf8");
			$datos = $this->conectar->query($sql);
			return $datos;
		}
	}
?>