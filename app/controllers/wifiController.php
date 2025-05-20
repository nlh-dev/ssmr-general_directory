<?php

namespace app\controllers;

use app\models\mainModel;

class wifiController extends mainModel{

    public function getDepartmentsController(){
        $getDepartments_Query = "SELECT * FROM departments";
        $getDepartments_SLQ = $this->dbRequestExecute($getDepartments_Query);
        $getDepartments_SLQ->execute();
        return $getDepartments_SLQ;
    }

    public function getLocationsController(){
        $getDepartments_Query = "SELECT * FROM locations";
        $getDepartments_SLQ = $this->dbRequestExecute($getDepartments_Query);
        $getDepartments_SLQ->execute();
        return $getDepartments_SLQ;
    }

    public function saveWifiPasswordController(){
        $SSID = $this->cleanRequest($_POST['SSID']);
        $locations = $this->cleanRequest($_POST['locations']);
        $departments = $this->cleanRequest($_POST['departments']);
        $wifiPassword = $this->cleanRequest($_POST['wifiPassword']);
        $ipDirection = $this->cleanRequest($_POST['ipDirection']);

        if (empty($SSID) || empty($locations) || empty($departments)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡Algunos campos se encuentran vacios!",
            ];
            return json_encode($alert);
            exit();
        }

        $checkSSID = $this->dbRequestExecute("SELECT wifi_SSID 
        FROM wifi_directory
        WHERE wifi_SSID = '$SSID'");
        if ($checkSSID->rowCount() >= 1) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡Este SSID ya fue Registrado!",
            ];
            return json_encode($alert);
            exit();
        }

        $checkIP = $this->dbRequestExecute("SELECT wifi_ipDirection 
        FROM wifi_directory
        WHERE wifi_ipDirection = '$ipDirection'");
        if ($checkIP->rowCount() >= 1) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡Esta Dirección IP ya fue Registrada!",
            ];
            return json_encode($alert);
            exit();
        }


        $wifiRegisterData = [
            [
                "db_FieldName" => "wifi_SSID",
                "db_ValueName" => ":SSID",
                "db_realValue" => $SSID
            ],
            [
                "db_FieldName" => "wifi_password",
                "db_ValueName" => ":password",
                "db_realValue" => $wifiPassword
            ],
            [
                "db_FieldName" => "wifi_ipDirection",
                "db_ValueName" => ":ipDirection",
                "db_realValue" => $ipDirection
            ],
            [
                "db_FieldName" => "wifi_location_ID",
                "db_ValueName" => ":locationID",
                "db_realValue" => $locations
            ],
            [
                "db_FieldName" => "wifi_department_ID",
                "db_ValueName" => ":departmentID",
                "db_realValue" => $departments
            ],
            [
                "db_FieldName" => "wifi_createdAt",
                "db_ValueName" => ":createdAt",
                "db_realValue" => date('Y-m-d H:i:s')
            ],
            [
                "db_FieldName" => "wifi_updatedAt",
                "db_ValueName" => ":updatedAt",
                "db_realValue" => date('Y-m-d H:i:s')
            ],
            [
                "db_FieldName" => "wifi_isEnable",
                "db_ValueName" => ":isEnable",
                "db_realValue" => true
            ],

        ];

        $addWidfiPassword = $this->saveData("wifi_directory", $wifiRegisterData);
        if ($addWidfiPassword->rowCount() >= 1) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "Contraseña registrada exitosamente!",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "¡Contraseña no registrada, intente nuevamente!",
            ];
        }
        return json_encode($alert);
    }
}
