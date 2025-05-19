<?php

namespace app\controllers;

use app\models\mainModel;

class wifiController extends mainModel
{

    public function getDepartmentsController()
    {
        $getDepartments_Query = "SELECT * FROM departments";
        $getDepartments_SLQ = $this->dbRequestExecute($getDepartments_Query);
        $getDepartments_SLQ->execute();
        return $getDepartments_SLQ;
    }

    public function getLocationsController()
    {
        $getDepartments_Query = "SELECT * FROM locations";
        $getDepartments_SLQ = $this->dbRequestExecute($getDepartments_Query);
        $getDepartments_SLQ->execute();
        return $getDepartments_SLQ;
    }

    public function addDeviceController()
    {
        $recievedByName = $this->cleanRequest($_POST['recievedByName']);
        $itemDescription = $this->cleanRequest($_POST['itemDescription']);
        $itemCode = $this->cleanRequest($_POST['itemCode']);
        $departmentName = $this->cleanRequest($_POST['departmentName']);
        $roomCode = $this->cleanRequest($_POST['roomCode']);
        $deliveryDate = $this->cleanRequest($_POST['deliveryDate']);


        if (empty($recievedByName) || empty($itemDescription) || empty($departmentName) || empty($itemCode) || empty($roomCode) || empty($deliveryDate)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al entregar!",
                "text" => "¡Algunos campos se encuentran vacios!",
            ];
            return json_encode($alert);
            exit();
        }

        $checkControl = $this->dbRequestExecute("SELECT device_isDelivered 
        FROM devices 
        WHERE device_isDelivered = 1 
        AND device_serialCode = '$itemCode'");

        if ($checkControl->rowCount() >= 1) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al entregar!",
                "text" => "¡Este dispositivo ya fue entregado!",
            ];
            return json_encode($alert);
            exit();
        }

        $userDeliver = $this->cleanRequest($_POST['userDeliver']);
        $userDeliver = strtoupper($userDeliver);
        // ARRAY TO STORE DATA FROM FORM FIELD TO DATABASE
        $deviceRegisterData = [
            [
                "db_FieldName" => "device_userFullName",
                "db_ValueName" => ":fullName",
                "db_realValue" => $userDeliver
            ],
            [
                "db_FieldName" => "device_recievedByName",
                "db_ValueName" => ":recievedbyName",
                "db_realValue" => $recievedByName
            ],
            [
                "db_FieldName" => "device_deliveryDate",
                "db_ValueName" => ":deliveryDate",
                "db_realValue" => $deliveryDate
            ],
            [
                "db_FieldName" => "device_deliveryTime",
                "db_ValueName" => ":deliveryTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "device_Description",
                "db_ValueName" => ":Description",
                "db_realValue" => $itemDescription
            ],
            [
                "db_FieldName" => "device_serialCode",
                "db_ValueName" => ":serialCode",
                "db_realValue" => $itemCode
            ],
            [
                "db_FieldName" => "device_department_ID ",
                "db_ValueName" => ":Department",
                "db_realValue" => $departmentName
            ],
            [
                "db_FieldName" => "device_RoomCode",
                "db_ValueName" => ":roomCode",
                "db_realValue" => $roomCode
            ],
            [
                "db_FieldName" => "device_isDelivered",
                "db_ValueName" => ":isDelivered",
                "db_realValue" => 1
            ],
        ];

        $addDevices = $this->saveData("devices", $deviceRegisterData);
        if ($addDevices->rowCount() >= 1) {
            $alert = [
                "type" => "clean",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "Dispositivo entregado y registrado exitosamente!",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "¡Dispositivo no registrador, intente nuevamente!",
            ];
        }
        return json_encode($alert);
    }

    public function saveWifiPasswordController()
    {
        $SSID = $this->cleanRequest($_POST['SSID']);
        $wifiPassword = $this->cleanRequest($_POST['wifiPassword']);
        $locations = $this->cleanRequest($_POST['locations']);
        $departments = $this->cleanRequest($_POST['departments']);

        if (empty($SSID) || empty($wifiPassword) || empty($locations) || empty($departments)) {
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
    }
}
