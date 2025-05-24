<?php
require_once "../../config/app.php";
require_once "../views/includes/session_start.php";
require_once "../../autoload.php";

use app\controllers\wifiController;

if (isset($_POST['wifiModule'])) {
    $wifiInstance = new wifiController();

    if ($_POST['wifiModule'] == 'saveWifiPassword') {
        echo $wifiInstance->saveWifiPasswordController();
    }

    if ($_POST['wifiModule'] == 'updateWifiState') {
        echo $wifiInstance->updateWifiStateController();
    }

    if ($_POST['wifiModule'] == 'addIpDirection') {
        echo $wifiInstance->addIpDirectionController();
    }

    if ($_POST['wifiModule'] == 'wifiPassword') {
        echo $wifiInstance->showWifiPasswordController();
    }

    if ($_POST['wifiModule'] == 'deleteWifiPassword') {
        echo $wifiInstance->deleteWifiPasswordController();
    }
    
    if ($_POST['wifiModule'] == 'updateWifi') {
        echo $wifiInstance->updateWifiController();
    }
}

if (isset($_GET['wifiModule']) && $_GET['wifiModule'] == 'getWifiData') {
    $wifiInstance = new wifiController();
    echo $wifiInstance->getWifiDataController();
    exit();
}