<?php

namespace app\controllers;

use app\models\mainModel;
use DateTime;

class storageController extends mainModel
{
    // GENERAL FUNCTIONS
    private function formatTimeDots($timeString)
    {
        $dateTime = new DateTime($timeString);
        return str_replace(['am', 'pm'], ["a. m.", "p. m."], $dateTime->format("h:i a"));
    }

    // STORAGE TYPES CONTROLLER
    public function getStorageTypeDataController()
    {
        $locationId = $this->cleanRequest($_GET['storageType_ID']);
        $getLocations_SQL = "SELECT * FROM storage_types WHERE storageType_ID = '$locationId' LIMIT 1";
        $getLocations_Query = $this->dbRequestExecute($getLocations_SQL);
        $getLocations_Query->execute();
        return $getLocations_Query->fetch();
    }

    public function updateStorageTypeController()
    {
        $typeID = $this->cleanRequest($_POST['storageType_ID']);
        $storageTypeName = ucwords($this->cleanRequest($_POST['storageTypeName']));

        if (empty($storageTypeName)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Actualizar!",
                "text" => "¡El campo se encuentra Vacío!",
            ];
            return json_encode($alert);
            exit();
        }

        $storageTypeData = $this->dbRequestExecute("SELECT * FROM storage_types WHERE storageType_ID = '$typeID'");
        if ($storageTypeData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Registro no encontrado!",
            ];
            return json_encode($alert);
            exit();
        }

        $updateStorageTypeData = [
            [
                "db_FieldName" => "storageType_name",
                "db_ValueName" => ":Type_name",
                "db_realValue" => $storageTypeName
            ],
            [
                "db_FieldName" => "storageType_updatedAtDate",
                "db_ValueName" => ":Type_updatedAtDate",
                "db_realValue" => date('Y-m-d')
            ],
            [
                "db_FieldName" => "storageType_updatedAtTime",
                "db_ValueName" => ":Type_updatedAtTime",
                "db_realValue" => date('H:i:s')
            ],
        ];

        $updateCondition = [
            "condition_FieldName" => "storageType_ID",
            "condition_ValueName" => ":ID",
            "condition_realValue" => $typeID
        ];

        $updateStorageType = $this->updateData("storage_types", $updateStorageTypeData, $updateCondition);
        if ($updateStorageType->rowCount() >= 1) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "Tipo de Artículo actualizado exitosamente.",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "No se pudo actualizar el Tipo de Artículo.",
            ];
        }
        return json_encode($alert);
    }

    public function updateStorageTypeStatusController()
    {
        $typeID = $this->cleanRequest($_POST['storageType_ID']);

        $storageTypeData = $this->dbRequestExecute("SELECT * FROM storage_types WHERE storageType_ID = '$typeID'");
        if ($storageTypeData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Registro no encontrado!",
            ];
            return json_encode($alert);
            exit();
        }

        $storageTypeCurrentState = $storageTypeData->fetch()['storageType_isEnable'];
        $storageTypeNewState = $storageTypeCurrentState ? 0 : 1;

        $storageTypeStateData = [
            [
                "db_FieldName" => "storageType_isEnable",
                "db_ValueName" => ":isEnable",
                "db_realValue" => $storageTypeNewState
            ],
            [
                "db_FieldName" => "storageType_updatedAtDate",
                "db_ValueName" => ":updatedAtDate",
                "db_realValue" => date('Y-m-d')
            ],
            [
                "db_FieldName" => "storageType_updatedAtTime",
                "db_ValueName" => ":updatedAtTime",
                "db_realValue" => date('H:i:s')
            ],
        ];

        $storageTypeCondition = [
            "condition_FieldName" => "storageType_ID",
            "condition_ValueName" => ":ID",
            "condition_realValue" => $typeID
        ];

        $saveDepartmentsState = $this->updateData("storage_types", $storageTypeStateData, $storageTypeCondition);
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

    public function deleteStorageTypeController()
    {
        $typeID = $this->cleanRequest($_POST['storageType_ID']);

        $storageTypeData = $this->dbRequestExecute("SELECT * FROM storage_types WHERE storageType_ID = '$typeID'");
        if ($storageTypeData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Registro no encontrado!",
            ];
            return json_encode($alert);
            exit();
        }

        $deleteStorageType = $this->deleteData("storage_types", "storageType_ID", $typeID);
        if ($deleteStorageType->rowCount() >= 1) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "Tipo de Artículo eliminado exitosamente.",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "No se pudo eliminar el Tipo de Artículo.",
            ];
        }
        return json_encode($alert);
    }


    public function addStorageTypeController()
    {
        $storageTypeName = ucwords($this->cleanRequest($_POST['storageTypeName']));

        if (empty($storageTypeName)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡El campo se encuentra Vacío!",
            ];
            return json_encode($alert);
            exit();
        }

        $typeExist = "SELECT * FROM storage_types 
        WHERE storageType_name = '$storageTypeName'";
        $storageTypeExist = $this->dbRequestExecute($typeExist);
        $storageTypeExist->execute();
        if ($storageTypeExist->rowCount() > 0) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡El Tipo de Artículo ya secencuentra Registrado!",
            ];
            return json_encode($alert);
            exit();
        }

        $storageTypeRegisterData = [
            [
                "db_FieldName" => "storageType_name",
                "db_ValueName" => ":Type_name",
                "db_realValue" => $storageTypeName
            ],
            [
                "db_FieldName" => "storageType_createdAtDate",
                "db_ValueName" => ":Type_createdAtDate",
                "db_realValue" => date('Y-m-d')
            ],
            [
                "db_FieldName" => "storageType_createdAtTime",
                "db_ValueName" => ":Type_createdAtTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "storageType_updatedAtDate",
                "db_ValueName" => ":Type_updatedAtDate",
                "db_realValue" => date('Y-m-d')
            ],
            [
                "db_FieldName" => "storageType_updatedAtTime",
                "db_ValueName" => ":Type_updatedAtTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "storageType_isEnable",
                "db_ValueName" => ":Type_isEnable",
                "db_realValue" => 1
            ],
        ];

        $addObservations = $this->saveData("storage_types", $storageTypeRegisterData);
        if ($addObservations->rowCount() >= 1) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "Tipo de Artículo Registrado Exitosamente!",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "¡Tipo de Artículo no Registrado, intente nuevamente!",
            ];
        }
        return json_encode($alert);
    }

    public function storageTypesListController($page, $register, $url, $search)
    {

        $page = $this->cleanRequest($page);
        $register = $this->cleanRequest($register);

        $url = $this->cleanRequest($url);
        $url = APP_URL . $url . "/";

        $search = $this->cleanRequest($search);
        $table = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;
        $start = ($page > 0) ? (($page * $register) - $register) : 0;

        // Consulta para obtener los datos y el total de categorías por tipo
        $dataRequest_Query = "SELECT
        types.storageType_ID,
        types.storageType_name AS type_name,
        types.storageType_createdAtDate AS type_createdAtDate,
        types.storageType_createdAtTime AS type_createdAtTime,
        types.storageType_updatedAtDate AS type_updatedAtDate,
        types.storageType_updatedAtTime AS type_updatedAtTime,
        types.storageType_isEnable AS type_isEnable,
        COUNT(categories.storageCategory_ID) AS total_categories
        FROM storage_types types
        LEFT JOIN storage_categories categories ON types.storageType_ID = categories.storageCategory_type_ID
        WHERE types.storageType_ID LIKE '%$search%' 
        OR types.storageType_name LIKE '%$search%' 
        OR types.storageType_createdAtDate LIKE '%$search%' 
        OR types.storageType_createdAtTime LIKE '%$search%' 
        OR types.storageType_updatedAtDate LIKE '%$search%' 
        OR types.storageType_updatedAtTime LIKE '%$search%'
        OR types.storageType_isEnable LIKE '%$search%'
        GROUP BY 
        types.storageType_ID,
        types.storageType_name,
        types.storageType_createdAtDate,
        types.storageType_createdAtTime,
        types.storageType_updatedAtDate,
        types.storageType_updatedAtTime,
        types.storageType_isEnable
        ORDER BY types.storageType_name ASC
        LIMIT $start, $register;";

        // Consulta para contar el total de registros encontrados
        $totalData_Query = "SELECT COUNT(*) AS total
        FROM storage_types types
        WHERE types.storageType_ID LIKE '%$search%' 
        OR types.storageType_name LIKE '%$search%' 
        OR types.storageType_createdAtDate LIKE '%$search%' 
        OR types.storageType_createdAtTime LIKE '%$search%' 
        OR types.storageType_updatedAtDate LIKE '%$search%' 
        OR types.storageType_updatedAtTime LIKE '%$search%'
        OR types.storageType_isEnable LIKE '%$search%'";

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
                                            Nombre
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            Fecha de Actualización
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

                $storageTypeCreatedDateDots = $this->formatTimeDots($rows['type_createdAtTime']);
                $storageTypeUpdatedDateDots = $this->formatTimeDots($rows['type_updatedAtTime']);
                $table .= '
                    <tr class="bg-white border-b border-gray-200 text-gray-800 hover:bg-gray-200 transition duration-100">
                        <td class="px-5 py-2 text-xs text-gray-400">' . $counter . '</td>
                        <td scope="row" class="px-5 py-2 font-medium text-gray-900 whitespace-nowrap">
                            <p class="text-xs">
                                ' . $rows['type_name'] . '
                            </p>
                            <div class="flex items-center mt-1">
                                <span class="flex items-center bg-teal-100 text-teal-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-teal-800 hover:text-white transition duration-100">
                                    <svg class="shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#addCardFront" />
                                    </svg>
                                ' . $rows['total_categories'] . ' Categorías
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center whitespace-nowrap">
                                <span class="flex items-center bg-purple-200 text-purple-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-purple-900 hover:text-white transition duration-100">
                                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . 'app/assets/svg/FlowbiteIcons.sprite.svg#calendarPen" />
                                    </svg>
                                    ' . date('d/m/Y', strtotime($rows['type_updatedAtDate'])) . ', ' . $storageTypeUpdatedDateDots . '
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center">';
                if ($rows['type_isEnable'] == 1) {
                    $table .= '<div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                    <p class="font-semibold text-green-500">
                                        Habilitado
                                    </p>';
                } else {
                    $table .= '<div class="h-2.5 w-2.5 rounded-full bg-red-700 me-2"></div>
                                    <p class="font-semibold text-red-700">
                                        Deshabilitado
                                    </p>';
                }
                $table .= '
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center justify-end space-x-1">
                                <div class="flex items-center">
                                    <button data-modal-toggle="viewObservationInfo" data-modal-target="viewObservationInfo" 
                                    id="eye-btn-' . $rows['storageType_ID'] . '"
                                    data-popover-target="popover-eye-' . $rows['storageType_ID'] . '"
                                    data-popover-placement="bottom" class="flex items-center text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100" data-observation-id="' . $rows['storageType_ID'] . '">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . 'app/assets/svg/FlowbiteIcons.sprite.svg#eye" />
                                        </svg>
                                    </button>
                                <div data-popover id="popover-eye-' . $rows['storageType_ID'] . '" role="tooltip"
                                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                    <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                        <h3 class="font-semibold text-white text-xs">Ver</h3>
                                    </div>
                                        <div data-popper-arrow bg-gray-900></div>
                                </div>
                                </div>
                                <div class="flex items-center">
                                    <button data-modal-toggle="editStorageType" data-modal-target="editStorageType" id="editPen-btn-' . $rows['storageType_ID'] . '"
                                    data-popover-target="popover-editPen-' . $rows['storageType_ID'] . '"
                                    data-popover-placement="bottom" class="flex items-center text-yellow-400 border border-yellow-400 hover:bg-yellow-500 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100"
                                    data-storage-id="' . $rows['storageType_ID'] . '">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#editPen" />
                                        </svg>
                                    </button>
                                    <div data-popover id="popover-editPen-' . $rows['storageType_ID'] . '" role="tooltip"
                                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                    <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                        <h3 class="font-semibold text-white text-xs">Editar</h3>
                                    </div>
                                        <div data-popper-arrow bg-gray-900></div>
                                </div>
                                </div>
                                <div class="flex items-center">
                                <form action="' . APP_URL . 'app/ajax/storageAjax.php" class="AjaxForm" method="POST">
                                    <input type="hidden" name="storageModule" value="deleteStorageType">
                                    <input type="hidden" name="storageType_ID" value="' . $rows['storageType_ID'] . '">
                                    <button data-popover-target="popover-delete-' . $rows['storageType_ID'] . '"
                                    data-popover-placement="bottom" class="flex items-center text-red-800 border border-red-700 hover:bg-red-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#trashCan" />
                                        </svg>
                                    </button>
                                    <div data-popover id="popover-delete-' . $rows['storageType_ID'] . '" role="tooltip"
                                    class="absolute flex z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                        <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                            <h3 class="font-semibold text-white text-xs">Eliminar</h3>
                                        </div>
                                            <div data-popper-arrow bg-gray-900></div>
                                    </div>
                                </div>
                                </form>
                                <form action="' . APP_URL . 'app/ajax/storageAjax.php" class="AjaxForm" method="POST">
                                <input type="hidden" name="storageModule" value="updateStorageTypeStatus">
                                <input type="hidden" name="storageType_ID" value="' . $rows['storageType_ID'] . '">
                                    <div class="flex items-center">
                                        <button data-popover-target="popover-state-' . $rows['storageType_ID'] . '"
                                    data-popover-placement="bottom" type="submit" class="flex items-center text-green-700 border border-green-700 hover:bg-green-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                                <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#arrowRepeat" />
                                            </svg>
                                        </button>
                                    <div data-popover id="popover-state-' . $rows['storageType_ID'] . '" role="tooltip"
                                    class="absolute flex z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                        <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                            <h3 class="font-semibold text-white text-xs">Cambiar Estado</h3>
                                        </div>
                                            <div data-popper-arrow bg-gray-900></div>
                                    </div>
                                    </div>
                                </form>
                 </td>
                    </tr>';
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

    // STORAGE CATEGORIES CONTROLLER
    public function addStorageCategoryController()
    {
        $storageCategoryName = ucwords($this->cleanRequest($_POST['storageCategoryName']));
        $storageCategoryType = $this->cleanRequest($_POST['storageCategoryType']);

        if (empty($storageCategoryName) || empty($storageCategoryType)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "Algunos campos se encuentran Vacíos!",
            ];
            return json_encode($alert);
            exit();
        }

        $categoryExist = "SELECT * FROM storage_categories 
        WHERE storageCategory_name = '$storageCategoryName' AND storageCategory_type_ID = '$storageCategoryType'";
        $storageCategoryExist = $this->dbRequestExecute($categoryExist);
        $storageCategoryExist->execute();
        if ($storageCategoryExist->rowCount() >= 1) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡La Categoría ya se encuentra Registrada!",
            ];
            return json_encode($alert);
            exit();
        }

        $storageCategoryRegisterData = [
            [
                "db_FieldName" => "storageCategory_name",
                "db_ValueName" => ":category_name",
                "db_realValue" => $storageCategoryName
            ],
            [
                "db_FieldName" => "storageCategory_type_ID",
                "db_ValueName" => ":category_type_ID",
                "db_realValue" => $storageCategoryType
            ],
            [
                "db_FieldName" => "storageCategory_createdAtDate",
                "db_ValueName" => ":category_createdAtDate",
                "db_realValue" => date('Y-m-d')
            ],
            [
                "db_FieldName" => "storageCategory_createdAtTime",
                "db_ValueName" => ":category_createdAtTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "storageCategory_updatedAtDate",
                "db_ValueName" => ":category_updatedAtDate",
                "db_realValue" => date('Y-m-d')
            ],
            [
                "db_FieldName" => "storageCategory_updatedAtTime",
                "db_ValueName" => ":category_updatedAtTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "storageCategory_isEnable",
                "db_ValueName" => ":category_isEnable",
                "db_realValue" => 1
            ],
        ];

        $addStorageCategory = $this->saveData("storage_categories", $storageCategoryRegisterData);
        if ($addStorageCategory->rowCount() >= 1) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "Categoría Registrada Exitosamente!",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error al Registrar!",
                "text" => "No se pudo registrar la categoría, intente nuevamente.",
            ];
        }
        return json_encode($alert);
    }

    public function storageCategoryListController($page, $register, $url, $search)
    {

        $page = $this->cleanRequest($page);
        $register = $this->cleanRequest($register);

        $url = $this->cleanRequest($url);
        $url = APP_URL . $url . "/";

        $search = $this->cleanRequest($search);
        $table = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;
        $start = ($page > 0) ? (($page * $register) - $register) : 0;

        // Consulta para obtener los datos
        $dataRequest_Query = "SELECT * FROM storage_categories categories
        JOIN storage_types types ON types.storageType_ID = categories.storageCategory_type_ID
        WHERE storageCategory_ID LIKE '%$search%' 
        OR storageCategory_name LIKE '%$search%' 
        OR storageCategory_type_ID LIKE '%$search%' 
        OR storageCategory_createdAtDate LIKE '%$search%' 
        OR storageCategory_createdAtTime LIKE '%$search%' 
        OR storageCategory_updatedAtDate LIKE '%$search%' 
        OR storageCategory_updatedAtTime LIKE '%$search%'
        OR storageCategory_isEnable LIKE '%$search%'
        ORDER BY storageType_name ASC, storageCategory_name  ASC
        LIMIT $start, $register;";

        // Consulta para contar el total de registros encontrados
        $totalData_Query = "SELECT COUNT(*) AS total
        FROM storage_categories categories
        JOIN storage_types types ON types.storageType_ID = categories.storageCategory_type_ID
        WHERE storageCategory_ID LIKE '%$search%' 
        OR storageCategory_name LIKE '%$search%' 
        OR storageCategory_type_ID LIKE '%$search%' 
        OR storageCategory_createdAtDate LIKE '%$search%' 
        OR storageCategory_createdAtTime LIKE '%$search%' 
        OR storageCategory_updatedAtDate LIKE '%$search%' 
        OR storageCategory_updatedAtTime LIKE '%$search%'
        OR storageCategory_isEnable LIKE '%$search%'";

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
                                            Categoría
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            Fecha de Actualización
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

                $storageCategoryCreatedDateDots = $this->formatTimeDots($rows['storageCategory_createdAtTime']);
                $storageCategoryUpdatedDateDots = $this->formatTimeDots($rows['storageCategory_updatedAtTime']);
                $table .= '
                    <tr class="bg-white border-b border-gray-200 text-gray-800 hover:bg-gray-200 transition duration-100">
                        <td class="px-5 py-2 text-xs text-gray-400">' . $counter . '</td>
                        <td scope="row" class="px-5 py-2 font-medium text-gray-900 whitespace-nowrap">
                            <p class="text-xs">
                                ' . $rows['storageCategory_name'] . '
                            </p>
                            <div class="flex items-center mt-1">
                                <span class="flex items-center bg-teal-100 text-teal-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-teal-800 hover:text-white transition duration-100">
                                    <svg class="shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#addCardBack" />
                                    </svg>
                                ' . $rows['storageType_name'] . '
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center whitespace-nowrap">
                                <span class="flex items-center bg-purple-200 text-purple-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-purple-900 hover:text-white transition duration-100">
                                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . 'app/assets/svg/FlowbiteIcons.sprite.svg#calendarPen" />
                                    </svg>
                                    ' . date('d/m/Y', strtotime($rows['storageCategory_updatedAtDate'])) . ', ' . $storageCategoryUpdatedDateDots . '
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center">';
                if ($rows['storageCategory_isEnable'] == 1) {
                    $table .= '<div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                                    <p class="font-semibold text-green-500">
                                        Habilitado
                                    </p>';
                } else {
                    $table .= '<div class="h-2.5 w-2.5 rounded-full bg-red-700 me-2"></div>
                                    <p class="font-semibold text-red-700">
                                        Deshabilitado
                                    </p>';
                }
                $table .= '
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center justify-end space-x-1">
                                <div class="flex items-center">
                                    <button data-modal-toggle="viewObservationInfo" data-modal-target="viewObservationInfo" 
                                    id="eye-btn-' . $rows['storageCategory_ID'] . '"
                                    data-popover-target="popover-eye-' . $rows['storageCategory_ID'] . '"
                                    data-popover-placement="bottom" class="flex items-center text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100" data-observation-id="' . $rows['storageCategory_ID'] . '">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . 'app/assets/svg/FlowbiteIcons.sprite.svg#eye" />
                                        </svg>
                                    </button>
                                <div data-popover id="popover-eye-' . $rows['storageCategory_ID'] . '" role="tooltip"
                                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                    <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                        <h3 class="font-semibold text-white text-xs">Ver</h3>
                                    </div>
                                        <div data-popper-arrow bg-gray-900></div>
                                </div>
                                </div>
                                <div class="flex items-center">
                                    <button data-modal-toggle="editStorageType" data-modal-target="editStorageType" id="editPen-btn-' . $rows['storageCategory_ID'] . '"
                                    data-popover-target="popover-editPen-' . $rows['storageCategory_ID'] . '"
                                    data-popover-placement="bottom" class="flex items-center text-yellow-400 border border-yellow-400 hover:bg-yellow-500 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100"
                                    data-storage-id="' . $rows['storageCategory_ID'] . '">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#editPen" />
                                        </svg>
                                    </button>
                                    <div data-popover id="popover-editPen-' . $rows['storageCategory_ID'] . '" role="tooltip"
                                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                    <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                        <h3 class="font-semibold text-white text-xs">Editar</h3>
                                    </div>
                                        <div data-popper-arrow bg-gray-900></div>
                                </div>
                                </div>
                                <div class="flex items-center">
                                <form action="' . APP_URL . 'app/ajax/storageAjax.php" class="AjaxForm" method="POST">
                                    <input type="hidden" name="storageModule" value="deleteStorageType">
                                    <input type="hidden" name="storageType_ID" value="' . $rows['storageCategory_ID'] . '">
                                    <button data-popover-target="popover-delete-' . $rows['storageCategory_ID'] . '"
                                    data-popover-placement="bottom" class="flex items-center text-red-800 border border-red-700 hover:bg-red-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#trashCan" />
                                        </svg>
                                    </button>
                                    <div data-popover id="popover-delete-' . $rows['storageCategory_ID'] . '" role="tooltip"
                                    class="absolute flex z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                        <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                            <h3 class="font-semibold text-white text-xs">Eliminar</h3>
                                        </div>
                                            <div data-popper-arrow bg-gray-900></div>
                                    </div>
                                </div>
                                </form>
                                <form action="' . APP_URL . 'app/ajax/storageAjax.php" class="AjaxForm" method="POST">
                                <input type="hidden" name="storageModule" value="updateStorageTypeStatus">
                                <input type="hidden" name="storageType_ID" value="' . $rows['storageCategory_ID'] . '">
                                    <div class="flex items-center">
                                        <button data-popover-target="popover-state-' . $rows['storageCategory_ID'] . '"
                                    data-popover-placement="bottom" type="submit" class="flex items-center text-green-700 border border-green-700 hover:bg-green-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                                <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#arrowRepeat" />
                                            </svg>
                                        </button>
                                    <div data-popover id="popover-state-' . $rows['storageCategory_ID'] . '" role="tooltip"
                                    class="absolute flex z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                        <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                            <h3 class="font-semibold text-white text-xs">Cambiar Estado</h3>
                                        </div>
                                            <div data-popper-arrow bg-gray-900></div>
                                    </div>
                                    </div>
                                </form>
                 </td>
                    </tr>';
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

    // STORAGE STOCK CONTROLLER

    // STORAGE MOVEMENTS CONTROLLER

    // STORAGE HISTORY CONTROLLER
}
