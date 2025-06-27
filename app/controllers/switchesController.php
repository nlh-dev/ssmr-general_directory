<?php

namespace app\controllers;

use app\models\mainModel;

class switchesController extends mainModel
{

    // SWITCH BRANDS CONTROLLER FUNCTIONS
    public function addSwitchBrandController()
    {
        $brandName = ucwords($this->cleanRequest($_POST['brandName']));

        if (empty($brandName)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "El campo se encuentra vacío.",
            ];
            return json_encode($alert);
            exit();
        }

        $checkBrandName = $this->dbRequestExecute("SELECT * FROM switch_brand_directory WHERE switchBrand_name = '$brandName'");
        if ($checkBrandName->rowCount() > 0) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "La marca ya " . $brandName . " se encuentra registrada.",
            ];
            return json_encode($alert);
            exit();
        }

        $brandRegisterData = [
            [
                "db_FieldName" => "switchBrand_name",
                "db_ValueName" => ":brand_name",
                "db_realValue" => $brandName
            ],
            [
                "db_FieldName" => "switchBrand_createdAtDate",
                "db_ValueName" => ":brand_createdAtDate",
                "db_realValue" => date('Y-m-d')
            ],
            [
                "db_FieldName" => "switchBrand_createdAtTime",
                "db_ValueName" => ":brand_createdAtTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "switchBrand_updatedAtDate",
                "db_ValueName" => ":brand_updatedAtDate",
                "db_realValue" => date('Y-m-d')
            ],
            [
                "db_FieldName" => "switchBrand_updatedAtTime",
                "db_ValueName" => ":brand_updatedAtTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "switchBrand_isEnable",
                "db_ValueName" => ":brand_isEnable",
                "db_realValue" => 1
            ],
        ];

        $addSwitchBrand = $this->saveData("switch_brand_directory", $brandRegisterData);
        if ($addSwitchBrand->rowCount() >= 1) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Registro Exitoso!",
                "text" => "La marca " . $brandName . " ha sido registrada exitosamente.",
            ];
            return json_encode($alert);
        }
    }

    public function deleteSwitchBrandController(){
        $brandId = $this->cleanRequest($_POST['brand_ID']);

        if (empty($brandId)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Eliminar!",
                "text" => "El ID de la marca no es válido.",
            ];
            return json_encode($alert);
            exit();
        }

        $checkBrand = $this->dbRequestExecute("SELECT * FROM switch_brand_directory WHERE switchBrand_ID = '$brandId'");
        if ($checkBrand->rowCount() === 0) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Eliminar!",
                "text" => "La marca no existe en el registro.",
            ];
            return json_encode($alert);
            exit();
        }

        $deleteBrand = $this->dbRequestExecute("DELETE FROM switch_brand_directory WHERE switchBrand_ID = '$brandId'");
        if ($deleteBrand->rowCount() >= 1) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Eliminación Exitosa!",
                "text" => "La marca ha sido eliminada exitosamente.",
            ];
            return json_encode($alert);
        }
    }

    public function switchBrandListController($page, $register, $url, $search)
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
        brand.switchBrand_ID as brand_ID,
        brand.switchBrand_name AS brand_name,
        brand.switchBrand_createdAtDate AS brand_createdAtDate,
        brand.switchBrand_createdAtTime AS brand_createdAtTime,
        brand.switchBrand_updatedAtDate AS brand_updatedAtDate,
        brand.switchBrand_updatedAtTime AS brand_updatedAtTime,
        brand.switchBrand_isEnable AS brand_isEnable,
        COUNT(switch.switch_ID) AS total_switches
        FROM switch_brand_directory brand
        LEFT JOIN switch_directory switch ON brand.switchBrand_ID = switch.switch_brand_ID
        WHERE brand.switchBrand_ID LIKE '%$search%' 
        OR brand.switchBrand_name LIKE '%$search%' 
        OR brand.switchBrand_createdAtDate LIKE '%$search%' 
        OR brand.switchBrand_createdAtTime LIKE '%$search%' 
        OR brand.switchBrand_updatedAtDate LIKE '%$search%' 
        OR brand.switchBrand_updatedAtTime LIKE '%$search%'
        OR brand.switchBrand_isEnable LIKE '%$search%'
        GROUP BY 
        brand.switchBrand_ID,
        brand.switchBrand_name,
        brand.switchBrand_createdAtDate,
        brand.switchBrand_createdAtTime,
        brand.switchBrand_updatedAtDate,
        brand.switchBrand_updatedAtTime,
        brand.switchBrand_isEnable
        ORDER BY brand.switchBrand_name ASC
        LIMIT $start, $register;";

        // Consulta para contar el total de registros encontrados
        $totalData_Query = "SELECT COUNT(*) AS total
        FROM switch_brand_directory brand
        WHERE brand.switchBrand_ID LIKE '%$search%' 
        OR brand.switchBrand_name LIKE '%$search%' 
        OR brand.switchBrand_createdAtDate LIKE '%$search%' 
        OR brand.switchBrand_createdAtTime LIKE '%$search%' 
        OR brand.switchBrand_updatedAtDate LIKE '%$search%' 
        OR brand.switchBrand_updatedAtTime LIKE '%$search%'
        OR brand.switchBrand_isEnable LIKE '%$search%'";

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
                                            Nombre de Marca
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            Fecha de Creación
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

                $switchBrandCreatedDateDots = $this->formatTimeDots($rows['brand_createdAtTime']);
                $switchBrandUpdatedDateDots = $this->formatTimeDots($rows['brand_updatedAtTime']);
                $table .= '
                    <tr class="bg-white border-b border-gray-200 text-gray-800 hover:bg-gray-200 transition duration-100">
                        <td class="px-5 py-2 text-xs text-gray-400">' . $counter . '</td>
                        <td scope="row" class="px-5 py-2 font-medium text-gray-900 whitespace-nowrap">
                            <p class="text-xs">
                                ' . $rows['brand_name'] . '
                            </p>
                            <div class="flex items-center mt-1">
                                <span class="flex items-center bg-teal-100 text-teal-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-teal-800 hover:text-white transition duration-100">
                                    <svg class="shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#codeFork" />
                                    </svg>
                                    ' . $rows['total_switches'] . ' Switch(es)
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center whitespace-nowrap">
                                <span class="flex items-center bg-blue-200 text-blue-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-blue-900 hover:text-white transition duration-100">
                                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . 'app/assets/svg/FlowbiteIcons.sprite.svg#calendarPen" />
                                    </svg>
                                    ' . date('d/m/Y', strtotime($rows['brand_createdAtDate'])) . ', ' . $switchBrandCreatedDateDots . '
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center whitespace-nowrap">
                                <span class="flex items-center bg-purple-200 text-purple-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-purple-900 hover:text-white transition duration-100">
                                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . 'app/assets/svg/FlowbiteIcons.sprite.svg#calendarPen" />
                                    </svg>
                                    ' . date('d/m/Y', strtotime($rows['brand_updatedAtDate'])) . ', ' . $switchBrandUpdatedDateDots . '
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center">';
                if ($rows['brand_isEnable'] == 1) {
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
                                    <button data-modal-toggle="viewSwitchBrandInfo" data-modal-target="viewSwitchBrandInfo" 
                                    id="eye-btn-' . $rows['brand_ID'] . '"
                                    data-popover-target="popover-eye-' . $rows['brand_ID'] . '"
                                    data-popover-placement="bottom" class="flex items-center text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100" data-observation-id="' . $rows['brand_ID'] . '">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . 'app/assets/svg/FlowbiteIcons.sprite.svg#eye" />
                                        </svg>
                                    </button>
                                <div data-popover id="popover-eye-' . $rows['brand_ID'] . '" role="tooltip"
                                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                    <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                        <h3 class="font-semibold text-white text-xs">Ver</h3>
                                    </div>
                                        <div data-popper-arrow bg-gray-900></div>
                                </div>
                                </div>
                                <div class="flex items-center">
                                    <button data-modal-toggle="editSwitchBrand" data-modal-target="editSwitchBrand" id="editPen-btn-' . $rows['brand_ID'] . '"
                                    data-popover-target="popover-editPen-' . $rows['brand_ID'] . '"
                                    data-popover-placement="bottom" class="flex items-center text-yellow-400 border border-yellow-400 hover:bg-yellow-500 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100"
                                    data-brand-id="' . $rows['brand_ID'] . '">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#editPen" />
                                        </svg>
                                    </button>
                                    <div data-popover id="popover-editPen-' . $rows['brand_ID'] . '" role="tooltip"
                                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                    <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                        <h3 class="font-semibold text-white text-xs">Editar</h3>
                                    </div>
                                        <div data-popper-arrow bg-gray-900></div>
                                </div>
                                </div>
                                <div class="flex items-center">
                                <form action="' . APP_URL . 'app/ajax/switchesAjax.php" class="AjaxForm" method="POST">
                                    <input type="hidden" name="switchModule" value="deleteSwitchBrand">
                                    <input type="hidden" name="brand_ID" value="' . $rows['brand_ID'] . '">
                                    <button data-popover-target="popover-delete-' . $rows['brand_ID'] . '"
                                    data-popover-placement="bottom" class="flex items-center text-red-800 border border-red-700 hover:bg-red-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#trashCan" />
                                        </svg>
                                    </button>
                                    <div data-popover id="popover-delete-' . $rows['brand_ID'] . '" role="tooltip"
                                    class="absolute flex z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                        <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                            <h3 class="font-semibold text-white text-xs">Eliminar</h3>
                                        </div>
                                            <div data-popper-arrow bg-gray-900></div>
                                    </div>
                                </div>
                                </form>
                                <form action="' . APP_URL . 'app/ajax/switchesAjax.php" class="AjaxForm" method="POST">
                                <input type="hidden" name="switchModule" value="updateSwitchBrandStatus">
                                <input type="hidden" name="brand_ID" value="' . $rows['brand_ID'] . '">
                                    <div class="flex items-center">
                                        <button data-popover-target="popover-state-' . $rows['brand_ID'] . '"
                                    data-popover-placement="bottom" type="submit" class="flex items-center text-green-700 border border-green-700 hover:bg-green-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                                <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#arrowRepeat" />
                                            </svg>
                                        </button>
                                    <div data-popover id="popover-state-' . $rows['brand_ID'] . '" role="tooltip"
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
}
