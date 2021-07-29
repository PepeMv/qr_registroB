<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require_once '../../Clases/RegistroES.php';

$usuario = $_GET['usuario'];
$contrasenia  = $_GET['contrasenia'];

$registroES = new RegistroES();
$respuesta = $registroES->authUsuario($usuario, $contrasenia);

echo json_encode($respuesta);