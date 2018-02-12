<?php
	session_start();
	if (!$_SESSION["validar"]) {
		header("location:index.php?action=ingresar");
		//salirse del script hasta que se vuelva a llamar
		exit();
	}

 ?>


<h1>EDITAR USUARIO</h1>

<form method="post" >

	<?php
			$controller = new Controller();
			$controller->editarUsuarioController();
			$controller->actualizarUsuarioController();
	 ?>
</form>
