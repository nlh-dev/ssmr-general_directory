<?php

namespace app\controllers;

use app\models\mainModel;

class wifiController extends mainModel
{

    public function saveWifiPasswordController()
    {
        $SSID = strtoupper($this->cleanRequest($_POST['SSID']));
        $locations = $this->cleanRequest($_POST['locations']);
        $departments = $this->cleanRequest($_POST['departments']);
        $wifiPassword = $this->cleanRequest($_POST['wifiPassword']);
        $ipDirection = $this->cleanRequest($_POST['ipDirection']);

        if (empty($SSID) || empty($locations) || empty($departments)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡Algunos campos se encuentran vacios!",
            ];
            return json_encode($alert);
            exit();
        }

        $checkSSID = $this->dbRequestExecute("SELECT wifi_SSID 
        FROM wifi_directory
        WHERE wifi_SSID = '$SSID'");
        if ($checkSSID->rowCount() >= 1) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡Este SSID ya fue Registrado!",
            ];
            return json_encode($alert);
            exit();
        }

        $checkIP = $this->dbRequestExecute("SELECT wifi_ipDirection 
        FROM wifi_directory
        WHERE wifi_ipDirection = '$ipDirection' AND wifi_ipDirection != ''");
        if ($checkIP->rowCount() >= 1) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡La Dirección IP " . $ipDirection . " ya fue Registrada!",
            ];
            return json_encode($alert);
            exit();
        }


        $wifiRegisterData = [
            [
                "db_FieldName" => "wifi_SSID",
                "db_ValueName" => ":SSID",
                "db_realValue" => $SSID
            ],
            [
                "db_FieldName" => "wifi_password",
                "db_ValueName" => ":password",
                "db_realValue" => $wifiPassword
            ],
            [
                "db_FieldName" => "wifi_ipDirection",
                "db_ValueName" => ":ipDirection",
                "db_realValue" => $ipDirection
            ],
            [
                "db_FieldName" => "wifi_location_ID",
                "db_ValueName" => ":locationID",
                "db_realValue" => $locations
            ],
            [
                "db_FieldName" => "wifi_department_ID",
                "db_ValueName" => ":departmentID",
                "db_realValue" => $departments
            ],
            [
                "db_FieldName" => "wifi_createdAt",
                "db_ValueName" => ":createdAt",
                "db_realValue" => date('Y-m-d H:i:s')
            ],
            [
                "db_FieldName" => "wifi_updatedAt",
                "db_ValueName" => ":updatedAt",
                "db_realValue" => date('Y-m-d H:i:s')
            ],
            [
                "db_FieldName" => "wifi_isEnable",
                "db_ValueName" => ":isEnable",
                "db_realValue" => 1
            ],

        ];

        $addWidfiPassword = $this->saveData("wifi_directory", $wifiRegisterData);
        if ($addWidfiPassword->rowCount() >= 1) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "¡Contraseña de " . $SSID . " registrada exitosamente!",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "¡Contraseña no registrada, intente nuevamente!",
            ];
        }
        return json_encode($alert);
    }

    public function updateWifiStateController()
    {
        $wifiID = $this->cleanRequest($_POST['wifi_ID']);

        $wifiData = $this->dbRequestExecute("SELECT wifi_isEnable FROM wifi_directory WHERE wifi_ID = '$wifiID'");
        if ($wifiData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Wifi no encontrado!",
            ];
            return json_encode($alert);
            exit();
        }

        $wifiCurrentState = $wifiData->fetch()['wifi_isEnable'];
        $wifiNewState = $wifiCurrentState ? 0 : 1;

        $wifiStateData = [
            [
                "db_FieldName" => "wifi_isEnable",
                "db_ValueName" => ":isEnable",
                "db_realValue" => $wifiNewState
            ],
            [
                "db_FieldName" => "wifi_updatedAt",
                "db_ValueName" => ":updatedAt",
                "db_realValue" => date('Y-m-d H:i:s')
            ]
        ];

        $wifiCondition = [
            "condition_FieldName" => "wifi_ID",
            "condition_ValueName" => ":ID",
            "condition_realValue" => $wifiID
        ];

        if ($this->updateData("wifi_directory", $wifiStateData, $wifiCondition)) {
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

    public function addIpDirectionController()
    {
        $wifiID = $this->cleanRequest($_POST['wifi_ID']);
        $ipDirection = $this->cleanRequest($_POST['ipDirection']);

        // Validar que el registro exista
        $wifiData = $this->dbRequestExecute("SELECT wifi_ID, wifi_ipDirection FROM wifi_directory WHERE wifi_ID = '$wifiID'");
        if ($wifiData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Registro no encontrado.",
            ];
            return json_encode($alert);
            exit();
        }

        if (!empty($ipDirection)) {
            $ipCheck = $this->dbRequestExecute("SELECT wifi_ID FROM wifi_directory WHERE wifi_ipDirection = '$ipDirection' AND wifi_ID != '$wifiID'");
            if ($ipCheck->rowCount() >= 1) {
                $alert = [
                    "type" => "simple",
                    "icon" => "warning",
                    "title" => "¡Error!",
                    "text" => "La dirección ya está asignada a otro registro.",
                ];
                return json_encode($alert);
                exit();
            }
        }

        $rowWifi = $wifiData->fetch();
        $previousIPDirection = $rowWifi['wifi_ipDirection'];

        // Actualizar la IP
        $ipData = [
            [
                "db_FieldName" => "wifi_ipDirection",
                "db_ValueName" => ":ipDirection",
                "db_realValue" => $ipDirection
            ],
            [
                "db_FieldName" => "wifi_updatedAt",
                "db_ValueName" => ":updatedAt",
                "db_realValue" => date('Y-m-d H:i:s')
            ]
        ];

        $ipCondition = [
            "condition_FieldName" => "wifi_ID",
            "condition_ValueName" => ":ID",
            "condition_realValue" => $wifiID
        ];

        if ($this->updateData("wifi_directory", $ipData, $ipCondition)) {
            if (empty($previousIPDirection)) {
                $alert = [
                    "type" => "reload",
                    "icon" => "success",
                    "title" => "¡Operación Realizada!",
                    "text" => "Dirección Añadida exitosamente.",
                ];
            } else {
                $alert = [
                    "type" => "reload",
                    "icon" => "success",
                    "title" => "¡Operación Realizada!",
                    "text" => "Dirección Actualizada exitosamente.",
                ];
            }
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "No se pudo añadir la dirección IP, intente nuevamente",
            ];
        }
        return json_encode($alert);
    }

    public function showWifiPasswordController()
    {
        $wifiID = $this->cleanRequest($_POST['wifi_ID']);

        $wifiData = $this->dbRequestExecute("SELECT * FROM wifi_directory WHERE wifi_ID = '$wifiID'");
        if ($wifiData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Wifi no encontrado!",
            ];
            return json_encode($alert);
            exit();
        }

        $rowWifi = $wifiData->fetch();
        $wifiSSID = $rowWifi['wifi_SSID'];
        $wifiPassword = $rowWifi['wifi_password'];

        if (empty($wifiPassword)) {
            $alert = [
                "type" => "simple",
                "title" => "Wifi Libre",
                "text" => "Este Wifi es Libre, no posee contraseña.",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "title" => "Contraseña de $wifiSSID",
                "text" => "La contraseña es: $wifiPassword",
            ];
        }
        return json_encode($alert);
    }

    public function deleteWifiPasswordController()
    {
        $wifiID = $this->cleanRequest($_POST['wifi_ID']);

        $wifiData = $this->dbRequestExecute("SELECT wifi_ID FROM wifi_directory WHERE wifi_ID = '$wifiID'");
        if ($wifiData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Wifi no encontrado!",
            ];
            return json_encode($alert);
            exit();
        }

        if ($this->deleteData("wifi_directory", "wifi_ID", $wifiID)) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "Wifi eliminado exitosamente.",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "No se pudo eliminar el Wifi.",
            ];
        }
        return json_encode($alert);
    }

    public function getWifiDataController()
    {
        $wifiID = $this->cleanRequest($_GET['wifi_ID']);
        $wifiData = $this->dbRequestExecute("SELECT * FROM wifi_directory WHERE wifi_ID = '$wifiID'");
        if ($wifiData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Wifi no encontrado!",
            ];
            return json_encode($alert);
            exit();
        }
        $row = $wifiData->fetch(\PDO::FETCH_ASSOC);
        echo json_encode(['success' => true, 'data' => $row]);
        exit();
    }

    public function updateWifiController()
    {
        $wifiID = $this->cleanRequest($_POST['wifi_ID']);

        $wifiData = $this->dbRequestExecute("SELECT wifi_ID FROM wifi_directory WHERE wifi_ID = '$wifiID'");
        if ($wifiData->rowCount() <= 0) {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "Wifi no encontrado!",
            ];
            return json_encode($alert);
            exit();
        }

        $SSID = strtoupper($this->cleanRequest($_POST['SSID']));
        $locations = $this->cleanRequest($_POST['locations']);
        $departments = $this->cleanRequest($_POST['departments']);
        $wifiPassword = $this->cleanRequest($_POST['wifiPassword']);
        $ipDirection = $this->cleanRequest($_POST['ipDirection']);

        if (empty($SSID) || empty($locations) || empty($departments)) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡Algunos campos se encuentran vacios!",
            ];
            return json_encode($alert);
            exit();
        }

        $checkSSID = $this->dbRequestExecute("SELECT wifi_SSID 
        FROM wifi_directory WHERE wifi_SSID = '$SSID' AND wifi_ID != '$wifiID'");
        if ($checkSSID->rowCount() >= 1) {
            $alert = [
                "type" => "simple",
                "icon" => "warning",
                "title" => "¡Error al Registrar!",
                "text" => "¡Este SSID ya fue Registrado!",
            ];
            return json_encode($alert);
            exit();
        }

        if (!empty($ipDirection)) {
            $ipCheck = $this->dbRequestExecute("SELECT wifi_ID FROM wifi_directory WHERE wifi_ipDirection = '$ipDirection' AND wifi_ID != '$wifiID'");
            if ($ipCheck->rowCount() >= 1) {
                $alert = [
                    "type" => "simple",
                    "icon" => "warning",
                    "title" => "¡Error!",
                    "text" => "¡La dirección ya está asignada a otro registro!",
                ];
                return json_encode($alert);
                exit();
            }
        }

        $wifiUpdateData = [
            [
                "db_FieldName" => "wifi_SSID",
                "db_ValueName" => ":SSID",
                "db_realValue" => $SSID
            ],
            [
                "db_FieldName" => "wifi_password",
                "db_ValueName" => ":password",
                "db_realValue" => $wifiPassword
            ],
            [
                "db_FieldName" => "wifi_ipDirection",
                "db_ValueName" => ":ipDirection",
                "db_realValue" => $ipDirection
            ],
            [
                "db_FieldName" => "wifi_location_ID",
                "db_ValueName" => ":locationID",
                "db_realValue" => $locations
            ],
            [
                "db_FieldName" => "wifi_department_ID",
                "db_ValueName" => ":departmentID",
                "db_realValue" => $departments
            ],
            [
                "db_FieldName" => "wifi_updatedAt",
                "db_ValueName" => ":updatedAt",
                "db_realValue" => date('Y-m-d H:i:s')
            ]
        ];

        $wifiCondition = [
            "condition_FieldName" => "wifi_ID",
            "condition_ValueName" => ":ID",
            "condition_realValue" => $wifiID
        ];


        if ($this->updateData("wifi_directory", $wifiUpdateData, $wifiCondition)) {
            $alert = [
                "type" => "reload",
                "icon" => "success",
                "title" => "¡Operación Realizada!",
                "text" => "Wifi actualizado exitosamente.",
            ];
        } else {
            $alert = [
                "type" => "simple",
                "icon" => "error",
                "title" => "¡Error!",
                "text" => "No se pudo actualizar el Wifi.",
            ];
        }
        echo json_encode($alert);
        exit();
    }

    public function wifiListController($page, $register, $url, $search)
    {

        $page = $this->cleanRequest($page);
        $register = $this->cleanRequest($register);

        $url = $this->cleanRequest($url);
        $url = APP_URL . $url . "/";

        $search = $this->cleanRequest($search);
        $table = "";

        $page = (isset($page) && $page > 0) ? (int) $page : 1;
        $start = ($page > 0) ? (($page * $register) - $register) : 0;

        $dataRequest_Query = "SELECT * FROM wifi_directory
        JOIN locations ON wifi_directory.wifi_location_ID = locations.location_ID 
        JOIN departments ON wifi_directory.wifi_department_ID = departments.department_ID
        WHERE wifi_SSID LIKE '%$search%' 
        OR wifi_password LIKE '%$search%' 
        OR wifi_ipDirection LIKE '%$search%' 
        OR wifi_location_ID LIKE '%$search%' 
        OR wifi_department_ID LIKE '%$search%' 
        OR wifi_createdAt LIKE '%$search%'
        OR wifi_updatedAt LIKE '%$search%'
        OR wifi_isEnable LIKE '%$search%'
        ORDER BY location_name ASC, wifi_SSID ASC
        LIMIT $start,$register";

        $totalData_Query = "SELECT COUNT(wifi_ID) FROM wifi_directory 
        JOIN locations ON wifi_directory.wifi_location_ID = locations.location_ID 
        JOIN departments ON wifi_directory.wifi_department_ID = departments.department_ID
        WHERE wifi_SSID LIKE '%$search%' 
        OR wifi_password LIKE '%$search%' 
        OR wifi_ipDirection LIKE '%$search%' 
        OR wifi_location_ID LIKE '%$search%' 
        OR wifi_department_ID LIKE '%$search%' 
        OR wifi_createdAt LIKE '%$search%'
        OR wifi_updatedAt LIKE '%$search%'
        OR wifi_isEnable LIKE '%$search%'";

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
                                            SSID
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            Contraseña
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            Ubicación
                                        </th>
                                        <th scope="col" class="px-5 py-3">
                                            Departamento
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
                $table .= '
                    <tr class="bg-white border-b border-gray-200 text-gray-800 hover:bg-gray-200 transition duration-100">
                        <td class="px-5 py-2 whitespace-nowrap text-xs text-gray-400">' . $counter . '</td>
                        <td scope="row" class="px-5 py-2 font-medium text-gray-900 whitespace-nowrap">
                            <p class="text-xs">
                                ' . $rows['wifi_SSID'] . '
                            </p>
                            <div class="flex items-center mt-1 whitespace-nowrap">';
                if (!empty($rows['wifi_ipDirection'])) {
                    $table .= '
                                <button data-modal-target="addIpDirection" data-modal-toggle="addIpDirection" data-wifi-id="' . $rows['wifi_ID'] . '" class="flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-gray-900 hover:text-white transition duration-100">
                                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#ipFile" />
                                    </svg>
                                    ' . $rows['wifi_ipDirection'] . '
                                </button>
                                ';
                } else {
                    $table .= '
                                <button data-modal-target="addIpDirection" data-modal-toggle="addIpDirection" data-wifi-id="' . $rows['wifi_ID'] . '" class="flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-gray-900 hover:text-white transition duration-100">
                                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#ipFile" />
                                    </svg>
                                    N/A
                                </button>
                                ';
                }
                $table .= '
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <form action="' . APP_URL . 'app/ajax/wifiPasswordsAjax.php" class="AjaxForm" method="POST">
                                    <input type="hidden" name="wifiModule" value="wifiPassword">
                                    <input type="hidden" name="wifi_ID" value="' . $rows['wifi_ID'] . '">
                                    <div class="flex items-center">
                                    <button class="flex items-center text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100">
                                        <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#eye" />
                                        </svg>
                                        Ver
                                    </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                        <div class="flex items-center">';
                switch ($rows['location_isEnable']) {
                    case 1:
                        $table .= '
                                    <span class="flex items-center bg-green-100 text-green-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-green-900 hover:text-white transition duration-100">
                                    <svg class="shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                                    </svg>
                                    ' . $rows['location_name'] . '
                                </span>
                                ';
                        break;

                    case 0:
                        $table .= '
                                <span class="flex items-center bg-red-100 text-red-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-red-900 hover:text-white transition duration-100">
                                    <svg class="shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                                    </svg>
                                    ' . $rows['location_name'] . '
                                </span>
                                ';
                        break;
                }
                $table .= '
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">
                            <div class="flex items-center">';
                switch ($rows['department_isEnable']) {
                    case 1:
                        $table .= '
                                    <span class="flex items-center bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-purple-800 hover:text-white transition duration-100">
                                        <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#departments" />
                                        </svg>
                                        ' . $rows['department_name'] . '
                                    </span>
                                    ';
                        break;

                    case 0:
                        $table .= '
                                        <span class="flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-red-800 hover:text-white transition duration-100">
                                            <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                                <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#departments" />
                                            </svg>
                                            ' . $rows['department_name'] . '
                                        </span>
                                        ';
                        break;
                }
                $table .= '
                            </div>
                        </td>
                        <td class="px-5 py-2 whitespace-nowrap">';
                if ($rows['wifi_isEnable'] == 1) {
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
                            <div class="flex items-center justify-end space-x-1">
                                <div class="flex items-center">
                                    <button data-modal-target="editWifiPassword" data-modal-toggle="editWifiPassword"
                                    id="editPen-btn-' . $rows['wifi_ID'] . '"
                                    data-popover-target="popover-editPen-' . $rows['wifi_ID'] . '"
                                    data-popover-placement="bottom"
                                    data-wifi-id="' . $rows['wifi_ID'] . '" class="flex items-center text-yellow-400 border border-yellow-400 hover:bg-yellow-500 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#editPen" />
                                        </svg>
                                    </button>
                                    <div data-popover id="popover-editPen-' . $rows['wifi_ID'] . '" role="tooltip"
                                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                        <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                            <h3 class="font-semibold text-white text-xs">Editar</h3>
                                        </div>
                                            <div data-popper-arrow bg-gray-900></div>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                <form action="' . APP_URL . 'app/ajax/wifiPasswordsAjax.php" class="AjaxForm" method="POST">
                                    <input type="hidden" name="wifiModule" value="deleteWifiPassword">
                                    <input type="hidden" name="wifi_ID" value="' . $rows['wifi_ID'] . '">
                                    <button class="flex items-center text-red-800 border border-red-700 hover:bg-red-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100" data-popover-target="popover-trashCan-' . $rows['wifi_ID'] . '"
                                    data-popover-placement="bottom">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                            <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#trashCan" />
                                        </svg>
                                    </button>
                                    </form>
                                    <div data-popover id="popover-trashCan-' . $rows['wifi_ID'] . '" role="tooltip"
                                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                                        <div class="px-3 py-2 bg-gray-900 rounded-lg">
                                            <h3 class="font-semibold text-white text-xs">Eliminar</h3>
                                        </div>
                                            <div data-popper-arrow bg-gray-900></div>
                                    </div>
                                </div>
                                <form action="' . APP_URL . 'app/ajax/wifiPasswordsAjax.php" class="AjaxForm" method="POST">
                                    <input type="hidden" name="wifiModule" value="updateWifiState">
                                    <input type="hidden" name="wifi_ID" value="' . $rows['wifi_ID'] . '">
                                    <div class="flex items-center">
                                        <button type="submit" class="flex items-center text-green-700 border border-green-700 hover:bg-green-800 hover:text-white text-xs font-medium px-2.5 py-2.5 rounded-full transition duration-100" data-popover-target="popover-arrowRepeat-' . $rows['wifi_ID'] . '" data-popover-placement="bottom">
                                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                                <use xlink:href="' . APP_URL . '/app/assets/svg/FlowbiteIcons.sprite.svg#arrowRepeat" />
                                            </svg>
                                        </button>
                                        <div data-popover id="popover-arrowRepeat-' . $rows['wifi_ID'] . '" role="tooltip"
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
