<?php

require_once "../../config/app.php";
require_once "../views/includes/session_start.php";
require_once "../../autoload.php";

use app\controllers\storageController;

$storageController = new storageController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['storageModule'])) {
    switch ($_POST['storageModule']) {
        // STORAGE TYPES
        case 'addStorageType':
            echo $storageController->addStorageTypeController();
            break;
        case 'updateStorageTypeStatus':
            echo $storageController->updateStorageTypeStatusController();
            break;
        case 'updateStorageType':
            echo $storageController->updateStorageTypeController();
            break;
        case 'deleteStorageType':
            echo $storageController->deleteStorageTypeController();
            break;
        case 'addStorageCategory':
            echo $storageController->addStorageCategoryController();
            break;
        // STORAGE CATEGORIES
        case 'addStorageCategory':
            echo $storageController->addStorageCategoryController();
            break;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['storageModule'])) {
    switch ($_GET['storageModule']) {
        case 'getStorageTypeData':
            $storageTypeData = $storageController->getStorageTypeDataController(); 
            echo json_encode($storageTypeData);
            break;
    }
}
