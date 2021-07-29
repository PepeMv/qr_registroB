<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require_once '../../Clases/Sesion.php';
$fecha = $_GET['fecha'];

$receso = new Sesion();

$respuesta = $receso->selectSesionsxFechaHora($fecha);

echo json_encode($respuesta);

?>