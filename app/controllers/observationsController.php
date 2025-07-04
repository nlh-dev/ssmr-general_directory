<?php

namespace app\controllers;

use app\models\mainModel;
use DateTime;


class observationsController extends mainModel
{
    public function getObservationsById()
    {
        $observationId = $this->cleanRequest($_GET['observation_ID']);
        $getObservationByID_SQL = "SELECT * FROM observations
        JOIN observations_priority
            ON observations.observations_priority_ID = observations_priority.observationsPriority_ID
        JOIN observations_type
            ON observations.observation_type_ID = observations_type.observationType_ID
        JOIN users
            ON observations.observation_user_ID = users.user_ID
        WHERE observations.observation_ID = '$observationId' LIMIT 1";

        $getObservationByID_Query = $this->dbRequestExecute($getObservationByID_SQL);
        $getObservationByID_Query->execute();
        return $getObservationByID_Query->fetch();
    }

    public function saveObservationsController()
    {
        $observationReason = strtoupper($this->cleanRequest($_POST['observationReason']));
        $observationDate = $this->cleanRequest($_POST['observationDate']);
        $observationType = $this->cleanRequest($_POST['observationType']);
        $observationPriority = $this->cleanRequest($_POST['observationPriority']);
        $observationDescription = ucfirst($this->cleanRequest($_POST['observationDescription']));

        if (empty($observationReason) || empty($observationDate) || empty($observationType) || empty($observationPriority)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡Algunos campos se encuentran vacios!",
            ];
            return json_encode($alert);
            exit();
        }

        $observationsRegisterData = [
            [
                "db_FieldName" => "observation_user_ID",
                "db_ValueName" => ":observationUser_ID",
                "db_realValue" => 1
            ],
            [
                "db_FieldName" => "observation_reason",
                "db_ValueName" => ":reason",
                "db_realValue" => $observationReason
            ],
            [
                "db_FieldName" => "observation_type_ID",
                "db_ValueName" => ":type_ID",
                "db_realValue" => $observationType
            ],
            [
                "db_FieldName" => "observations_priority_ID",
                "db_ValueName" => ":priority_ID",
                "db_realValue" => $observationPriority
            ],
            [
                "db_FieldName" => "observation_description",
                "db_ValueName" => ":description",
                "db_realValue" => $observationDescription
            ],
            [
                "db_FieldName" => "observation_createdAtDate",
                "db_ValueName" => ":createdAtDate",
                "db_realValue" => $observationDate
            ],
            [
                "db_FieldName" => "observation_createdAtTime",
                "db_ValueName" => ":createdAtTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "observation_updatedAtDate",
                "db_ValueName" => ":updatedAtDate",
                "db_realValue" => $observationDate
            ],
            [
                "db_FieldName" => "observation_updatedAtTime",
                "db_ValueName" => ":updatedAtTime",
                "db_realValue" => date('H:i:s')
            ],
        ];

        $addObservations = $this->saveData("observations", $observationsRegisterData);
        if ($addObservations->rowCount() >= 1) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "¡Observación Registrada Exitosamente!",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "¡Observación no Registrada, intente nuevamente!",
            ];
        }
        return json_encode($alert);
    }

    public function updateObservationsController()
    {
        $observationID = $this->cleanRequest($_POST['observation_ID']);
        $observationData = $this->dbRequestExecute("SELECT * FROM observations WHERE observation_ID = '$observationID'");
        if ($observationData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Observación no encontrada",
            ];
            return json_encode($alert);
            exit();
        } else {
            $observationData = $observationData->fetch();
        }

        $observationReason = strtoupper($this->cleanRequest($_POST['observationReason']));
        $observationDate = $this->cleanRequest($_POST['observationDate']);
        $observationType = $this->cleanRequest($_POST['observationType']);
        $observationPriority = $this->cleanRequest($_POST['observationPriority']);
        $observationDescription = $this->cleanRequest($_POST['observationDescription']);

        if (empty($observationReason) || empty($observationDate) || empty($observationType) || empty($observationPriority)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡Algunos campos se encuentran vacios!",
            ];
            return json_encode($alert);
            exit();
        }

        $observationDataUpdate = [
            [
                "db_FieldName" => "observation_reason",
                "db_ValueName" => ":reason",
                "db_realValue" => $observationReason
            ],
            [
                "db_FieldName" => "observation_type_ID",
                "db_ValueName" => ":type_ID",
                "db_realValue" => $observationType
            ],
            [
                "db_FieldName" => "observations_priority_ID",
                "db_ValueName" => ":priority_ID",
                "db_realValue" => $observationPriority
            ],
            [
                "db_FieldName" => "observation_description",
                "db_ValueName" => ":description",
                "db_realValue" => $observationDescription
            ],
            [
                "db_FieldName" => "observation_updatedAtDate",
                "db_ValueName" => ":updatedAtDate",
                "db_realValue" => date('Y-m-d')
            ],
            [
                "db_FieldName" => "observation_updatedAtTime",
                "db_ValueName" => ":updatedAtTime",
                "db_realValue" => date('H:i:s')
            ],
        ];

        $observationCondition = [
            "condition_FieldName" => "observation_ID",
            "condition_ValueName" => ":ID",
            "condition_realValue" => $observationID
        ];

        if ($this->updateData("observations", $observationDataUpdate, $observationCondition)) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operacion Realizada!",
                "text" => "Observacion Actualizada exitosamente",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Error al actualizar observacion, intente nuevamente",
            ];
        }
        return json_encode($alert);
    }

    public function deleteObservationsController()
    {
        $observationID = $this->cleanRequest($_POST['observation_ID']);

        $observationData = $this->dbRequestExecute("SELECT observation_ID FROM observations WHERE observation_ID = '$observationID'");
        if ($observationData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Observación no encontrada!",
            ];
            return json_encode($alert);
            exit();
        }

        if ($this->deleteData("observations", "observation_ID", $observationID)) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "Observación Eliminada exitosamente.",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "No se pudo eliminar el Dispositivo.",
            ];
        }
        return json_encode($alert);
    }

    public function observationsListTimeLineController($page, $register, $url, $search)
    {

        $page = $this->cleanRequest($page);
        $register = $this->cleanRequest($register);

        $url = $this->cleanRequest($url);
        $url = APP_URL . $url . "/";

        $search = $this->cleanRequest($search);
        $table = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;
        $start = ($page > 0) ? (($page * $register) - $register) : 0;

        $dataRequest_Query = "SELECT * FROM observations
        JOIN observations_priority 
        ON observations.observations_priority_ID = observations_priority.observationsPriority_ID
        JOIN observations_type 
        ON observations.observation_type_ID = observations_type.observationType_ID
        JOIN users 
        ON observations.observation_user_ID = users.user_ID
        WHERE observation_ID LIKE '%$search%' 
        OR observation_user_ID LIKE '%$search%' 
        OR observation_reason LIKE '%$search%' 
        OR observation_type_ID LIKE '%$search%' 
        OR observations_priority_ID LIKE '%$search%' 
        OR observation_description LIKE '%$search%'
        OR observation_createdAtDate LIKE '%$search%'
        OR observation_createdAtTime LIKE '%$search%'
        OR observation_updatedAtDate LIKE '%$search%'
        OR observation_updatedAtTime LIKE '%$search%'
        ORDER BY observation_createdAtDate DESC, observation_createdAtTime DESC
        LIMIT $start,$register";

        $totalData_Query = "SELECT COUNT(observation_ID) FROM observations
        JOIN observations_priority 
        ON observations.observations_priority_ID = observations_priority.observationsPriority_ID
        JOIN observations_type 
        ON observations.observation_type_ID = observations_type.observationType_ID
        JOIN users 
        ON observations.observation_user_ID = users.user_ID
        WHERE observation_ID LIKE '%$search%' 
        OR observation_user_ID LIKE '%$search%' 
        OR observation_reason LIKE '%$search%' 
        OR observation_type_ID LIKE '%$search%' 
        OR observations_priority_ID LIKE '%$search%' 
        OR observation_description LIKE '%$search%'
        OR observation_createdAtDate LIKE '%$search%'
        OR observation_createdAtTime LIKE '%$search%'
        OR observation_updatedAtDate LIKE '%$search%'
        OR observation_updatedAtTime LIKE '%$search%'";

        $data = $this->dbRequestExecute($dataRequest_Query);
        $data = $data->fetchAll();

        $total = $this->dbRequestExecute($totalData_Query);
        $total = (int) $total->fetchColumn();

        $numPages = ceil($total / $register);

        $orderedListClass = "relative border-s border-gray-200 dark:border-gray-700";
        if (!empty($data)) {
            $orderedListClass = "relative border-s border-gray-200 dark:border-gray-700";
        } else {
            $orderedListClass = "";
        }

        $table .= '<div class="'.$orderedListClass.'">
            <ol class="">';

        if ($total >= 1 && $page <= $numPages) {
            $counter = $start + 1;
            $startPage = $start + 1;
            foreach ($data as $rows) {
                $observationTimeDots = $this -> formatTimeDots($rows['observation_createdAtTime']);
                $table .= '
                    <li class="p-4 mb-2 ms-4 shadow-lg bg-gray-100 hover:bg-gray-200 rounded-2xl transition duration-100">
                        <div class="absolute w-3 h-3 bg-gray-700 rounded-full mt-1.5 -start-1.5"></div>
                        <div class="flex items-center justify-start">
                            <span class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#clipBoard" />
                                </svg>
                                Creada por: '.$rows['user_fullName'].'
                                </span>
                                <span class="text-sm text-gray-500 mx-1">|</span>
                                <span class="flex items-center text-sm text-gray-500 me-1">
                                <svg class="w-4 h-4 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#calendarPen" />
                                </svg>
                                    Fecha de Creación:
                                    ' . date('d/m/Y', strtotime($rows['observation_createdAtDate'])) . ', ' . $observationTimeDots . '                            
                                </span>
                        </div>
                        <div class="flex items-center space-x-2">
                        <span class="text-lg font-semibold text-gray-900">
                            ' . $rows['observation_reason'] . '
                        </span>
                        <div class="flex items-center">
                            <button data-modal-toggle="viewObservationInfo" data-modal-target="viewObservationInfo" id="eye-btn-' . $rows['observation_ID'] . '" data-popover-target="popover-eye-' . $rows['observation_ID'] . '" data-popover-placement="bottom" class="hidden text-blue-700 hover:bg-blue-700 hover:text-white text-xs font-medium px-1.5 py-1.5 rounded-full transition duration-100" data-observation-id="' . $rows['observation_ID'] . '">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="' . APP_URL . 'app/assets/svg/FlowbiteIcons.sprite.svg#eye"/>
                                </svg>
                            </button>
                            <div data-popover id="popover-eye-' . $rows['observation_ID'] . '" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                    <h3 class="font-semibold text-white text-xs">Ver</h3>
                                </div>
                                <div data-popper-arrow bg-gray-900></div>
                            </div>
                            <button data-modal-toggle="editObservation" data-modal-target="editObservation" id="editPen-btn-' . $rows['observation_ID'] . '" data-popover-target="popover-editPen-' . $rows['observation_ID'] . '" data-popover-placement="bottom" class="flex items-center text-yellow-400 hover:bg-yellow-500 hover:text-white text-xs font-medium px-1.5 py-1.5 rounded-full transition duration-100" data-observation-id="' . $rows['observation_ID'] . '">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#editPen" />
                                </svg>
                            </button>
                            <div data-popover id="popover-editPen-' . $rows['observation_ID'] . '" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                    <h3 class="font-semibold text-white text-xs">Editar</h3>
                                </div>
                                    <div data-popper-arrow bg-gray-900></div>
                            </div>
                            <form action="' . APP_URL . 'app/ajax/observationsAjax.php" class="AjaxForm" method="POST">
                                    <input type="hidden" name="observationsModule" value="deleteObservations">
                                    <input type="hidden" name="observation_ID" value="' . $rows['observation_ID'] . '">
                                    <button data-popover-target="popover-delete-' . $rows['observation_ID'] . '"
                                    data-popover-placement="bottom" class="flex items-center text-red-800 hover:bg-red-800 hover:text-white text-xs font-medium px-1.5 py-1.5 rounded-full transition duration-100">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#trashCan" />
                                        </svg>
                                    </button>
                                    <div data-popover id="popover-delete-' . $rows['observation_ID'] . '" role="tooltip"
                                    class="absolute flex z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                        <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                            <h3 class="font-semibold text-white text-xs">Eliminar</h3>
                                        </div>
                                            <div data-popper-arrow bg-gray-900></div>
                                    </div>
                                </form>
                        </div>
                        </div>';
                if (empty($rows['observation_description'])) {
                    $table .= '
                            <p class="mb-2 text-sm font-normal text-gray-500">
                                Sin Descripción
                            </p>';
                } else {
                    $table .= '
                            <p class="mb-2 text-sm font-normal text-gray-500">
                                ' . $rows['observation_description'] . '
                            </p>';
                }
                $table .= '
                        <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">';
                switch ($rows['observationType_name']) {
                    case 'Alerta':
                        $table .= '
                                    <span class="flex items-center bg-yellow-100 text-yellow-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-yellow-500 hover:text-white transition duration-100">
                                        <svg class="shrink-0 w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#mailBox" />
                                        </svg>
                                        Tipo: ' . $rows['observationType_name'] . '
                                    </span>';
                        break;
                    case 'Error':
                        $table .= '
                                    <span class="flex items-center bg-red-100 text-red-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-red-800 hover:text-white transition duration-100">
                                        <svg class="shrink-0 w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#mailBox" />
                                        </svg>
                                        Tipo: ' . $rows['observationType_name'] . '
                                    </span>';
                        break;
                    case 'Nota':
                        $table .= '
                                        <span class="flex items-center bg-indigo-100 text-indigo-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-indigo-800 hover:text-white transition duration-100">
                                        <svg class="shrink-0 w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#mailBox" />
                                        </svg>
                                        Tipo: ' . $rows['observationType_name'] . '
                                    </span>';
                        break;
                    case 'Sugerencia':
                        $table .= '
                                        <span class="flex items-center bg-emerald-100 text-emerald-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-emerald-900 hover:text-white transition duration-100">
                                        <svg class="shrink-0 w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#mailBox" />
                                        </svg>
                                        Tipo: ' . $rows['observationType_name'] . '
                                    </span>';
                        break;
                }
                switch ($rows['observationsPriority_name']) {
                    case 'Baja':
                        $table .= '
                                <span class="flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-green-800 hover:text-white transition duration-100">
                                    <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#bellActive" />
                                    </svg>
                                    Prioridad: ' . $rows['observationsPriority_name'] . '
                                </span>
                                    ';
                        break;
                    case 'Media':
                        $table .= '
                                <span class="flex items-center bg-teal-100 text-teal-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-teal-800 hover:text-white transition duration-100">
                                    <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#bellActive" />
                                    </svg>
                                    Prioridad: ' . $rows['observationsPriority_name'] . '
                                </span>
                                    ';
                        break;
                    case 'Alta':
                        $table .= '
                                <span class="flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-yellow-500 hover:text-white transition duration-100">
                                    <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#bellActive" />
                                    </svg>
                                    Prioridad: ' . $rows['observationsPriority_name'] . '
                                </span>
                                    ';
                        break;
                    case 'Critica':
                        $table .= '
                                <span class="flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-red-800 hover:text-white transition duration-100">
                                    <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#bellActive" />
                                    </svg>
                                    Prioridad: ' . $rows['observationsPriority_name'] . '
                                </span>
                                    ';
                        break;
                    default:
                        $table .= '
                                <span class="flex items-center bg-stone-100 text-stone-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-stone-800 hover:text-white transition duration-100">
                                    <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#bellActive" />
                                    </svg>
                                    Prioridad: ' . $rows['observationsPriority_name'] . '
                                </span>';
                        break;
                }
                $table .= '
                        </div>
                        </div>
                    </li>';
                $counter++;
            }
            $finalPage = $counter - 1;
        } else {
            $table .= '<li class="mb-10 p-4 bg-gray-100 hover:bg-gray-200 rounded-md transition duration-200">
                            <div class="text-center text-gray-500">
                                No se encontraron registros
                            </div>
                        </li>';
        }
        $table .= '</ol>
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
