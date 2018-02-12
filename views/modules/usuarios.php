<?php
	//seguridad
	session_start();
	if (!$_SESSION["validar"]) {
		header("location:ingresar");
		//salirse del script hasta que se vuelva a llamar
		exit();
	}

 ?>

<h1>USUARIOS</h1>

	<table border="1">

		<thead>

			<tr>
				<th>Usuario</th>
				<th>Contraseña</th>
				<th>Email</th>
				<th></th>
				<th></th>

			</tr>

		</thead>

		<tbody>
		<!-- Se crean los rows con los registros -->
			<?php
					$controller = new Controller();
					$controller->consultarUsuariosController();
					$controller->borrarUsuarioController();
			 ?>


		</tbody>



	</table>


	<?php
			if ($_GET['action']=="cambio") {
				echo"Se editó el usuario con exito";
			}

			if ($_GET['action']=="borrado") {
				echo"Se borró el usuario con exito";
			}


	 ?>
