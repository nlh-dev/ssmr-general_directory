<?php

namespace app\controllers;

use app\models\mainModel;
use DateTime;

class departmentsController extends mainModel
{

    public function getDepartmentsByIdController()
    {
        $departmentId = $this->cleanRequest($_GET['department_ID']);
        $getDepartment_SQL = "SELECT * FROM departments dep 
        JOIN locations loc ON dep.department_location_ID = loc.location_ID
        WHERE department_ID = '$departmentId' LIMIT 1";
        $getDepartments_Query = $this->dbRequestExecute($getDepartment_SQL);
        $getDepartments_Query->execute();
        return $getDepartments_Query->fetch();
    }

    public function saveDepartmentsController()
    {
        $departmentName = ucwords($this->cleanRequest($_POST['departmentName']));
        $selectedLocation = $this->cleanRequest($_POST['locations']);

        if (empty($departmentName) || empty($selectedLocation)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡Algunos campos se encuentran vacios!",
            ];
            return json_encode($alert);
            exit();
        }

        $checkLocationState = $this->dbRequestExecute("SELECT location_isEnable FROM locations WHERE location_ID = '$selectedLocation'");
        $location = $checkLocationState->fetch();
        if (!$location || $location['location_isEnable'] != 1) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡Esta Ubicación se encuentra Deshabilitada!",
            ];
            return json_encode($alert);
            exit();
        }

        $checkDepartments_SQL = "SELECT * FROM departments 
        WHERE department_name = '$departmentName' AND department_location_ID = '$selectedLocation'";
        $checkDepartmentName = $this->dbRequestExecute($checkDepartments_SQL);
        if ($checkDepartmentName->rowCount() >= 1) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡El Departamento " . $departmentName . " ya está Registrado!",
            ];
            return json_encode($alert);
            exit();
        }

        $departmentRegisterData = [
            [
                "db_FieldName" => "department_name",
                "db_ValueName" => ":departmentName",
                "db_realValue" => $departmentName
            ],
            [
                "db_FieldName" => "department_location_ID",
                "db_ValueName" => ":location_ID",
                "db_realValue" => $selectedLocation
            ],
            [
                "db_FieldName" => "department_createdAtDate",
                "db_ValueName" => ":createdAtDate",
                "db_realValue" => date('Y-m-d')
            ],
            [
                "db_FieldName" => "department_createdAtTime",
                "db_ValueName" => ":createdAtTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "department_updatedAtDate",
                "db_ValueName" => ":updatedAtDate",
                "db_realValue" => date('Y-m-d')
            ],
            [
                "db_FieldName" => "department_updatedAtTime",
                "db_ValueName" => ":updatedAtTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "department_isEnable",
                "db_ValueName" => ":isEnable",
                "db_realValue" => true
            ],
        ];

        $saveDepartments = $this->saveData("departments", $departmentRegisterData);
        if ($saveDepartments->rowCount() >= 1) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "Departamento " . $departmentName . " registrado exitosamente!",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Departamento no registrado, intente nuevamente!",
            ];
        }
        return json_encode($alert);
    }

    private function formatTimeDots($timeString)
    {
        $dateTime = new DateTime($timeString);
        return str_replace(['am', 'pm'], ["a. m.", "p. m."], $dateTime->format("h:i a"));
    }

    public function updateDepartmentStateController()
    {
        $departmentID = $this->cleanRequest($_POST['department_ID']);

        $departmentData = $this->dbRequestExecute("SELECT * FROM departments WHERE department_ID = '$departmentID'");
        if ($departmentData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Registro no encontrado!",
            ];
            return json_encode($alert);
            exit();
        }

        $departmentLocationData = $this->dbRequestExecute("SELECT department_location_ID FROM departments WHERE department_ID = '$departmentID'");
        $departmentLocation = $departmentLocationData->fetch();
        if (!$departmentLocation) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Departamento no encontrado!",
            ];
            return json_encode($alert);
            exit();
        }

        $locationID = $departmentLocation['department_location_ID'];
        $locationStateData = $this->dbRequestExecute("SELECT location_isEnable FROM locations WHERE location_ID = '$locationID'");
        $locationState = $locationStateData->fetch();
        if (!$locationState || $locationState['location_isEnable'] != 1) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Actualizar!",
                "text" => "No se puede habilitar porque la Ubicación esta deshabilitada.",
            ];
            return json_encode($alert);
            exit();
        }

        $departmentCurrentState = $departmentData->fetch()['department_isEnable'];
        $departmentNewState = $departmentCurrentState ? 0 : 1;

        $departmentStateData = [
            [
                "db_FieldName" => "department_isEnable",
                "db_ValueName" => ":isEnable",
                "db_realValue" => $departmentNewState
            ],
            [
                "db_FieldName" => "department_updatedAtDate",
                "db_ValueName" => ":updatedAtDate",
                "db_realValue" => date('Y-m-d')
            ],
            [
                "db_FieldName" => "department_updatedAtTime",
                "db_ValueName" => ":updatedAtTime",
                "db_realValue" => date('H:i:s')
            ],
        ];

        $departmentCondition = [
            "condition_FieldName" => "department_ID",
            "condition_ValueName" => ":ID",
            "condition_realValue" => $departmentID
        ];

        $saveDepartmentsState = $this->updateData("departments", $departmentStateData, $departmentCondition);
        if ($saveDepartmentsState->rowCount() >= 1) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "Estado actualizado exitosamente.",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "No se pudo actualizar el estado.",
            ];
        }
        return json_encode($alert);
    }

    public function updateDepartmentsController()
    {
        $departmentID = $this->cleanRequest($_POST['department_ID']);
        $departmentData = $this->dbRequestExecute("SELECT * FROM departments WHERE department_ID = '$departmentID'");
        if ($departmentData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Departamento no encontrado!",
            ];
            return json_encode($alert);
            exit();
        } else {
            $departmentData = $departmentData->fetch();
        }

        $departmentName = ucwords($this->cleanRequest($_POST['departmentName']));
        $locationName = $this->cleanRequest($_POST['locations']);

        if (empty($departmentName) || empty($locationName)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡Algunos campos se encuentran vacios!",
            ];
            return json_encode($alert);
            exit();
        }

        $departmentDataUpdate = [
            [
                "db_FieldName" => "department_name",
                "db_ValueName" => ":name",
                "db_realValue" => $departmentName
            ],
            [
                "db_FieldName" => "department_location_ID",
                "db_ValueName" => ":location_ID",
                "db_realValue" => $locationName
            ],
            [
                "db_FieldName" => "department_updatedAtDate",
                "db_ValueName" => ":updatedAtDate",
                "db_realValue" => date('Y-m-d')
            ],
            [
                "db_FieldName" => "department_updatedAtTime",
                "db_ValueName" => ":updatedAtTime",
                "db_realValue" => date('H:i:s')
            ],
        ];

        $departmentCondition = [
            "condition_FieldName" => "department_ID",
            "condition_ValueName" => ":ID",
            "condition_realValue" => $departmentID
        ];

        if ($this->updateData("departments", $departmentDataUpdate, $departmentCondition)) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operacion Realizada!",
                "text" => "Departamento Actualizado exitosamente",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Error al actualizar departamento, intente nuevamente",
            ];
        }
        return json_encode($alert);
    }

    public function deleteDepartmentController()
    {
        $departmentID = $this->cleanRequest($_POST['department_ID']);

        $departmentData = $this->dbRequestExecute("SELECT department_ID FROM departments WHERE department_ID = '$departmentID'");
        if ($departmentData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Registro no encontrado!",
            ];
            return json_encode($alert);
            exit();
        }

        if ($this->deleteData("departments", "department_ID", $departmentID)) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "Departamento eliminado exitosamente.",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "No se pudo eliminar el Departamento.",
            ];
        }
        return json_encode($alert);
    }


    public function departmentsListController($page, $register, $url, $search)
    {

        $page = $this->cleanRequest($page);
        $register = $this->cleanRequest($register);

        $url = $this->cleanRequest($url);
        $url = APP_URL . $url . "/";

        $search = $this->cleanRequest($search);
        $table = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;
        $start = ($page > 0) ? (($page * $register) - $register) : 0;

        $dataRequest_Query = "SELECT * FROM departments dep
        JOIN locations loc ON dep.department_location_ID = loc.location_ID
        WHERE department_name LIKE '%$search%' 
        OR department_location_ID LIKE '%$search%' 
        OR department_createdAtDate LIKE '%$search%' 
        OR department_createdAtTime LIKE '%$search%' 
        OR department_updatedAtDate LIKE '%$search%'
        OR department_updatedAtTime LIKE '%$search%'
        OR department_isEnable LIKE '%$search%'
        ORDER BY location_name ASC, department_name ASC
        LIMIT $start, $register";

        $totalData_Query = "SELECT COUNT(department_ID) FROM departments dep
        JOIN locations loc ON dep.department_location_ID = loc.location_ID
        WHERE department_name LIKE '%$search%' 
        OR department_location_ID LIKE '%$search%' 
        OR department_createdAtDate LIKE '%$search%' 
        OR department_createdAtTime LIKE '%$search%' 
        OR department_updatedAtDate LIKE '%$search%'
        OR department_updatedAtTime LIKE '%$search%'
        OR department_isEnable LIKE '%$search%'";

        $data = $this->dbRequestExecute($dataRequest_Query);
        $data = $data->fetchAll();

        $total = $this->dbRequestExecute($totalData_Query);
        $total = (int) $total->fetchColumn();

        $numPages = ceil($total / $register);

        $table .= '<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border-collapse">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-900 text-white">
                                    <tr class="">
                                        <th scope="col" class="px-5 py-3">
                                            #
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            Departamento
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            Fecha de Creación
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            Fecha de Modificación
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            Estado
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                            </thead>
                            <tbody>';
        if ($total >= 1 && $page <= $numPages) {
            $counter = $start + 1;
            $startPage = $start + 1;
            foreach ($data as $rows) {
                $departmentCreateTimeDots = $this->formatTimeDots($rows['department_createdAtTime']);
                $departmentUpdateTimeDots = $this->formatTimeDots($rows['department_updatedAtTime']);
                $table .= '
                    <tr class="bg-white border-b border-gray-200 text-gray-800 hover:bg-gray-200 transition duration-100">
                        <td class="px-5 py-2 whitespace-nowrap text-xs text-gray-400">' . $counter . '</td>
                        <td class="px-5 py-2 font-medium text-gray-900 whitespace-nowrap">
                        <p class="text-xs">' . $rows['department_name'] . '</p>
                        <div class="flex items-center">';
                if ($rows['location_isEnable'] == 1) {
                    $table .= '
                            <span class="flex items-center bg-green-100 text-green-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-green-900 hover:text-white transition duration-100 mt-1">
                                <svg class="shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="' . APP_URL . 'app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation"/>
                            </svg>
                            ' . $rows['location_name'] . '
                            </span>';
                } else {
                    $table .= '
                            <span class="flex items-center bg-red-100 text-red-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-red-900 hover:text-white transition duration-100 mt-1">
                                <svg class="shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="' . APP_URL . 'app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation"/>
                            </svg>
                            ' . $rows['location_name'] . '
                            </span>';
                }
                $table .= '
                        </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center">
                            <span class="flex items-center bg-blue-100 text-blue-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-blue-900 hover:text-white transition duration-100">
                                <svg class="shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#calendarPen" />
                                </svg>
                                ' . date('d/m/Y', strtotime($rows['department_createdAtDate'])) . ', ' . $departmentCreateTimeDots . '
                            </span>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                        <div class="flex items-center">
                        <span class="flex items-center bg-purple-200 text-purple-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-purple-900 hover:text-white transition duration-100">
                            <svg class="shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#calendarPen" />
                            </svg>
                            ' . date('d/m/Y', strtotime($rows['department_updatedAtDate'])) . ', ' . $departmentUpdateTimeDots . '
                        </span>
                        </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">';
                if ($rows['department_isEnable'] == 1) {
                    $table .= '
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                    <p class="font-semibold text-green-500">Habilitado</p>
                            </div>';
                } else {
                    $table .= '
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-red-700 me-2"></div>
                                <p class="font-semibold text-red-700">Deshabilitado</p>
                            </div>';
                }
                $table .= '
                        </td>
                        <td class="items-center px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center justify-center space-x-1">
                                <div class="flex items-center">
                                    <button data-modal-target="editDepartment" data-modal-toggle="editDepartment"
                                    id="editPen-btn-' . $rows['department_ID'] . '"
                                    data-popover-target="popover-editPen-' . $rows['department_ID'] . '"
                                    data-popover-placement="bottom"
                                    data-department-id="' . $rows['department_ID'] . '" class="flex items-center text-yellow-400 border border-yellow-400 hover:bg-yellow-500 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#editPen" />
                                        </svg>
                                    </button>
                                    <div data-popover id="popover-editPen-' . $rows['department_ID'] . '" role="tooltip"
                                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                        <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                            <h3 class="font-semibold text-white text-xs">Editar</h3>
                                        </div>
                                            <div data-popper-arrow bg-gray-900></div>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                <form action="' . APP_URL . 'app/ajax/departmentsAjax.php" class="AjaxForm" method="POST">
                                    <input type="hidden" name="departmentModule" value="deleteDepartment">
                                    <input type="hidden" name="department_ID" value="' . $rows['department_ID'] . '">
                                    <button class="flex items-center text-red-800 border border-red-700 hover:bg-red-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100" data-popover-target="popover-trashCan-' . $rows['department_ID'] . '"
                                    data-popover-placement="bottom">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#trashCan" />
                                        </svg>
                                    </button>
                                    </form>
                                    <div data-popover id="popover-trashCan-' . $rows['department_ID'] . '" role="tooltip"
                                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                        <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                            <h3 class="font-semibold text-white text-xs">Eliminar</h3>
                                        </div>
                                            <div data-popper-arrow bg-gray-900></div>
                                    </div>
                                </div>
                                <form action="' . APP_URL . 'app/ajax/departmentsAjax.php" class="AjaxForm" method="POST">
                                    <input type="hidden" name="departmentModule" value="updateDepartmentState">
                                    <input type="hidden" name="department_ID" value="' . $rows['department_ID'] . '">
                                    <div class="flex items-center">
                                        <button type="submit" class="flex items-center text-green-700 border border-green-700 hover:bg-green-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100" data-popover-target="popover-arrowRepeat-' . $rows['department_ID'] . '" data-popover-placement="bottom">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                                <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#arrowRepeat" />
                                            </svg>
                                        </button>
                                        <div data-popover id="popover-arrowRepeat-' . $rows['department_ID'] . '" role="tooltip"
                                        class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                        <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                            <h3 class="font-semibold text-white text-xs">Cambiar Estado</h3>
                                        </div>
                                            <div data-popper-arrow bg-gray-900></div>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>';;
                $counter++;
            }
            $finalPage = $counter - 1;
        } else {
            if ($total >= 1) {
                $table .= '
                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-200" >
                        <td colspan="7">
                        <div class= "flex justify-center items-center my-4">
                            No se encontraron registros en esta pagina
                        </div>
                        <div class= "flex justify-center items-center my-4">
                            <a href="' . $url . '1/" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
                                Haz click aqui para recargar
                            </a>
                        </div>
                        </td>
                    </tr>
                ';
            } else {
                $table .= '
                    <tr class="bg-white border-b border-gray-200 hover:bg-gray-200">
                        <td colspan="7">
                        <div class= "flex justify-center items-center my-4">
                            No se encontraron registros
                        </div>
                        </td>
                    </tr>
                ';
            }
        }
        $table .= '</tbody>
                        </table>
                    </div>
                </div>
        ';


        if ($total > 0 && $page <= $numPages) {
            $table .= '<div class="flex justify-end items-center">
                            <p class="has-text-right">
                                Mostrando de <strong>' . $startPage . '</strong> a <strong>' .  $finalPage . ' </strong> de un total de <strong> ' . $total . '</strong> registros
                            </p>
                        </div>';

            $table .= $this->paginationData($page, $numPages, $url, 1);
        }
        return $table;
    }
}
