<?php

class conexionMySQL {

    function conectar (){

        /* $con = new mysqli('localhost','root','','clientes'); */
        $con = new mysqli('localhost','root','','db_csei_dev');

        if($con->connect_errno){            
            echo " Error: ".$con->connect->error;
            exit;
            return null ;
            
        }else{
            return $con;
        }            
    }
}
    


