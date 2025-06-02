<?php

require_once "../../config/app.php";
require_once "../views/includes/session_start.php";
require_once "../../autoload.php";

use app\controllers\observationsController;

$observationsInstance = new observationsController();

if (isset($_POST['observationsModule'])) {
    switch ($_POST['observationsModule']){
        case 'saveObservations':
            echo $observationsInstance -> saveObservationsController();
            break;
    }
}
