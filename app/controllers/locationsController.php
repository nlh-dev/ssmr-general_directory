<?php

namespace app\controllers;

use app\models\mainModel;
use DateTime;


class locationsController extends mainModel
{

    public function addLocationsController()
    {
        $locationName = $this->cleanRequest($_POST['locationName']);

        if (empty($locationName)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡Algunos campos se encuentran vacios!",
            ];
            return json_encode($alert);
            exit();
        }

        $checkLocationName = $this->dbRequestExecute("SELECT location_name FROM locations WHERE location_name = '$locationName'");
        if ($checkLocationName->rowCount() >= 1) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡Esta Ubicación ya se encuentra Registrada!",
            ];
            return json_encode($alert);
            exit();
        }

        $locationRegisterData = [
            [
                "db_FieldName" => "location_name",
                "db_ValueName" => ":locationName",
                "db_realValue" => $locationName
            ],
            [
                "db_FieldName" => "location_createdAtDate",
                "db_ValueName" => ":createdAtDate",
                "db_realValue" => date('Y-m-d')
            ],
            [
                "db_FieldName" => "location_createdAtTime",
                "db_ValueName" => ":createdAtTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "location_updatedAtDate",
                "db_ValueName" => ":updatedAtDate",
                "db_realValue" => date('Y-m-d')
            ],
            [
                "db_FieldName" => "location_updatedAtTime",
                "db_ValueName" => ":updatedAtTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "location_isEnable",
                "db_ValueName" => ":isEnable",
                "db_realValue" => true
            ],
        ];

        $saveLocation = $this->saveData("locations", $locationRegisterData);
        if ($saveLocation->rowCount() >= 1) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "La Ubicacion " . $locationName . " fue registrada exitosamente!",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "¡Ubicación no registrada, intente nuevamente!",
            ];
        }
        return json_encode($alert);
    }

    private function formatTimeDots($timeString)
    {
        $dateTime = new DateTime($timeString);
        return str_replace(['am', 'pm'], ["a. m.", "p. m."], $dateTime->format("h:i a"));
    }

    public function updateLocationsStateController()
    {
        $locationID = $this->cleanRequest($_POST['location_ID']);

        $locationData = $this->dbRequestExecute("SELECT location_isEnable FROM locations WHERE location_ID = '$locationID'");
        if ($locationData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Registro no encontrado!",
            ];
            return json_encode($alert);
            exit();
        }

        $locationCurrentState = $locationData->fetch()['location_isEnable'];
        $locationNewState = $locationCurrentState ? 0 : 1;

        $locationStateData = [
            [
                "db_FieldName" => "location_isEnable",
                "db_ValueName" => ":isEnable",
                "db_realValue" => $locationNewState
            ],
            [
                "db_FieldName" => "location_updatedAtDate",
                "db_ValueName" => ":updatedAtDate",
                "db_realValue" => date('Y-m-d')
            ],
            [
                "db_FieldName" => "location_updatedAtTime",
                "db_ValueName" => ":updatedAtTime",
                "db_realValue" => date('H:i:s')
            ],
        ];

        $locationCondition = [
            "condition_FieldName" => "location_ID",
            "condition_ValueName" => ":ID",
            "condition_realValue" => $locationID
        ];

        if ($this->updateData("locations", $locationStateData, $locationCondition)) {
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

    public function deleteLocationController()
    {
        $locationID = $this->cleanRequest($_POST['location_ID']);

        $locationData = $this->dbRequestExecute("SELECT location_ID FROM locations WHERE location_ID = '$locationID'");
        if ($locationData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Registro no encontrado!",
            ];
            return json_encode($alert);
            exit();
        }

        if ($this->deleteData("locations", "location_ID", $locationID)) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "Ubicacion eliminada exitosamente.",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "No se pudo eliminar la Ubicación.",
            ];
        }
        return json_encode($alert);
    }

    public function locationsListController($page, $register, $url, $search)
    {

        $page = $this->cleanRequest($page);
        $register = $this->cleanRequest($register);

        $url = $this->cleanRequest($url);
        $url = APP_URL . $url . "/";

        $search = $this->cleanRequest($search);
        $table = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;
        $start = ($page > 0) ? (($page * $register) - $register) : 0;

        $dataRequest_Query = "SELECT * FROM locations
        WHERE location_name LIKE '%$search%' 
        OR location_createdAtDate LIKE '%$search%' 
        OR location_createdAtTime LIKE '%$search%' 
        OR location_updatedAtDate LIKE '%$search%' 
        OR location_updatedAtTime LIKE '%$search%'
        OR location_isEnable LIKE '%$search%'
        ORDER BY location_name ASC
        LIMIT $start,$register";

        $totalData_Query = "SELECT COUNT(location_ID) FROM locations
        WHERE location_name LIKE '%$search%' 
        OR location_createdAtDate LIKE '%$search%' 
        OR location_createdAtTime LIKE '%$search%' 
        OR location_updatedAtDate LIKE '%$search%' 
        OR location_updatedAtTime LIKE '%$search%'
        OR location_isEnable LIKE '%$search%'";

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
                                            Ubicación
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
                $locationCreateTimeDots = $this->formatTimeDots($rows['location_createdAtTime']);
                $locationUpdateTimeDots = $this->formatTimeDots($rows['location_updatedAtTime']);
                $table .= '
                    <tr class="bg-white border-b border-gray-200 text-gray-800 hover:bg-gray-200 transition duration-100">
                        <td class="px-5 py-2 whitespace-nowrap text-xs text-gray-400">' . $counter . '</td>
                        <td scope="row" class="px-5 py-2 font-medium text-gray-900 whitespace-nowrap">
                        <div class="flex items-center">
                        <svg class="shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                            </svg>
                        <p class="text-xs">' . $rows['location_name'] . '</p>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center">
                            <span class="flex items-center bg-blue-100 text-blue-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-blue-900 hover:text-white transition duration-100">
                                <svg class="shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#calendarPen" />
                                </svg>
                                ' . date('d/m/Y', strtotime($rows['location_createdAtDate'])) . ' - ' . $locationCreateTimeDots . '
                            </span>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                        <div class="flex items-center">
                        <span class="flex items-center bg-purple-200 text-purple-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-purple-900 hover:text-white transition duration-100">
                            <svg class="shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#calendarPen" />
                            </svg>
                            ' . date('d/m/Y', strtotime($rows['location_updatedAtDate'])) . ' - ' . $locationUpdateTimeDots . '
                        </span>
                        </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">';
                if ($rows['location_isEnable'] == 1) {
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
                                    <button data-modal-target="editLocation" data-modal-toggle="editLocation"
                                    id="editPen-btn-' . $rows['location_ID'] . '"
                                    data-popover-target="popover-editPen-' . $rows['location_ID'] . '"
                                    data-popover-placement="bottom"
                                    data-wifi-id="' . $rows['location_ID'] . '" class="flex items-center text-yellow-400 border border-yellow-400 hover:bg-yellow-500 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#editPen" />
                                        </svg>
                                    </button>
                                    <div data-popover id="popover-editPen-' . $rows['location_ID'] . '" role="tooltip"
                                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                        <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                            <h3 class="font-semibold text-white text-xs">Editar</h3>
                                        </div>
                                            <div data-popper-arrow bg-gray-900></div>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                <form action="'.APP_URL.'app/ajax/locationsAjax.php" class="AjaxForm" method="POST">
                                    <input type="hidden" name="locationModule" value="deleteLocation">
                                    <input type="hidden" name="location_ID" value="' . $rows['location_ID'] . '">
                                    <button class="flex items-center text-red-800 border border-red-700 hover:bg-red-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100" data-popover-target="popover-trashCan-' . $rows['location_ID'] . '"
                                    data-popover-placement="bottom">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#trashCan" />
                                        </svg>
                                    </button>
                                    </form>
                                    <div data-popover id="popover-trashCan-' . $rows['location_ID'] . '" role="tooltip"
                                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                        <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                            <h3 class="font-semibold text-white text-xs">Eliminar</h3>
                                        </div>
                                            <div data-popper-arrow bg-gray-900></div>
                                    </div>
                                </div>
                                <form action="' . APP_URL . 'app/ajax/locationsAjax.php" class="AjaxForm" method="POST">
                                    <input type="hidden" name="locationModule" value="updateLocationState">
                                    <input type="hidden" name="location_ID" value="' . $rows['location_ID'] . '">
                                    <div class="flex items-center">
                                        <button type="submit" class="flex items-center text-green-700 border border-green-700 hover:bg-green-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100" data-popover-target="popover-arrowRepeat-' . $rows['location_ID'] . '" data-popover-placement="bottom">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                                <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#arrowRepeat" />
                                            </svg>
                                        </button>
                                        <div data-popover id="popover-arrowRepeat-' . $rows['location_ID'] . '" role="tooltip"
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
