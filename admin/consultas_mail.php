<?php 
include("includes/db.inc.php");
conectar();

require 'Mail/PHPMailer/class.phpmailer.php';

if(!isset($_POST["email"])) die();

$id = mysql_real_escape_string($_POST["id"]);

$nombre = mysql_real_escape_string($_POST["nombre"]);
$email = mysql_real_escape_string($_POST["email"]);
$asunto = mysql_real_escape_string($_POST["asunto"]);
$cuerpo = mysql_real_escape_string($_POST["cuerpo"]);

mysql_query("UPDATE consultas SET respondido = 1 WHERE id_consulta = $id");

$fecha = date(time());

mysql_query("INSERT INTO consultas(fecha,nombre,email,telefono,direccion,lat,lon,consulta,activa,local,respondido) values('$fecha','$nombre','$email','','','','','$cuerpo',0,1,1)");
$last_id = mysql_insert_id();

$mail = new PHPMailer();
$mail->IsSMTP();

$mail->SMTPDebug  = 0; // 1 = client messages // 2 = client and server messages
$mail->Debugoutput = 'html';
$mail->Host       = 'smtp.gmail.com';
$mail->Port       = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth   = true;
$mail->Username   = "infraestructuraLaRioja@gmail.com";
$mail->Password   = "infralarioja2013";
$mail->SetFrom('infraestructuraLaRioja@gmail.com', 'Ministerio de infraestructura La Rioja');
$mail->AddReplyTo('infraestructuraLaRioja@gmail.com','Ministerio de infraestructura La Rioja');

$mail->AddAddress($email, $nombre);
$mail->Subject = $asunto;
$mail->MsgHTML($cuerpo);
$mail->AltBody = strip_tags($cuerpo);

if(!$mail->Send()) {
 	mysql_query("UPDATE consulas SET respondido = 0 WHERE id_consulta = $last_id");
	echo "Mailer Error: " . $mail->ErrorInfo;
} else {
	header("Location: consultas.php?exito=actualizar");
}
?>
