<?php 

header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');

require_once '../../Clases/RegistroConsumo.php';

$json = file_get_contents('php://input');
$params = json_decode($json);

$idUsuario = $params->idUsuario;//"1";//$_GET['idUsuario'];
$idBreak =   $params->idBreak;//"2";//$_GET['idBreak'];
$f_hora_consumo = $params->f_hora_consumo;//"2019-07-22 07:00:00";//$_GET['f_hora_consumo'];

$consumo = new RegistroConsumo();

$existeRegistro = $consumo->selectConsumoxUsuarioxBreak($idUsuario,$idBreak);

$respues = array();

if(count($existeRegistro)==1){
    
    //echo "{success:false, message:'0'}";
    $respues[0]['mensaje'] = '0';
    echo json_encode($respues);

}else{
    
    $insertarCosumo = $consumo->insertRegistrodeConsumo($idUsuario,$idBreak,$f_hora_consumo);
    if($insertarCosumo==1){
        //echo "{success:true, message:'1'}";
        $respues[0]['mensaje'] = '1';
        echo json_encode($respues);
    }else{
        //echo "{success:false, message:'0'}";
        $respues[0]['mensaje'] = '0';
        echo json_encode($respues);
    }
} 



