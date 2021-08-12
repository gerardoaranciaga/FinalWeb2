<?php

require_once  "./view/ReseñasView.php";
require_once  "./model/ReseñasModel.php";

class ReseñasController{
  
    private $viewReseñas;
    private $modelReseñas;

    function __construct(){
        $this->viewReseñas = new ReseñasView();
        $this->modelReseñas = new ReseñasModel();
    }

    function IsUserLogged(){
        session_start();
        return isset($_SESSION["User"]);
    }

    function AgregarReseña(){
        $id_empresa = $_POST["id_empresa"];
        $id_usuario = $_POST["id_usuario"];
        $valoracion = $_POST["valoracion"];
        $reseña = $_POST["resena"];
        $inadecuada = $_POST["inadecuada"];
        $logueado = $this->IsUserLogged();
        $existeReseña = $this->modelReseñas->GetReseña($id_empresa,$id_usuario);
        $existePedido = $this->modelReseñas->VerificarPedido($id_empresa,$id_usuario);
        if($logueado == true){
            if(!$existeReseña){
                if($existePedido){
                    if(isset($id_empresa) && isset($id_usuario) && isset($valoracion) && isset($reseña) && isset($inadecuada)){
                        $this->modelReseñas->AgregarReseña($id_empresa,$id_usuario,$valoracion,$reseña,$inadecuada);
                        $this->viewReseñas->ShowReseñas();
                    }
                }else{
                    echo("Aún no has realizado pedidos");
                }
            }else{
                echo("Ya existe reseña en la empresa");
            }
        }else{
            echo("No estas logueado como usuario");
        }
    }    
    /*Ruta con metodo ("agregarReseña", "POST", "ReseñasController", "AgregarReseña"); */
    

    function GetReseñasInadecuadas(){
        $reseñasInadecuadas = $this->modelReseñas->GetReseñasInadecuadas();
        $this->viewReseñas->ShowReseñasInadecuadas($reseñasInadecuadas);
    }
    /*Ruta con metodo ("reseñasInadecuadas", "GET", "ReseñasController", "GetReseñasInadecuadas"); */
}
?>