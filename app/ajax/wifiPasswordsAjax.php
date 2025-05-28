<?php
require_once "../../config/app.php";
require_once "../views/includes/session_start.php";
require_once "../../autoload.php";

use app\controllers\wifiController;

if (isset($_POST['wifiModule'])) {
    $wifiInstance = new wifiController();
    switch ($_POST['wifiModule']) {
        case 'saveWifiPassword':
            echo $wifiInstance->saveWifiPasswordController();
            break;
        case 'updateWifiState':
            echo $wifiInstance->updateWifiStateController();
            break;
        case 'addIpDirection':
            echo $wifiInstance->addIpDirectionController();
            break;
        case 'wifiPassword':
            echo $wifiInstance->showWifiPasswordController();
            break;
        case 'deleteWifiPassword':
            echo $wifiInstance->deleteWifiPasswordController();
            break;
        case 'updateWifi':
            echo $wifiInstance->updateWifiController();
            break;
    }
}

if (isset($_GET['wifiModule']) && $_GET['wifiModule'] == 'getWifiData') {
    $wifiInstance = new wifiController();
    echo $wifiInstance->getWifiDataController();
    exit();
}