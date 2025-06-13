<?php

require_once "../../config/app.php";
require_once "../views/includes/session_start.php";
require_once "../../autoload.php";

use app\controllers\departmentsController;
$departmentsInstance = new departmentsController();

if (isset($_POST['departmentModule'])) {
    switch ($_POST['departmentModule']) {
        case 'addDepartment':
            echo $departmentsInstance -> saveDepartmentsController();
            break;
    }
}