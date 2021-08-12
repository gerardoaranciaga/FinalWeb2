<?php

require_once  "./view/EmpresaView.php";
require_once  "./model/EmpresaModel.php";

class EmpresaController{
  
    private $viewEmpresa;
    private $modelEmpresa;

    function __construct(){
        $this->viewEmpresa = new EmpresaView();
        $this->modelEmpresa = new EmpresaModel();
    }
    
    function IsAdmin(){
        session_start();
        if($_SESSION["admin"] == true){
            return true;
        }
        else{
            return false;
        }
    }

    function MarcarPremium(){
        $promedio = $_POST["promedio"];
        $admin = $this->IsAdmin();
        if($admin == true){
            if(isset($promedio)){
                $this->modelEmpresa->MarcarPremium($promedio);
                $this->viewEmpresa->ShowEmpresas();
            }else{
                echo("Promedio mal introducido")
            }
        }else{
            echo("No eres admin");
        }
    }

/*Ruta con metodo ("marcarPremium", "POST", "EmpresaController", "MarcarPremium"); */

 ?>