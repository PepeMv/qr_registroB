<?php

require_once('conexionMySQL.php');


class Sesion{


    public function selectSesionsxFechaHora($fecha){
        $cn = new conexionMySQL();
        $con = $cn->conectar();
        $resultadoConsulta=null;
        //fecha declarar
        $fechaInicio = $fecha." 00:00:00";
        $fechaFin = $fecha." 23:59:59";
        $stmt = $con->prepare("select s.id, s.f_h_inicio, s.f_h_fin, s.id_auditorio,s.nombre as nombreSesion, s.descripcion, s.cupo, s.color, s.estado , a.nombre as nombreAuditorio, a.capacidad
        from sesion s
        inner join auditorio a on s.id_auditorio = a.id
        where f_h_inicio BETWEEN ? AND ? ORDER BY f_h_inicio ASC");
        /* select * from break where fecha BETWEEN '2019-07-22 00:00:00' AND '2019-07-22 23:59:59' ORDER BY fecha ASC */
        $stmt->bind_param("ss", $fechaInicio,$fechaFin);
        $stmt->execute();

        $resultadoConsulta= $stmt->get_result();

        if($resultadoConsulta!=null){
            $respuestaBreaks = array();
            $i=0;
            while ($filaBreak=$resultadoConsulta->fetch_assoc()){
                $respuestaBreaks[$i]['id'] = $filaBreak['id'];
                $respuestaBreaks[$i]['f_h_inicio'] = $filaBreak['f_h_inicio'];
                $respuestaBreaks[$i]['f_h_fin'] = $filaBreak['f_h_fin'];
                $respuestaBreaks[$i]['id_auditorio'] = $filaBreak['id_auditorio'];
                $respuestaBreaks[$i]['nombreSesion'] = $filaBreak['nombreSesion'];
                $respuestaBreaks[$i]['descripcion'] = $filaBreak['descripcion'];
                $respuestaBreaks[$i]['cupo'] = $filaBreak['cupo'];
                $respuestaBreaks[$i]['color'] = $filaBreak['color'];                            
                $respuestaBreaks[$i]['estado'] = $filaBreak['estado'];
                $respuestaBreaks[$i]['nombreAuditorio'] = $filaBreak['nombreAuditorio'];
                $respuestaBreaks[$i]['capacidad'] = $filaBreak['capacidad'];

                $i++;
            }
            return $respuestaBreaks;
        }
    }
    
    public function updateEstadoSesion($idSesion, $estado){
        $cn = new conexionMySQL();
        $con = $cn->conectar();

        $stmt = $con->prepare("update sesion set estado = ? where id = ?");

        $stmt->bind_param("ss", $estado, $idSesion);

        if ( $stmt->execute()==TRUE   ){
            return 1;
            //header('Location: index.html');
        }else{
            return 0;
        }
    }        

    
}