<?php

require_once "../../config/app.php";
require_once "../views/includes/session_start.php";
require_once "../../autoload.php";

use app\controllers\observationsController;

$observationsInstance = new observationsController();

if (isset($_GET['observationsModule']) && isset($_GET['observation_ID'])) {
    $observationID = $_GET['observation_ID'];
    switch ($_GET['observationsModule']) {
        case 'getObservationData':
            $observationsData = $observationsInstance -> getObservationsById();
            echo json_encode($observationsData);
            break;
    }
}

if (isset($_POST['observationsModule'])) {
    switch ($_POST['observationsModule']){
        case 'saveObservations':
            echo $observationsInstance -> saveObservationsController();
            break;
        case 'editObservation':
            echo $observationsInstance -> updateObservationsController();
            break;
        case 'deleteObservations':
            echo $observationsInstance -> deleteObservationsController();
            break;
    }
}
