<?php

class Controller{

	#LLAMADA A LA PLANTILLA
	public function pagina(){
		include "views/template.php";
	}

	#ENLACES
	public  function enlacesPaginasController(){
		// si tiene algo la variable action
		if(isset( $_GET['action'])){
			$enlaces = $_GET['action'];
		}
		else{
			$enlaces = "index";
		}
		// Ejecuta la función  para devolver la url a la que se va a redireccionar
		$respuesta = Enlaces::enlacesPaginasModel($enlaces);

		include $respuesta;
	}

	public function registroUsuarioController(){

		// si no esta vacio el usuario (campo del input)
		if (isset($_POST["usuarioRegistro"])) {


			#preg_match realiza una comparación con una expresión regular
			if(preg_match('/^[a-zA-Z0-9]+$/',$_POST['usuarioRegistro']) &&
			   preg_match('/^[a-zA-Z0-9]+$/',$_POST['passwordRegistro']) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',
			   $_POST['emailRegistro'])){

				// se encripta con la contraseña con esto
				$encriptar = crypt($_POST["passwordRegistro"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');


				 // se guarda en array para guardar los datos en la bd
				$datosController = array(
					'usuario' => $_POST['usuarioRegistro'],
					'password' => $encriptar,
					'email' => $_POST['emailRegistro']);


				// se manda los datos del usuario de registro y la tabla donde se va guardar para ejecutar la funcion
				$respuesta = Crud::registroUsuarioModel($datosController,"usuarios");

				if($respuesta == "success"){
					// sirve para redireccionar a la pagina
					header("location:ok");
				}else{
						header("location:index.php");

				}

			}


		}

	}
	//Login
	public function ingresoUsuarioController(){

		if (isset($_POST["usuarioIngreso"])) {


			if(preg_match('/^[a-zA-Z0-9]+$/',$_POST['usuarioIngreso']) &&
			   preg_match('/^[a-zA-Z0-9]+$/',$_POST['passwordIngreso'])){

			// se encripta la password para que sea igual a la que se guardó encriptada en la base de datos en el registro

			// $encriptar = crypt($_POST["passwordIngreso"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			 $datosController = array('usuario' =>  $_POST["usuarioIngreso"] ,
			 						 'password' => $_POST["passwordIngreso"]);

			 $resultado = Crud::consultarUsuarioModel($datosController,"usuarios");

				$intentos = $resultado["intentos"];
				$usuario = $_POST["usuarioIngreso"];
				$maximoIntentos =2;

				// mientras los intentos sean menores al maximo ...
				if($intentos<$maximoIntentos){

				// si el usuario que se ingresó es igual al usuario de bd inicia sesión
				if($_POST["usuarioIngreso"]==$resultado["usuario"] &&
				$_POST["passwordIngreso"]==$resultado["password"] ){

					//inicia la sesion
					session_start();
					$_SESSION["validar"] = true;

					$intentos = 0;
					$datosController = array("usuarioActual"=>$usuario, "actualizarIntentos" => $intentos);
					$respuestaActualizarIntentos = Crud::intentosUsuarioModel($datosController,"usuarios");

					 header("location:usuarios");

				}
					else {
						//se suma un intento... cuando el usuario falla el login, se almacena en un array
						++$intentos;
						$datosController = array("usuarioActual"=>$usuario, "actualizarIntentos" => $intentos);
						$respuestaActualizarIntentos = Crud::intentosUsuarioModel($datosController,"usuarios");
						header("location:fallo");

				  	}

			}else{
				// los intentos vuelven a 0
				$intentos = 0;
				$datosController = array("usuarioActual"=>$usuario, "actualizarIntentos" => $intentos);
				$respuestaActualizarIntentos = Crud::intentosUsuarioModel($datosController,"usuarios");
				header("location:fallo3intentos");

			}
		}

		}


	}
	//se muestran los usuarios en el table y se pone la url hacia editar y borrar
	public function consultarUsuariosController()
	{
		$respuesta = Crud::consultarUsuariosModel('usuarios');

		foreach ($respuesta as $row => $item) {
			echo '<tr>
						<td>'.$item["usuario"].'</td>
						<td>'.$item["password"].'</td>
						<td>'.$item["email"].'</td>
						<td><a href="index.php?action=editar&id='.$item["id"].'"><button>Editar</button></a></td>
						<td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>';

		}

	}

	public function editarUsuarioController(){
		$id = $_GET["id"];
		$respuesta = Crud::editarUsuarioModel($id,"usuarios");

		echo '
					<input type="hidden"  value="'.$respuesta["id"].'"	 name="idEditar"  >

					<input type="text" value="'.$respuesta["usuario"].'" name="usuarioEditar" required>

					<input type="text" value="'.$respuesta["password"].'" name="passwordEditar" required>

					<input type="email" value="'.$respuesta["email"].'" name="emailEditar" required>

					<input type="submit" value="Actualizar">	';

	}

		public function actualizarUsuarioController(){


			if(isset($_POST["usuarioEditar"])){


			if(preg_match('/^[a-zA-Z0-9]+$/',$_POST['usuarioEditar']) &&
			preg_match('/^[a-zA-Z0-9]+$/',$_POST['passwordEditar']) &&
			preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',
			$_POST['emailEditar'])){

				$encriptar = crypt($_POST["passwordEditar"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array('id' => $_POST["idEditar"] ,
				'usuario' => $_POST["usuarioEditar"],
				'password' => $encriptar,
				'email' => $_POST["emailEditar"]);

				$respuesta = Crud::actualizarUsuarioModel($datos,"usuarios");

				if($respuesta == "success"){

					// sirve para redireccionar a la pagina
					header("location:cambio");
				}else{

					 echo "error";

				}

			}

		}
		}

			public function borrarUsuarioController(){

				if (isset($_GET['idBorrar'])) {

					$idBorrar = $_GET['idBorrar'];

					$respuesta = Crud::borrarUsuarioModel($idBorrar,"usuarios");

					if ($respuesta == "success") {
							header("location:usuarios");

					}else {
							echo "error";
					}
		}
			}
}
