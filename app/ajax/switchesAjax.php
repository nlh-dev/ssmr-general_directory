<?php

require_once "../../config/app.php";
require_once "../views/includes/session_start.php";
require_once "../../autoload.php";

use app\controllers\switchesController;
$switchesController = new switchesController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['switchModule'])) {
    switch ($_POST['switchModule']) {
        case 'addSwitchBrand':
            echo $switchesController->addSwitchBrandController();
            break;
        
        default:
            # code...
            break;
    }
}