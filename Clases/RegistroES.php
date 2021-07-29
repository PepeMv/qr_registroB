<?php

require_once('conexionMySQL.php');


class RegistroES{

    public function selectRegistroESxUsuarioxSesion($idUsuario, $idSesion){
        $cn = new conexionMySQL();
        $con = $cn->conectar();
        
        $stmt = $con->prepare("select id from registroes where id_usuario = ? and id_sesion = ?");
        $resultadoConsulta = null;
        $stmt->bind_param("ss", $idUsuario,$idSesion);
        $stmt->execute();

        $resultadoConsulta= $stmt->get_result();
       
        
        if($resultadoConsulta!=null){
            
            $respuestaConsumo = array();
            $i=0;
            while ($filaConsumo=$resultadoConsulta->fetch_assoc()){
                $respuestaConsumo[$i]['id'] = $filaConsumo['id'];
            }
            return $respuestaConsumo;   
                   
        }
    }    
    
    public function selectRegistroaSesion($idUsuario, $idSesion){
        $cn = new conexionMySQL();
        $con = $cn->conectar();
        
        $stmt = $con->prepare("select id from registrosesion where id_usuario = ? and id_sesion = ?");
        $resultadoConsulta = null;
        $stmt->bind_param("ss", $idUsuario,$idSesion);
        $stmt->execute();

        $resultadoConsulta= $stmt->get_result();
       
        
        if($resultadoConsulta!=null){
            
            $respuestaConsumo = array();
            $i=0;
            while ($filaConsumo=$resultadoConsulta->fetch_assoc()){
                $respuestaConsumo[$i]['id'] = $filaConsumo['id'];
            }            
            return $respuestaConsumo;          
        }
    }   
    
    public function insertRegistroES($idUsuario, $idSesion, $f_h_registro,$tipo){
        $cn = new conexionMySQL();
        $con = $cn->conectar();

        $stmt = $con->prepare("insert into registroes(id_sesion, id_usuario, f_h_registro, tipo) values (?,?,?,?) ");

        $stmt->bind_param("ssss", $idSesion, $idUsuario, $f_h_registro, $tipo);

       /*  $stmt->execute();
        $result = $stmt->execute();
        if (!$result) {
          throw new Exception($con->error); 
            }*/
        if ( $stmt->execute()==TRUE   ){
            return 1;            
        }else{
            return 0;
        }
    }   

    public function updateEstadoRegistroES ($idUsuario, $idSesion){
        $cn = new conexionMySQL();
        $con = $cn->conectar();

        $stmt = $con->prepare("update registroes set tipo = 0 where id_sesion = ? and id_usuario = ?");

        $stmt->bind_param("ss", $idSesion, $idUsuario);

        if ( $stmt->execute()==TRUE   ){
            return 1;            
        }else{
            return 0;
        }
    }

    public function selectUsuarioxQR ($qr){
        $cn = new conexionMySQL();
        $con = $cn->conectar();

        $stmt = $con->prepare("select id, usuario from usuario where QR = ? ");
        $resultadoConsulta = null;
        $stmt->bind_param("s", $qr);
        $stmt->execute();

        $resultadoConsulta= $stmt->get_result();
       
        
        if($resultadoConsulta!=null){
            
            $respuestaConsumo = array();
            $i=0;
            while ($filaConsumo=$resultadoConsulta->fetch_assoc()){
                $respuestaConsumo[$i]['id'] = $filaConsumo['id'];
                $respuestaConsumo[$i]['usuario'] = $filaConsumo['usuario'];
            }            
            return $respuestaConsumo;          
        }
    }

    public function authUsuario ($usuario, $contrasenia){
        $cn = new conexionMySQL();
        $con = $cn->conectar();

        $stmt = $con->prepare("select * from usuario where usuario = ? and pass = ?");
        $resultadoConsulta = null;
        $stmt->bind_param("ss", $usuario, $contrasenia);
        $stmt->execute();

        $resultadoConsulta= $stmt->get_result();

        if($resultadoConsulta!=null){
            
            $respuestaConsumo = array();
            $i=0;
            while ($filaConsumo=$resultadoConsulta->fetch_assoc()){
                $respuestaConsumo[$i]['id'] = $filaConsumo['id'];
                $respuestaConsumo[$i]['usuario'] = $filaConsumo['usuario'];
                $respuestaConsumo[$i]['pass'] = $filaConsumo['pass'];
                $respuestaConsumo[$i]['nick'] = $filaConsumo['nick'];
                $respuestaConsumo[$i]['QR'] = $filaConsumo['QR'];
                
            }            
            return $respuestaConsumo;          
        }

    }

}
