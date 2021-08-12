<?php

require_once "./model/ReseñasModel.php";
require_once ("JSONView.php");

class ApiController(){

    private $view;
    private $modelReseñas;
    
    function getData(){ 
        return json_decode($this->data); 
    }  
    
    function __construct(){
        $this->modelReseñas = new ReseñasModel();
        $this->view = new JSONView();
    }

    function GetReseñas($params = []){
        $reseñas = $this->modelReseñas->GetReseñas();
        if($reseñas){
            $this->view->response($reseñas,200);
        }else{
            $this->view->response("Sin reseñas",404);
        }
    }

    function EditarReseña($params = []){
        $id_usuario = $paramas[":ID"];
        $body = $this->getData();
        $id_reseña = $body->id_resena;
        $reseña = $this->modelReseñas->GetReseña($id_reseña);
        if($reseña){
            $valoracion = $body->valoracion;
            $reseña = $body->resena;
            $inadecuada = $body->inadecuada;
            if(($reseña != "")){
                $this->modelReseñas->EditarReseña($id_reseña,$valoracion,$reseña,$inadecuada);
                $this->view->response("Editada con exito",200);
            }
        }else{
            $this->view->response("Reseña no existente",404);
        }
    }
}

?>
