<?php

namespace app\controllers;

use app\models\mainModel;

class mainController extends mainModel
{
    public function getDepartmentsController()
    {
        $getDepartments_Query = "SELECT * FROM departments";
        $getDepartments_SLQ = $this->dbRequestExecute($getDepartments_Query);
        $getDepartments_SLQ->execute();
        return $getDepartments_SLQ;
    }

    public function getLocationsController()
    {
        $getLocations_Query = "SELECT * FROM locations";
        $getLocations_SLQ = $this->dbRequestExecute($getLocations_Query);
        $getLocations_SLQ->execute();
        return $getLocations_SLQ;
    }

    public function getObservationsTypeController()
    {
        $getObservationsType_Query = "SELECT * FROM observations_type";
        $getObservationsType_SLQ = $this->dbRequestExecute($getObservationsType_Query);
        $getObservationsType_SLQ->execute();
        return $getObservationsType_SLQ;
    }

    public function getObservationsPriorityController()
    {
        $getObservationsPriority_Query = "SELECT * FROM observations_priority";
        $getObservationsPriority_SLQ = $this->dbRequestExecute($getObservationsPriority_Query);
        $getObservationsPriority_SLQ->execute();
        return $getObservationsPriority_SLQ;
    }
}
