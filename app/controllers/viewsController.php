<?php

    namespace app\controllers;
    use app\models\viewsModel;


    class viewsController extends viewsModel{

        public function obtainViewsController($views){

            if ($views != "") {
                $response = $this -> obtainViesModel($views);
            } else {
                $response = "login";
            }

            return $response;
        }
    }

?>