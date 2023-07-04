<?php
	session_start();
	require_once('conexion.php');
	class validateUsers{
		private $usuario;
		private $clave;

		public function __construct(){
			$this->conexion = new Conexion();
			date_default_timezone_set('UTC'); 
			date_default_timezone_set("America/Buenos_Aires");
		}

		public function validateUsr($usuario, $clave){
			$this->usuario = $usuario;
			$this->clave = $clave;

			/*Buscar usuario*/
			$queryGetUser = "SELECT u.id as id_usuario, u.usuario, u.email, u.clave, u.tipo, u.activo, COUNT(ue.email) AS cant_direcciones, SUM(ue.validado) as cant_validados FROM usuarios u LEFT JOIN usuarios_email ue ON ue.id_usuario=u.id WHERE u.usuario = '$this->usuario'";// AND (ue.validado=1 OR ue.validado IS NULL)
			$getUser = $this->conexion->consultaRetorno($queryGetUser);

			if($getUser->num_rows == 0){
				echo "El usuario no existe";
			}else{
				$userRows = $getUser->fetch_assoc();
				/*Verificamos que la contraseña admin sea correcta*/
					if($this->clave == $userRows['clave']){
							/*Verificamos si está activo*/
							if ($userRows['activo'] > 0) {
								$_SESSION['rowUsers'] = $userRows;
								echo "1";
							}else{
								echo "El usuario no está activo";
							}
					}else{
						echo "Contraseña incorrecta</br>";
					}
			}
		}
	}

	if ($_POST['accion']) {
		$validateUs = new validateUsers();
		switch ($_POST['accion']) {
      case 'validateUser':
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $validateUs->validateUsr($usuario, $clave);
        break;
      
      default:
        // code...
        break;
    }

	}

	
?>