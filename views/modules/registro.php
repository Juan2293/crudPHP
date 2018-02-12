<h1>REGISTRO DE USUARIO</h1>

<!--
la funcion return validarRegistro se ejecuta luego de presionar Enviar en el formulario
el return hace que la funcion funcione como un booleano si la funcion retorna verdadero se envia el formulario
si retorna falso no se envia el formulario. 			
-->
<form method="post" onsubmit="return validarRegistro()" >

	<label for="usuarioRegistro">Usuario</label>
	<!-- es importante usar el name en los input porque con ese nombre se recupera con el post o  get  -->
	<input type="text" placeholder="Maximo 6 caracteres"  name="usuarioRegistro" id="usuarioRegistro"  required>

	<label for="passwordRegistro"></label>
	<input type="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" placeholder="Mínimo 6 caracteres, incluir numero(s) y una mayuscula" name="passwordRegistro" id="passwordRegistro" required>
	
	<label for="emailRegistro"></label>
	<input type="email" placeholder="Escriba correctamente el correo" name="emailRegistro" id="emailRegistro" required>

	<P style="text-align:center"><a href="#">Acepta terminos y condiciones</a></P>
	<input type="checkbox" id="terminos">

	<input type="submit" value="Enviar">

</form>

<?php
// se llama el metodo registro usuarioUsuarioController para ejecutar la función luego de hacer el submit
 $registro = new Controller();
 $registro -> registroUsuarioController();

if(isset($_GET["action"])){

	if ($_GET["action"] == "ok") {
		echo "Registro exitoso";

	}
}
 ?>
