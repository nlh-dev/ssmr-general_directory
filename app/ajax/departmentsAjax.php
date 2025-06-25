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

// Endpoint para obtener departamentos por ubicación (usado en el modal de Wifi)
if (isset($_POST['getDepartmentsByLocation']) && isset($_POST['location_ID'])) {
    $locationId = $_POST['location_ID'];
    // Debes tener un método en el controlador que obtenga los departamentos por ubicación
    $departmentsList = $departmentsInstance->getDepartmentsByLocationController($locationId);
    // Se espera que retorne un array asociativo con department_ID y department_name
    header('Content-Type: application/json');
    echo json_encode($departmentsList);
    exit();
}