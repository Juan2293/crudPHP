<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Template</title>
	<link rel="stylesheet" href="estilos/style.css">

</head>

<body>

<?php include "modules/navegacion.php"; ?>

<section>

<?php

$mvc = new Controller();
$mvc -> enlacesPaginasController();

 ?>

</section>

<script src="views/js/validarRegistro.js" type="text/javascript"></script>
<!-- <script src="views/js/valdiarIngreso.js" type="text/javascript"></script>
<script src="views/js/valdiarEditarUsuario.js" type="text/javascript"></script> -->
</body>

</html>
