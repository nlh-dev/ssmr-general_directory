<?php

require_once "../../config/app.php";
require_once "../views/includes/session_start.php";
require_once "../../autoload.php";

use app\controllers\devicesController;

$deviceInstance = new devicesController();

// Procesar peticiones GET
if (isset($_GET['deviceModule']) && isset($_GET['device_ID'])) {
    $deviceId = $_GET['device_ID'];
    switch ($_GET['deviceModule']) {
        case 'getDeviceData':
            $deviceData = $deviceInstance->getDeliveredDeviceById();
            echo json_encode($deviceData);
    }
}

// Procesar peticiones POST
if (isset($_POST['deviceModule'])) {
    switch ($_POST['deviceModule']) {
        case 'addDeviceDelivery':
            echo $deviceInstance->saveDeliveredDevicesController();
            break;
        case 'updateDeliveredDevices':
            echo $deviceInstance->updateDeliveredDeviceController();
            break;
        case 'deleteDeliveredDevice':
            echo $deviceInstance->deleteDeliveredDeviceController();
            break;
        case 'withdrawDevice':
            echo $deviceInstance->withdrawDeviceController();
            break;
        case 'updateWithdrawDevice':
            echo $deviceInstance->updateWithdrawDeviceController();
            break;
    }
}
