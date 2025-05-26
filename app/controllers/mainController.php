<?php

    namespace app\controllers;
    use app\models\mainModel;

class mainController extends mainModel{
    public function getDepartmentsController()
    {
        $getDepartments_Query = "SELECT * FROM departments";
        $getDepartments_SLQ = $this->dbRequestExecute($getDepartments_Query);
        $getDepartments_SLQ->execute();
        return $getDepartments_SLQ;
    }

    public function getLocationsController()
    {
        $getDepartments_Query = "SELECT * FROM locations";
        $getDepartments_SLQ = $this->dbRequestExecute($getDepartments_Query);
        $getDepartments_SLQ->execute();
        return $getDepartments_SLQ;
    }
}
