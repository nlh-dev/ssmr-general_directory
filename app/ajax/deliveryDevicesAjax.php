<?php

require_once "../../config/app.php";
require_once "../views/includes/session_start.php";
require_once "../../autoload.php";

use app\controllers\devicesController;

if (isset($_POST['deviceModule'])) {
    $deviceInstance = new devicesController();

    if ($_POST['deviceModule'] == 'addDeviceDelivery') {
        echo $deviceInstance->saveDeliveredDevicesController();
    }
    
}
