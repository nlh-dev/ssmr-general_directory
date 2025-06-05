<?php

namespace app\controllers;

use app\models\mainModel;

class devicesController extends mainModel
{
    public function getDeliveredDeviceById()
    {
        $deviceId = $this->cleanRequest($_GET['device_ID']);
        $getDevices_SQL = "SELECT devices.*, locations.*, departments.*, 
        deliveryUser.user_fullName AS delivery_user_fullName, 
        withdrawUser.user_fullName AS withdraw_user_fullName FROM devices
        JOIN locations ON devices.device_location_ID = locations.location_ID
        JOIN departments ON devices.device_department_ID = departments.department_ID
        JOIN users AS deliveryUser ON devices.device_deliveryUser_ID = deliveryUser.user_ID
        LEFT JOIN users AS withdrawUser ON devices.device_withdrawUser_ID = withdrawUser.user_ID WHERE devices.device_ID = '$deviceId' LIMIT 1";

        $getDevicesByID_Query = $this->dbRequestExecute($getDevices_SQL);
        $getDevicesByID_Query->execute();
        return $getDevicesByID_Query->fetch();
    }

    public function saveDeliveredDevicesController()
    {
        $recievedByName = strtoupper($this->cleanRequest($_POST['recievedByName']));
        $deviceDescription = strtoupper($this->cleanRequest($_POST['deviceDescription']));
        $serialCode = strtoupper($this->cleanRequest($_POST['serialCode']));
        $deliveryDate = $this->cleanRequest($_POST['deliveryDate']);
        $locations = $this->cleanRequest($_POST['locations']);
        $departments = $this->cleanRequest($_POST['departments']);
        $roomCode = strtoupper($this->cleanRequest($_POST['roomCode']));

        if (empty($deviceDescription) || empty($serialCode) || empty($deliveryDate) || empty($locations) || empty($departments)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al entregar!",
                "text" => "¡Algunos campos se encuentran vacios!",
            ];
            return json_encode($alert);
            exit();
        }

        $checkControl = $this->dbRequestExecute("SELECT * 
        FROM devices 
        WHERE device_isDelivered = 1
        AND device_serialCode = '$serialCode'");

        if ($checkControl->rowCount() >= 1) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al entregar!",
                "text" => "¡Este dispositivo ya fue entregado!",
            ];
            return json_encode($alert);
            exit();
        }

        $deviceRegisterData = [
            [
                "db_FieldName" => "device_deliveryUser_ID",
                "db_ValueName" => ":deliveryUser_ID",
                "db_realValue" => 1 //REGISTRO ESTATICO PARA PRUEBA
            ],
            [
                "db_FieldName" => "device_recievedByName",
                "db_ValueName" => ":recievedByName",
                "db_realValue" => $recievedByName
            ],
            [
                "db_FieldName" => "device_description",
                "db_ValueName" => ":deviceDescription",
                "db_realValue" => $deviceDescription
            ],
            [
                "db_FieldName" => "device_serialCode",
                "db_ValueName" => ":serialCode",
                "db_realValue" => $serialCode
            ],
            [
                "db_FieldName" => "device_deliveryDate",
                "db_ValueName" => ":deliveryDate",
                "db_realValue" => $deliveryDate
            ],
            [
                "db_FieldName" => "device_deliveryTime",
                "db_ValueName" => ":deliveryTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "device_location_ID",
                "db_ValueName" => ":location_ID",
                "db_realValue" => $locations
            ],
            [
                "db_FieldName" => "device_department_ID",
                "db_ValueName" => ":department_ID",
                "db_realValue" => $departments
            ],
            [
                "db_FieldName" => "device_roomCode",
                "db_ValueName" => ":roomCode",
                "db_realValue" => $roomCode
            ],
            [
                "db_FieldName" => "device_withdrawUser_ID",
                "db_ValueName" => ":withdrawUser_ID",
                "db_realValue" => 1 //REGISTRO ESTATICO PARA PRUEBA
            ],
            [
                "db_FieldName" => "device_isDelivered",
                "db_ValueName" => ":isDelivered",
                "db_realValue" => true
            ],
        ];

        $addDevices = $this->saveData("devices", $deviceRegisterData);
        if ($addDevices->rowCount() >= 1) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "Dispositivo entregado y registrado exitosamente!",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "¡Dispositivo no registrador, intente nuevamente!",
            ];
        }
        return json_encode($alert);
    }

    public function updateDeliveredDeviceController()
    {
        $deviceID = $this->cleanRequest($_POST['device_ID']);
        $deviceData = $this->dbRequestExecute("SELECT * FROM devices WHERE device_ID = '$deviceID'");
        if ($deviceData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Dispositivo no encontrado",
            ];
            return json_encode($alert);
            exit();
        } else {
            $deviceData = $deviceData->fetch();
        }

        $recievedByName = strtoupper($this->cleanRequest($_POST['recievedByName']));
        $deviceDescription = strtoupper($this->cleanRequest($_POST['deviceDescription']));
        $serialCode = strtoupper($this->cleanRequest($_POST['serialCode']));
        $deliveryDate = $this->cleanRequest($_POST['deliveryDate']);
        $locations = $this->cleanRequest($_POST['locations']);
        $departments = $this->cleanRequest($_POST['departments']);
        $roomCode = strtoupper($this->cleanRequest($_POST['roomCode']));

        if (empty($deviceDescription) || empty($serialCode) || empty($deliveryDate) || empty($locations) || empty($departments)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al entregar!",
                "text" => "¡Algunos campos se encuentran vacios!",
            ];
            return json_encode($alert);
            exit();
        }

        $deviceDataUpdate = [
            [
                "db_FieldName" => "device_recievedByName",
                "db_ValueName" => ":recievedByName",
                "db_realValue" => $recievedByName
            ],
            [
                "db_FieldName" => "device_description",
                "db_ValueName" => ":deviceDescription",
                "db_realValue" => $deviceDescription
            ],
            [
                "db_FieldName" => "device_serialCode",
                "db_ValueName" => ":serialCode",
                "db_realValue" => $serialCode
            ],
            [
                "db_FieldName" => "device_deliveryDate",
                "db_ValueName" => ":deliveryDate",
                "db_realValue" => $deliveryDate
            ],
            [
                "db_FieldName" => "device_deliveryTime",
                "db_ValueName" => ":deliveryTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "device_location_ID",
                "db_ValueName" => ":location_ID",
                "db_realValue" => $locations
            ],
            [
                "db_FieldName" => "device_department_ID",
                "db_ValueName" => ":department_ID",
                "db_realValue" => $departments
            ],
            [
                "db_FieldName" => "device_roomCode",
                "db_ValueName" => ":roomCode",
                "db_realValue" => $roomCode
            ],
        ];

        $deviceCondition = [
            "condition_FieldName" => "device_ID",
            "condition_ValueName" => ":ID",
            "condition_realValue" => $deviceID
        ];

        if ($this->updateData("devices", $deviceDataUpdate, $deviceCondition)) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operacion Realizada!",
                "text" => "Dispisitvo Actualizado exitosamente",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Error al actualizar dispositivo, intente nuevamente",
            ];
        }
        return json_encode($alert);
    }

    public function withdrawDeviceController()
    {
        $deviceID = $this->cleanRequest($_POST['device_ID']);
        $deviceData = $this->dbRequestExecute("SELECT * FROM devices WHERE device_ID = '$deviceID'");
        if ($deviceData->rowCount() <= 0) {
            $alert = [
                "tipo" => "simple",
                "titulo" => "¡Error!",
                "texto" => "Dispositivo no encontrado",
                "icono" => "error"
            ];
            return json_encode($alert);
            exit();
        } else {
            $deviceData = $deviceData->fetch();
        }

        $withdrawalDate = $this->cleanRequest($_POST['withdrawalDate']);
        if (empty($withdrawalDate)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error!",
                "text" => "¡Fecha de Retiro no Establecida!",
            ];
            return json_encode($alert);
            exit();
        }

        $deviceDataUpdate = [
            [
                "db_FieldName" => "device_withdrawDate",
                "db_ValueName" => ":withdrawalDate",
                "db_realValue" => $withdrawalDate
            ],
            [
                "db_FieldName" => "device_withdrawTime",
                "db_ValueName" => ":withdrawTime",
                "db_realValue" => date('H:i:s')
            ],
            [
                "db_FieldName" => "device_withdrawUser_ID",
                "db_ValueName" => ":withdrawUser_ID",
                "db_realValue" => 2
            ],
            [
                "db_FieldName" => "device_isDelivered",
                "db_ValueName" => ":isDelivered",
                "db_realValue" => false
            ],
        ];

        $deviceCondition = [
            "condition_FieldName" => "device_ID",
            "condition_ValueName" => ":ID",
            "condition_realValue" => $deviceID
        ];

        if ($this->updateData("devices", $deviceDataUpdate, $deviceCondition)) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operacion Realizada!",
                "text" => "Dispisitvo retirado exitosamente",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Error al retirar dispositivo, intente nuevamente",
            ];
        }
        return json_encode($alert);
    }

    public function updateWithdrawDeviceController()
    {
        $deviceID = $this->cleanRequest($_POST['device_ID']);
        $deviceData = $this->dbRequestExecute("SELECT * FROM devices WHERE device_ID = '$deviceID'");
        if ($deviceData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Dispositivo no encontrado",
            ];
            return json_encode($alert);
            exit();
        } else {
            $deviceData = $deviceData->fetch();
        }

        $recievedByName = strtoupper($this->cleanRequest($_POST['recievedByName']));
        $deviceDescription = strtoupper($this->cleanRequest($_POST['deviceDescription']));
        $serialCode = strtoupper($this->cleanRequest($_POST['serialCode']));
        $withdrawDate = $this->cleanRequest($_POST['withdrawDate']);
        $locations = $this->cleanRequest($_POST['locations']);
        $departments = $this->cleanRequest($_POST['departments']);
        $roomCode = strtoupper($this->cleanRequest($_POST['roomCode']));

        if (empty($deviceDescription) || empty($serialCode) || empty($withdrawDate) || empty($locations) || empty($departments)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al entregar!",
                "text" => "¡Algunos campos se encuentran vacios!",
            ];
            return json_encode($alert);
            exit();
        }

        $deviceDataUpdate = [
            [
                "db_FieldName" => "device_recievedByName",
                "db_ValueName" => ":recievedByName",
                "db_realValue" => $recievedByName
            ],
            [
                "db_FieldName" => "device_description",
                "db_ValueName" => ":deviceDescription",
                "db_realValue" => $deviceDescription
            ],
            [
                "db_FieldName" => "device_serialCode",
                "db_ValueName" => ":serialCode",
                "db_realValue" => $serialCode
            ],
            [
                "db_FieldName" => "device_withdrawDate",
                "db_ValueName" => ":withdrawDate",
                "db_realValue" => $withdrawDate
            ],
            [
                "db_FieldName" => "device_location_ID",
                "db_ValueName" => ":location_ID",
                "db_realValue" => $locations
            ],
            [
                "db_FieldName" => "device_department_ID",
                "db_ValueName" => ":department_ID",
                "db_realValue" => $departments
            ],
            [
                "db_FieldName" => "device_roomCode",
                "db_ValueName" => ":roomCode",
                "db_realValue" => $roomCode
            ],
        ];

        $deviceCondition = [
            "condition_FieldName" => "device_ID",
            "condition_ValueName" => ":ID",
            "condition_realValue" => $deviceID
        ];

        if ($this->updateData("devices", $deviceDataUpdate, $deviceCondition)) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operacion Realizada!",
                "text" => "Dispositivo Actualizado exitosamente",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Error al actualizar dispositivo, intente nuevamente",
            ];
        }
        return json_encode($alert);
    }

    public function deleteDeliveredDeviceController()
    {
        $deviceID = $this->cleanRequest($_POST['device_ID']);

        $deviceData = $this->dbRequestExecute("SELECT device_ID FROM devices WHERE device_ID = '$deviceID'");
        if ($deviceData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Wifi no encontrado!",
            ];
            return json_encode($alert);
            exit();
        }

        if ($this->deleteData("devices", "device_ID", $deviceID)) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "Dispositivo eliminado exitosamente.",
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

    public function deliveredDevicesListController($page, $register, $url, $search)
    {

        $page = $this->cleanRequest($page);
        $register = $this->cleanRequest($register);

        $url = $this->cleanRequest($url);
        $url = APP_URL . $url . "/";

        $search = $this->cleanRequest($search);
        $table = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;
        $start = ($page > 0) ? (($page * $register) - $register) : 0;

        $dataRequest_Query = "SELECT * FROM devices
        JOIN locations ON devices.device_location_ID = locations.location_ID 
        JOIN departments ON devices.device_department_ID = departments.department_ID
        JOIN users ON devices.device_deliveryUser_ID = users.user_ID
        WHERE (device_deliveryUser_ID LIKE '%$search%' 
        OR device_recievedByName LIKE '%$search%' 
        OR device_description LIKE '%$search%' 
        OR device_serialCode LIKE '%$search%' 
        OR device_deliveryDate LIKE '%$search%' 
        OR device_deliveryTime LIKE '%$search%'
        OR device_location_ID LIKE '%$search%'
        OR device_department_ID LIKE '%$search%')
        AND device_isDelivered = 1
        ORDER BY device_deliveryDate DESC, device_deliveryTime DESC
        LIMIT $start,$register";

        $totalData_Query = "SELECT COUNT(device_ID) FROM devices 
        JOIN locations ON devices.device_location_ID = locations.location_ID 
        JOIN departments ON devices.device_department_ID = departments.department_ID
        WHERE (device_deliveryUser_ID LIKE '%$search%' 
        OR device_recievedByName LIKE '%$search%' 
        OR device_description LIKE '%$search%' 
        OR device_serialCode LIKE '%$search%' 
        OR device_deliveryDate LIKE '%$search%' 
        OR device_deliveryTime LIKE '%$search%'
        OR device_location_ID LIKE '%$search%'
        OR device_department_ID LIKE '%$search%')
        AND device_isDelivered = 1";

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
                                            Dispositivo
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            Fecha de Entrega
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            Ubicación
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            Departamento
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
                $table .= '
                    <tr class="bg-white border-b border-gray-200 text-gray-800 hover:bg-gray-200 transition duration-100">
                        <td class="px-5 py-2 whitespace-nowrap text-xs text-gray-400">' . $counter . '</td>
                        <td scope="row" class="px-5 py-2 font-medium text-gray-900 whitespace-nowrap">
                            <p class="text-xs">
                                ' . $rows['device_description'] . '
                            </p>
                            <div class="flex items-center mt-1 whitespace-nowrap">
                                <span class="flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-gray-900 hover:text-white transition duration-100">
                                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . 'app/assets/svg/FlowbiteIcons.sprite.svg#qrCode" />
                                    </svg>
                                    ' . $rows['device_serialCode'] . '
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center mt-1 whitespace-nowrap">
                                <span class="flex items-center bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-blue-900 hover:text-white transition duration-100">
                                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . 'app/assets/svg/FlowbiteIcons.sprite.svg#calendarPen" />
                                    </svg>
                                    ' . date('d/m/Y', strtotime($rows['device_deliveryDate'])) . ' - ' . date('h:i A', strtotime($rows['device_deliveryTime'])) . '
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="flex items-center bg-green-100 text-green-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-green-900 hover:text-white transition duration-100">
                                    <svg class="shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                                    </svg>
                                    ' . $rows['location_name'] . '
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="flex items-center bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-purple-800 hover:text-white transition duration-100">
                                    <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#departments" />
                                    </svg>
                                    ' . $rows['department_name'] . '
                                </span>
                            </div>
                        </td>
                        <td class="items-center px-5 py-2 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end space-x-1">
                                <div class="flex items-center">
                                    <button data-modal-target="viewDeviceInfo" data-modal-toggle="viewDeviceInfo" class="view-device-btn flex items-center text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100" data-device-id="' . $rows['device_ID'] . '">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . 'app/assets/svg/FlowbiteIcons.sprite.svg#eye" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex items-center">
                                    <button data-modal-target="editDeliveredDevices" data-modal-toggle="editDeliveredDevices" class="flex items-center text-yellow-400 border border-yellow-400 hover:bg-yellow-500 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100" data-device-id="' . $rows['device_ID'] . '">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#editPen" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex items-center">
                                <form action="' . APP_URL . 'app/ajax/deliveryDevicesAjax.php" class="AjaxForm" method="POST">
                                    <input type="hidden" name="deviceModule" value="deleteDeliveredDevice">
                                    <input type="hidden" name="device_ID" value="' . $rows['device_ID'] . '">
                                    <button class="flex items-center text-red-800 border border-red-700 hover:bg-red-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#trashCan" />
                                        </svg>
                                    </button>
                                    </form>
                                </div>
                                    <div class="flex items-center">
                                        <button data-modal-target="withdrawDevice" data-modal-toggle="withdrawDevice" class="flex items-center text-green-700 border border-green-700 hover:bg-green-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100" data-device-id="' . $rows['device_ID'] . '">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                                <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#archiveArrow" />
                                            </svg>
                                        </button>
                                    </div>
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
                        <td colspan="6">
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
                        <td colspan="6">
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

    public function withdrewDevicesListController($page, $register, $url, $search)
    {

        $page = $this->cleanRequest($page);
        $register = $this->cleanRequest($register);

        $url = $this->cleanRequest($url);
        $url = APP_URL . $url . "/";

        $search = $this->cleanRequest($search);
        $table = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;
        $start = ($page > 0) ? (($page * $register) - $register) : 0;

        $dataRequest_Query = "SELECT * FROM devices
        JOIN locations ON devices.device_location_ID = locations.location_ID 
        JOIN departments ON devices.device_department_ID = departments.department_ID
        JOIN users ON devices.device_deliveryUser_ID = users.user_ID
        WHERE (device_deliveryUser_ID LIKE '%$search%' 
        OR device_recievedByName LIKE '%$search%' 
        OR device_description LIKE '%$search%' 
        OR device_serialCode LIKE '%$search%' 
        OR device_deliveryDate LIKE '%$search%' 
        OR device_deliveryTime LIKE '%$search%'
        OR device_location_ID LIKE '%$search%'
        OR device_department_ID LIKE '%$search%'
        OR device_roomCode LIKE '%$search%'
        OR device_withdrawDate LIKE '%$search%'
        OR device_withdrawTime LIKE '%$search%'
        OR device_withdrawUser_ID LIKE '%$search%')
        AND device_isDelivered = 0
        ORDER BY device_withdrawDate DESC
        LIMIT $start,$register";

        $totalData_Query = "SELECT COUNT(device_ID) FROM devices 
        JOIN locations ON devices.device_location_ID = locations.location_ID 
        JOIN departments ON devices.device_department_ID = departments.department_ID
        WHERE (device_deliveryUser_ID LIKE '%$search%' 
        OR device_recievedByName LIKE '%$search%' 
        OR device_description LIKE '%$search%' 
        OR device_serialCode LIKE '%$search%' 
        OR device_deliveryDate LIKE '%$search%' 
        OR device_deliveryTime LIKE '%$search%'
        OR device_location_ID LIKE '%$search%'
        OR device_department_ID LIKE '%$search%'
        OR device_roomCode LIKE '%$search%'
        OR device_withdrawDate LIKE '%$search%'
        OR device_withdrawTime LIKE '%$search%'
        OR device_withdrawUser_ID LIKE '%$search%')
        AND device_isDelivered = 0";

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
                                            Dispositivo
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            Fecha de Retiro
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            Ubicación
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            Departamento
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
                $table .= '
                    <tr class="bg-white border-b border-gray-200 text-gray-800 hover:bg-gray-200 transition duration-100">
                        <td class="px-5 py-2 whitespace-nowrap text-xs text-gray-400">' . $counter . '</td>
                        <td scope="row" class="px-5 py-2 font-medium text-gray-900 whitespace-nowrap">
                            <p class="text-xs">
                                ' . $rows['device_description'] . '
                            </p>
                            <div class="flex items-center mt-1 whitespace-nowrap">
                                <span class="flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-gray-900 hover:text-white transition duration-100">
                                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . 'app/assets/svg/FlowbiteIcons.sprite.svg#qrCode" />
                                    </svg>
                                    ' . $rows['device_serialCode'] . '
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center mt-1 whitespace-nowrap">
                                <span class="flex items-center bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-blue-900 hover:text-white transition duration-100">
                                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . 'app/assets/svg/FlowbiteIcons.sprite.svg#calendarPen" />
                                    </svg>
                                    ' . date('d/m/Y', strtotime($rows['device_withdrawDate'])) . ' - ' . date('h:i A', strtotime($rows['device_withdrawTime'])) . '
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="flex items-center bg-green-100 text-green-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-green-900 hover:text-white transition duration-100">
                                    <svg class="shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                                    </svg>
                                    ' . $rows['location_name'] . '
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="flex items-center bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-purple-800 hover:text-white transition duration-100">
                                    <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#departments" />
                                    </svg>
                                    ' . $rows['department_name'] . '
                                </span>
                            </div>
                        </td>
                        <td class="items-center px-5 py-2 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end space-x-1">
                                <div class="flex items-center">
                                    <button data-modal-target="viewWithdrewDeviceInfo" data-modal-toggle="viewWithdrewDeviceInfo" class="view-device-btn flex items-center text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100" data-device-id="' . $rows['device_ID'] . '">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . 'app/assets/svg/FlowbiteIcons.sprite.svg#eye" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex items-center">
                                    <button data-modal-target="editWithdrewDevices" data-modal-toggle="editWithdrewDevices" class="flex items-center text-yellow-400 border border-yellow-400 hover:bg-yellow-500 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100" data-device-id="' . $rows['device_ID'] . '">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#editPen" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex items-center">
                                <form action="' . APP_URL . 'app/ajax/deliveryDevicesAjax.php" class="AjaxForm" method="POST">
                                    <input type="hidden" name="deviceModule" value="deleteDeliveredDevice">
                                    <input type="hidden" name="device_ID" value="' . $rows['device_ID'] . '">
                                    <button class="flex items-center text-red-800 border border-red-700 hover:bg-red-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#trashCan" />
                                        </svg>
                                    </button>
                                    </form>
                                </div>
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
