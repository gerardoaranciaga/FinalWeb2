<?php

class EmpresaModel{
    
    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=teneloya;charset=utf8','root', '');
    }

    function MarcarPremium($promedio){
        $sentencia = $this->db->prepare("UPDATE empresa SET premium = true WHERE id_empresa = ( SELECT id_empresa FROM valoracion WHERE AVG(valoracion) > ? GROUP BY id_empresa)");
        $sentencia->execute(array($promedio));
    }
}
?>