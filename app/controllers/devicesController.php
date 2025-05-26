<?php

namespace app\controllers;

use app\models\mainModel;

class devicesController extends mainModel
{

    public function saveDeliveredDevicesController()
    {
        $recievedByName = strtoupper($this->cleanRequest($_POST['recievedByName']));
        $deviceDescription = strtoupper($this->cleanRequest($_POST['deviceDescription']));
        $serialCode = strtoupper($this->cleanRequest($_POST['serialCode']));
        $deliveryDate = $this->cleanRequest($_POST['deliveryDate']);
        $locations = $this->cleanRequest($_POST['locations']);
        $departments = $this->cleanRequest($_POST['departments']);
        $roomCode = strtoupper($this->cleanRequest($_POST['roomCode']));

        if (empty($deviceDescription) || empty($serialCode) || empty($deliveryDate) || empty($locations) || empty($departments)) {
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
        AND device_roomCode = '$serialCode'");

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

        $deviceRegisterData = [
            [
                "db_FieldName" => "device_deliveryUser_ID",
                "db_ValueName" => ":deliveryUser_ID",
                "db_realValue" => 1 //REGISTRO ESTATICO PARA PRUEBA
            ],
            [
                "db_FieldName" => "device_recievedByName",
                "db_ValueName" => ":recievedByName",
                "db_realValue" => $recievedByName
            ],
            [
                "db_FieldName" => "device_description",
                "db_ValueName" => ":deviceDescription",
                "db_realValue" => $deviceDescription
            ],
            [
                "db_FieldName" => "device_serialCode",
                "db_ValueName" => ":serialCode",
                "db_realValue" => $serialCode
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
                "db_FieldName" => "device_location_ID",
                "db_ValueName" => ":location_ID",
                "db_realValue" => $locations
            ],
            [
                "db_FieldName" => "device_department_ID",
                "db_ValueName" => ":department_ID",
                "db_realValue" => $departments
            ],
            [
                "db_FieldName" => "device_roomCode",
                "db_ValueName" => ":roomCode",
                "db_realValue" => $roomCode
            ],
            [
                "db_FieldName" => "device_isDelivered",
                "db_ValueName" => ":isDelivered",
                "db_realValue" => true
            ],
        ];

        $addDevices = $this->saveData("devices", $deviceRegisterData);
        if ($addDevices->rowCount() >= 1) {
            $alert = [
                "type" => "reload",
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
}
