<?php

class ReseñasModel{
    
    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=teneloya;charset=utf8','root', '');
    }

    function GetReseña($id_empresa,$id_usuario){
        $sentencia = $this->db->prepare("SELECT * FROM valoracion WHERE id_empresa=? AND id_usuario=?");
        $sentencia->execute(array($id_empresa,$id_usuario));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    function GetReseña($id_reseña){
        $sentencia = $this->db->prepare("SELECT * FROM valoracion WHERE id=?");
        $sentencia->execute(array($id_reseña));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    function GetReseñas(){
        $sentencia = $this->db->prepare("SELECT * FROM valoracion");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    function VerificarPedido($id_empresa,$id_usuario){
        $sentencia = $this->db->prepare("SELECT * FROM pedido WHERE id_empresa=? AND id_usuario=?");
        $sentencia->execute(array($id_empresa,$id_usuario));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    function AgregarReseña($id_empresa,$id_usuario,$valoracion,$reseña,$inadecuada)){
        $sentencia = $this->db->prepare("INSERT INTO valoracion(id_empresa,id_usuario,valoracion,resena,inadecuada) VALUES(?,?,?,?,?)");
        $sentencia = $this->db->execute(array($id_empresa,$id_usuario,$valoracion,$reseña,$inadecuada));
    }

    function GetReseñasInadecuadas(){
        $sentencia = $this->db->prepare("SELECT * FROM valoracion WHERE inadecuada = false ORDER BY id_usuario");
        $sentencia->execute());
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }

    function EditarReseña($id_reseña,$valoracion,$reseña,$inadecuada){
        $sentencia = $this->db->prepare("UPDATE valoracion SET valoracion=?,resena=?,inadecuada=? WHERE id_resena=?)");
        $sentencia->execute(array($valoracion,$reseña,$inadecuada,$id_reseña));
    }
}
?>
