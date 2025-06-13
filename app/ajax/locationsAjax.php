<?php

require_once "../../config/app.php";
require_once "../views/includes/session_start.php";
require_once "../../autoload.php";

use app\controllers\locationsController;

$locationsInstance = new locationsController();

if (isset($_GET['locationModule']) && isset($_GET['location_ID'])) {
    $locationId = $_GET['location_ID'];
    switch ($_GET['locationModule']) {
        case 'getLocationData':
            $locationData = $locationsInstance->getLocationsByIdController();
            echo json_encode($locationData);
    }
}

if (isset($_POST['locationModule'])) {
    switch ($_POST['locationModule']) {
        case 'addLocation':
            echo $locationsInstance->addLocationsController();
            break;
        case 'updateLocation':
            echo $locationsInstance->updateLocationController();
            break;
        case 'updateLocationState':
            echo $locationsInstance->updateLocationsStateController();
            break;
        case 'deleteLocation':
            echo $locationsInstance->deleteLocationController();
            break;
    }
}
