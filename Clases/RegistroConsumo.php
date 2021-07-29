<?php

require_once('conexionMySQL.php');


class RegistroConsumo{

    public function selectConsumoxUsuarioxBreak($idUsuario, $idBreak){
        $cn = new conexionMySQL();
        $con = $cn->conectar();
        
        $stmt = $con->prepare("select id from registroconsumo where id_usuario = ? and id_break = ?");
        $resultadoConsulta = null;
        $stmt->bind_param("ss", $idUsuario,$idBreak);
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
    
    public function insertRegistrodeConsumo($idUsuario, $idBreak, $f_hora_consumo){
        $cn = new conexionMySQL();
        $con = $cn->conectar();

        $stmt = $con->prepare("insert into registroconsumo(id_usuario, id_break, f_hora_consumo) values(?,?,?)");

        $stmt->bind_param("sss", $idUsuario, $idBreak, $f_hora_consumo);

        if ( $stmt->execute()==TRUE   ){
            return 1;
        }else{
            return 0;
        }
    }        
}