<?php

require_once "../../config/app.php";
require_once "../views/includes/session_start.php";
require_once "../../autoload.php";

use app\controllers\switchesController;
$switchesController = new switchesController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['switchModule'])) {
    switch ($_POST['switchModule']) {
        // SWITCH AJAX REQUEST
        case 'addSwitch':
            echo $switchesController->addSwitchController();
            break;
        // SWITCH BRANDS AJAX REQUESTS
        case 'addSwitchBrand':
            echo $switchesController->addSwitchBrandController();
            break;
        case 'deleteSwitchBrand':
            echo $switchesController->deleteSwitchBrandController();
            break;
        case 'editSwitchBrand':
            echo $switchesController->updateSwitchBrandController();
            break;
        case 'updateSwitchBrandStatus':
            echo $switchesController->updateSwitchBrandStatusController();
            break;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['switchModule'])) {
    switch ($_GET['switchModule']) {
        case 'getSwitchBrandData':
            $switchBrandData = $switchesController->getSwitchBrandDataController();
            echo json_encode($switchBrandData);
            break;
    }
}