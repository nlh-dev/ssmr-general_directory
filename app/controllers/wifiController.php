<?php

namespace app\controllers;

use app\models\mainModel;

class wifiController extends mainModel
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
        $getDepartments_Query = "SELECT * FROM locations";
        $getDepartments_SLQ = $this->dbRequestExecute($getDepartments_Query);
        $getDepartments_SLQ->execute();
        return $getDepartments_SLQ;
    }

            public function getDepartmentsByLocationController(){
        if (isset($_GET['location_id'])) {
            $locationId = $_GET['location_id'];
            $sql = "SELECT departments.department_ID, departments.department_name FROM departments
                    JOIN locations ON departments.department_location_ID = locations.location_ID
                    WHERE locations.location_ID = :locationId
                    ORDER BY departments.department_name ASC";

            $stmt = $this->dbRequestExecute($sql);
            $stmt->bindParam(':locationId', $locationId, \PDO::PARAM_INT);
            $stmt->execute();
            $departments = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            echo json_encode($departments);
        } else {
            echo json_encode([]);
        }
    }
}
