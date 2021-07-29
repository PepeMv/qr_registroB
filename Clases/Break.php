<?php

require_once('conexionMySQL.php');


class BreakReceso{


    public function selectBreaksxFechaHora($fecha){
        $cn = new conexionMySQL();
        $con = $cn->conectar();
        $resultadoConsulta=null;
        $fechaInicio = $fecha." 00:00:00";
        $fechaFin = $fecha." 23:59:59";
        $stmt = $con->prepare("select * from break where fecha BETWEEN ? AND ?  and tipo = 1 ORDER BY fecha ASC");
        /* select * from break where fecha BETWEEN '2019-07-22 00:00:00' AND '2019-07-22 23:59:59' ORDER BY fecha ASC */
        $stmt->bind_param("ss", $fechaInicio,$fechaFin);
        $stmt->execute();

        $resultadoConsulta= $stmt->get_result();

        if($resultadoConsulta!=null){
            $respuestaBreaks = array();
            $i=0;
            while ($filaBreak=$resultadoConsulta->fetch_assoc()){
                $respuestaBreaks[$i]['id'] = $filaBreak['id'];
                $respuestaBreaks[$i]['descripcion'] = $filaBreak['descripcion'];
                $respuestaBreaks[$i]['fecha'] = $filaBreak['fecha'];
                $respuestaBreaks[$i]['color'] = $filaBreak['color'];
                $respuestaBreaks[$i]['estado'] = $filaBreak['estado'];

                $i++;
            }
            return $respuestaBreaks;
        }
    }

    public function selectAlmuerzosxFechaHora($fecha){
        $cn = new conexionMySQL();
        $con = $cn->conectar();
        $resultadoConsulta=null;
        $fechaInicio = $fecha." 00:00:00";
        $fechaFin = $fecha." 23:59:59";
        $stmt = $con->prepare("select * from break where fecha BETWEEN ? AND ?  and tipo = 2 ORDER BY fecha ASC");
        /* select * from break where fecha BETWEEN '2019-07-22 00:00:00' AND '2019-07-22 23:59:59' ORDER BY fecha ASC */
        $stmt->bind_param("ss", $fechaInicio,$fechaFin);
        $stmt->execute();

        $resultadoConsulta= $stmt->get_result();

        if($resultadoConsulta!=null){
            $respuestaBreaks = array();
            $i=0;
            while ($filaBreak=$resultadoConsulta->fetch_assoc()){
                $respuestaBreaks[$i]['id'] = $filaBreak['id'];
                $respuestaBreaks[$i]['descripcion'] = $filaBreak['descripcion'];
                $respuestaBreaks[$i]['fecha'] = $filaBreak['fecha'];
                $respuestaBreaks[$i]['color'] = $filaBreak['color'];
                $respuestaBreaks[$i]['estado'] = $filaBreak['estado'];

                $i++;
            }
            return $respuestaBreaks;
        }
    }

    
    public function updateEstadoBreak($idBreak, $estado){
        $cn = new conexionMySQL();
        $con = $cn->conectar();

        $stmt = $con->prepare("update break set estado = ? where id = ?");

        $stmt->bind_param("ss", $estado, $idBreak);

        if ( $stmt->execute()==TRUE   ){
            return 1;
            //header('Location: index.html');
        }else{
            return 0;
        }
    }        
}