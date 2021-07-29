<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require_once '../../Clases/RegistroES.php';

$qr = $_GET['qr'];

$registroES = new RegistroES();
$respuesta = $registroES->selectUsuarioxQR($qr);

echo json_encode($respuesta);