<?php 
header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');

require_once '../../Clases/Sesion.php';

$json = file_get_contents('php://input');
$params = json_decode($json);

$idSesion = $params->idSesion;//"3";//$_GET['idSesion'];
$estado  =  $params->estado;//"cerrado";//$_GET['estado'];

$sesion = new Sesion();

if($idSesion!=null){
    $respuesta = $sesion->updateEstadoSesion($idSesion,$estado);
}else{
    $respues[0]['mensaje'] = '0';
}



if($respuesta==1){
    //1
    //echo "{success:true, message:'$respuesta'}";
    $respues[0]['mensaje'] = '1';
    echo json_encode($respues);

}else{
    //0
    //echo "{success:false, message:'$respuesta'}";
    $respues[0]['mensaje'] = '0';
    echo json_encode($respues);

}
