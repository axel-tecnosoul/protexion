<?php
	session_start();
	include_once('conexion.php');

	class RedirUsuarios{

		public function __construct(){
			$this->conexion = new Conexion();
			date_default_timezone_set('UTC'); 
			date_default_timezone_set("America/Buenos_Aires");
		}

		public function redir_admin(){
			//header('Location: ../home_users.php');
      header('Location: ../empresas.php');
		}

    public function redir_cliente(){
			header('Location: ../cliente.php');
		}

	}

	if (isset($_SESSION['rowUsers']['tipo'])) {

		$redirUsuarios = new RedirUsuarios();

		switch ($_SESSION['rowUsers']['tipo']) {
      case 1:
        $redirUsuarios->redir_admin();
        break;

      default:
        $redirUsuarios->redir_cliente();
        break;
    }
	}else{
		header('Location: ../login.php');
	}
	

?>