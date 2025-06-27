<?php

    namespace app\models;

    class viewsModel {

        protected function obtainViesModel($views){

            $viewsList = [
                "dashboard",
                "wifiList",
                "switchList",
                "switchPortList",
                "switchBrandList",
                "deviceDeliveryList",
                "deviceHistoryList",
                "observationsList",
                "storageList",
                "storageCategoryList",
                "storageTypesList",
                "storageMovementsList",
                "storageHistoryList",
                "locationsList",
                "departmentsList",
                "users",
                "userRoles",
                "logout"
            ];


            if (in_array($views, $viewsList)) {
                if (is_file("./app/views/content/".$views.".php")) {
                    $contentRender = "./app/views/content/".$views.".php";
                } else {
                    $contentRender = "404";
                }
            } elseif ($views == "login" || $views == "index") {
                $contentRender = "login";
            } else{
                $contentRender = "404";
            }
            return $contentRender;
        }
    }
?>