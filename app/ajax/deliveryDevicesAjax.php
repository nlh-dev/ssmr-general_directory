<?php

require_once "../../config/app.php";
require_once "../views/includes/session_start.php";
require_once "../../autoload.php";

use app\controllers\devicesController;


if (isset($_GET['deviceModule']) == 'getDeviceDeliveryInfo' && isset($_GET['device_ID'])) {
    $deviceInstance = new devicesController();
    $deviceId = $_GET['device_ID'];
    $deviceData = $deviceInstance->getDeliveredDeviceById($deviceId);
    echo json_encode($deviceData);
    exit();
} elseif (isset($_GET['deviceModule']) == 'withdrawDeliveredDevices' && isset($_GET['device_ID'])) {
    $deviceInstance = new devicesController();
    $deviceId = $_GET['device_ID'];
    $deviceData = $deviceInstance->getDeliveredDeviceById($deviceId);
    echo json_encode($deviceData);
    exit();
}

if (isset($_POST['deviceModule'])) {
    $deviceInstance = new devicesController();

    if ($_POST['deviceModule'] == 'addDeviceDelivery') {
        echo $deviceInstance->saveDeliveredDevicesController();
    }

    if ($_POST['deviceModule'] == 'deleteDeliveredDevice') {
        echo $deviceInstance->deleteDeliveredDeviceController();
    }
}
