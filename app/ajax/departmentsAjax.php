<?php

require_once "../../config/app.php";
require_once "../views/includes/session_start.php";
require_once "../../autoload.php";

use app\controllers\departmentsController;
$departmentsInstance = new departmentsController();

if (isset($_GET['departmentModule']) && isset($_GET['department_ID'])) {
    $departmentId = $_GET['department_ID'];
    switch ($_GET['departmentModule']) {
        case 'getDepartmentData':
            $departmentData = $departmentsInstance->getDepartmentsByIdController();
            echo json_encode($departmentData);
    }
}

if (isset($_POST['departmentModule'])) {
    switch ($_POST['departmentModule']) {
        case 'addDepartment':
            echo $departmentsInstance -> saveDepartmentsController();
            break;
        case 'deleteDepartment':
            echo $departmentsInstance -> deleteDepartmentController();
            break;
        case 'updateDepartmentState':
            echo $departmentsInstance -> updateDepartmentStateController();
            break;
        case 'editDepartment':
            echo $departmentsInstance -> updateDepartmentsController();
            break;
    }
}

if (isset($_POST['getDepartmentsByLocation']) && isset($_POST['location_ID'])) {
    $locationId = $_POST['location_ID'];
    $departmentsList = $departmentsInstance->getDepartmentsByLocationController($locationId);
    header('Content-Type: application/json');
    echo json_encode($departmentsList);
    exit();
}