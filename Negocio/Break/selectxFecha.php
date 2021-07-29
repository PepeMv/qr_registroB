<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
require_once '../../Clases/Break.php';
$fecha = $_GET['fecha'];

$receso = new BreakReceso();

$respuesta = $receso->selectBreaksxFechaHora($fecha);

echo json_encode($respuesta);

?>