<?php

function ValidarDatos($email){
$badHeads = array("Content-Type:",
"MIME-Version:",
"Content-Transfer-Encoding:",
"Return-path:",
"Subject:",
"From:",
"Envelope-to:",
"To:",
"bcc:",
"cc:");
foreach($badHeads as $valor){
if(strpos(strtolower($campo), strtolower($valor)) !== false){
header( "HTTP/1.0 403 Forbidden");
exit;
}
}
}

ValidarDatos($_POST['email']);

if ( !empty($_POST['nombre']) ) $nombre = $_POST['nombre']; else $error = true;
if ( !empty($_POST['email']) ) $email = $_POST['email']; else $error = true;
if ( !empty($_POST['asunto']) ) $asuntoM = $_POST['asunto']; else $error = true;
if ( !empty($_POST['msj']) ) $msj = $_POST['msj']; else $error = true;

if ( !empty($error) ) {
	header( 'Location: Contacto/' );
	die;
}
else {
	header( 'Location: /Contacto/Enviado/index.html' );

$header .= "MIME-Version: 1.0\r\n"; 
$header .= "Content-type: text/html; charset=iso-8859-1\r\n";

$mensaje = '
<p><img src="http://150pizzas.com/img/header-mail.jpg" width="600" height="88"></p>
<br/>
<p><strong>150 Pizzas & Delicateses | Donde su paladar es el principal protagonista</strong><br>
  <em>Merida - Venezuela</em><br>
  <a href="www.150pizzas.com">www.150pizzas.com</a></p>
  <center><p><strong>CONTACTO</strong></p></center>
  <br/>
  ';
$mensaje .= "<strong>NOMBRE:</strong>  " . $nombre . "  <br/> \r\n";
$mensaje .= "<strong>EMAIL:</strong>  " . $email . "  <br/> \r\n";
$mensaje .= "<strong>ASUNTO:</strong>  " . $asuntoM . "  <br/> \r\n";
$mensaje .= "<strong>MENSAJE:</strong>  " . $msj. "  <br/><br/> \r\n";


function hora_local($zona_horaria = 0)
{
	if ($zona_horaria > -12.1 and $zona_horaria < 12.1)
	{
		$hora_local = time() + ($zona_horaria * 3600);
		return $hora_local;
	}
	return 'error';
}

$mensaje .= "Enviado el " . date('d/m/Y H:i:s', hora_local());

$para = 'franquicia150pizzas@yahoo.com';
$asunto = 'Mensaje de Reservación: ' . $asuntoM . " \r\n";
$headercliente .= "MIME-Version: 1.0\r\n"; 
$headercliente .= "Content-type: text/html; charset=iso-8859-1\r\n\n";
$asuntocliente = "Mensaje de Contacto Enviado - 150 Pizzas \r\n";
$msjcliente = '<html>
<head>
<title>Mensaje de Contacto Enviado - 150 Pizzas</title>
<style type="text/css">
body,td,th {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}
</style>
</head>

<body>
<p><img src="http://150pizzas.com/img/header-mail.jpg" width="600" height="88"></p>
<br/>
<p>Estimado(a) cliente, gracias por su interés en contactarnos. En la brevedad posible atenderemos a su mensaje.</p>
<p>&nbsp;</p>
<p>Gracias por preferir 150 Pizzas.</p>
<p><strong>150 Pizzas & Delicateses</strong><br>
  <em>Merida - Venezuela</em><br>
  <a href="www.150pizzas.com">www.150pizzas.com</a></p>
</body>
</html>
';

mail($para, $asunto, utf8_decode($mensaje), $header);

mail($mail,$asuntocliente, utf8_decode($msjcliente),$headercliente);
}
?>
