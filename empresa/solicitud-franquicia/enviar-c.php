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

if ( !empty($_POST['apellidos']) ) $apellidos = $_POST['apellidos']; else $error = true;
if ( !empty($_POST['nombres']) ) $nombres = $_POST['nombres']; else $error = true;
if ( !empty($_POST['edad']) ) $edad = $_POST['edad']; else $error = true;
if ( !empty($_POST['direccion']) ) $direccion = $_POST['direccion']; else $error = true;
if ( !empty($_POST['grado']) ) $grado = $_POST['grado']; else $error = true;
if ( !empty($_POST['situacion']) ) $situacion = $_POST['situacion']; else $error = true;
if ( !empty($_POST['empresa']) ) $empresa = $_POST['empresa']; else $error = true;
if ( !empty($_POST['ramo']) ) $ramo = $_POST['ramo']; else $error = true;
if ( !empty($_POST['experiencia']) ) $experiencia = $_POST['experiencia']; else $error = true;

$local = $_POST['local'];

if ( !empty($_POST['direccionL']) ) $direccionL = $_POST['direccionL']; else $error = true;
if ( !empty($_POST['email']) ) $email = $_POST['email']; else $error = true;
if ( !empty($_POST['tlf']) ) $tlf = $_POST['tlf']; else $error = true;
if ( !empty($_POST['motivos']) ) $motivos = $_POST['motivos']; else $error = true;

if ( !empty($error) ) {
	header( 'Location: /' );
	die;
}
else {
	header( 'Location: /empresa/solicitud-franquicia/enviado/index.html' );
	
if ($local=="") {
	$localE="No";
}
else {
	$localE="Si";
}

$header .= "MIME-Version: 1.0\r\n"; 
$header .= "Content-type: text/html; charset=iso-8859-1";

$mensaje = '
<p><img src="http://150pizzas.com/img/header-mail.jpg" width="600" height="88"></p>
<br/>
<p><strong>150 Pizzas & Delicateses | Donde su paladar es el principal protagonista</strong><br>
  <em>Merida - Venezuela</em><br>
  <a href="www.150pizzas.com">www.150pizzas.com</a></p>
  <center><p><strong>CONTACTO</strong></p></center>
  <br/>
  ';
$mensaje .= "<strong>APELLIDOS Y NOMBRES:</strong>  " . $apellidos . " ". $nombres . "  <br/> \r\n";
$mensaje .= "<strong>EDAD:</strong>  " . $edad . "  <br/> \r\n";
$mensaje .= "<strong>DIRECCIÓN:</strong>  " . $direccion . "  <br/> \r\n";
$mensaje .= "<strong>GRADO DE INSTRUCCIÓN:</strong>  " . $grado . "  <br/><br/> \r\n";
$mensaje .= "<strong>SITUACIÓN FAMILIAR:</strong>  " . $situacion . "  <br/> \r\n";
$mensaje .= "<strong>EMPRESA:</strong>  " . $empresa . "  <br/> \r\n";
$mensaje .= "<strong>RAMO:</strong>  " . $ramo . "  <br/> \r\n";
$mensaje .= "<strong>EXPERIENCIA LABORAL:</strong>  " . $experiencia . "  <br/> \r\n";
$mensaje .= "<strong>Local:</strong>  " . $localE . "  <br/> \r\n";
$mensaje .= "<strong>DIRECCIÓN DEL LOCAL:</strong>  " . $direccionL . "  <br/> \r\n";
$mensaje .= "<strong>EMAIL:</strong>  " . $email . "  <br/> \r\n";
$mensaje .= "<strong>TELÉFONOS:</strong>  " . $tlf . "  <br/> \r\n";
$mensaje .= "<strong>MOTIVOS DE INTERÉS:</strong>  " . $motivos . "  <br/> \r\n";

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
$asunto = 'Solicitud de Franquicia - 150 Pizzas';
$headercliente .= "MIME-Version: 1.0\r\n"; 
$headercliente .= "Content-type: text/html; charset=iso-8859-1";
$asuntocliente = "Solicitud de Franquicia Enviada - 150 Pizzas";
$msjcliente = '<html>
<head>
<title>Solicitud de Franquicia Enviada - 150 Pizzas</title>
<style type="text/css">
body,td,th {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}
</style>
</head>

<body>
<p><img src="http://150pizzas.com/img/header-mail.jpg" width="600" height="88"></p>
<br/>
<p>Estimado(a) servidor, gracias por su interés en contactarnos. En la brevedad posible atenderemos a su mensaje.</p>
<p>&nbsp;</p>
<p>Gracias por preferir 150 Pizzas.</p>
<p><strong>150 Pizzas & Delicateses</strong><br>
  <em>Merida - Venezuela</em><br>
  <a href="www.150pizzas.com">www.150pizzas.com</a></p>
</body>
</html>
';

mail($para, $asunto, utf8_decode($mensaje), $header);

mail($email,$asuntocliente, utf8_decode($msjcliente),$headercliente);
}
?>
