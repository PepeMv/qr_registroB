<?php

header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: X-Requested-With, content-type, access-control-allow-origin, access-control-allow-methods, access-control-allow-headers');

require_once '../../Clases/RegistroES.php';

$json = file_get_contents('php://input');
$params = json_decode($json);

$idUsuario =    $params->idUsuario; //$_POST['idUsuario'];
$idSesion =     $params->idSesion; //$_POST['idSesion'];
$f_h_registro = $params->f_h_registro; //$_POST['f_h_registro'];

$registro = new RegistroES();
$estado = 1;

$existeRegistro = $registro->selectRegistroESxUsuarioxSesion($idUsuario, $idSesion);

$estado = "";
$respues = array();

if (count($existeRegistro) == 1) {

    $estado = "0";
    /* echo "Ya esta registraso salida "; */
    //actulaziar el estado o tipo
    $registrarSalida = $registro->updateEstadoRegistroES($idUsuario, $idSesion);
    if ($registrarSalida == 1) {
        $respues[0]['mensaje'] = '2';
        echo json_encode($respues);
    } else {
        $respues[0]['mensaje'] = '0';
        echo json_encode($respues);
        /* echo "{success:false, message:'0'}"; */
    }
} else {
    /* echo "se va a registrar ingreso"; */
    $estado = 1;
    $registrdoAsesion = count($registro->selectRegistroaSesion($idUsuario, $idSesion));

    //77debo ver si el usuario que quiere ingresar esta registrado en la sesion
    /* echo count($registrdoAsesion); */
    if ($registrdoAsesion == 1) {

        $insertarSesion = $registro->insertRegistroES($idUsuario, $idSesion, $f_h_registro, $estado);

        //echo $insertarSesion;
        if ($insertarSesion == 1) {
            $respues[0]['mensaje'] = '1';
            echo json_encode($respues);
            /* echo "{success:true, message:'1'}"; */
        } else {
            $respues[0]['mensaje'] = '0';
            echo json_encode($respues);
            /* echo "{success:false, message:'0'}"; */
        }
    } else {
        $respues[0]['mensaje'] = '0';
        echo json_encode($respues);
        /* echo "{success:false, message:'0'}"; */
    }
}
