<?php
    namespace app\controllers;
    use app\models\mainModel;

    class switchesController extends mainModel{
        
        public function addSwitchBrandController(){
            $brandName = $this -> cleanRequest($_POST['brandName']);

            if (empty($brandName)) {
                $alert = [
                    "type" => "simple",
                    "icon" => "warning",
                    "title" => "¡Error al Registrar!",
                    "text" => "El campo se encuentra vacío.",
                ];
                return json_encode($alert);
                exit();
            }
        }
    }

?>