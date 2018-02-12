<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Template</title>
	<link rel="stylesheet" href="estilos/style.css">
	<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

	<style media="screen">
	iframe:focus {
	outline: none;
}

iframe[seamless] {
	display: block;
}
	</style>

	<script type="text/javascript">

	// Create the XHR object.
	function createCORSRequest(method, url) {
	  var xhr = new XMLHttpRequest();
	  if ("withCredentials" in xhr) {
	    // XHR for Chrome/Firefox/Opera/Safari.
	    xhr.open(method, url, true);
	  } else if (typeof XDomainRequest != "undefined") {
	    // XDomainRequest for IE.
	    xhr = new XDomainRequest();
	    xhr.open(method, url);
	  } else {
	    // CORS not supported.
	    xhr = null;
	  }
	  return xhr;
	}

	// Helper method to parse the title tag from the response.
	function getTitle(text) {
	  return text.match('<title>(.*)?</title>')[1];
	}

	// Make the actual CORS request.
	function makeCorsRequest() {
	  // This is a sample server that supports CORS.
	  var url = 'http://html5rocks-cors.s3-website-us-east-1.amazonaws.com/index.html';

	  var xhr = createCORSRequest('GET', url);
	  if (!xhr) {
	    alert('CORS not supported');
	    return;
	  }

	  // Response handlers.
	  xhr.onload = function() {
	    var text = xhr.responseText;
	    var title = getTitle(text);
	    alert('Response from CORS request to ' + url + ': ' + title);
	  };

	  xhr.onerror = function() {
	    alert('Woops, there was an error making the request.');
	  };

	  xhr.send();
	}

	var url = 'http://www.forosdelweb.com/f4/abrir-pagina-dentro-otra-pagina-sin-usar-frame-iframe-puede-1156625/';
	var xhr = createCORSRequest('GET', url);
	xhr.send();


	$(function(){
				 // Indica el nombre del archivo a cargar
				 $("#incluirPagina").load("http://www.forosdelweb.com/f4/abrir-pagina-dentro-otra-pagina-sin-usar-frame-iframe-puede-1156625/");
		 });
	</script>
</head>

<body>

<?php include "modules/navegacion.php"; ?>

<section>

<?php

$mvc = new Controller();
$mvc -> enlacesPaginasController();

 ?>
<object data="https://www.registraduria.gov.co/" width="350" height="95"></object><br />

  <div id="incluirPagina"></div>
</section>



<script src="views/js/validarRegistro.js" type="text/javascript"></script>
<!-- <script src="views/js/valdiarIngreso.js" type="text/javascript"></script>
<script src="views/js/valdiarEditarUsuario.js" type="text/javascript"></script> -->
</body>

</html>
