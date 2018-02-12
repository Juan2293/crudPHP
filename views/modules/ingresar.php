<h1>INGRESAR</h1>

	<form method="post" >


		<input type="text" placeholder="Usuario" name="usuarioIngreso" required>

		<input type="password" placeholder="Contraseña" name="passwordIngreso" required>

		<input type="submit" value="Enviar">

	</form>

	<?php

$controller = new Controller();
$controller-> ingresoUsuarioController();

if (isset($_GET['action'])) {
	
	if($_GET['action']=="fallo"){

		echo "Las credenciales no son correctas";
	}

	if($_GET['action']=="fallo3intentos"){

		echo "Ha fallado 3 veces para ingresar, favor llenar el captcha";
	}

}


	 ?>
