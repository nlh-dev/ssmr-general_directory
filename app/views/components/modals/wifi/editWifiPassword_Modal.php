<?php

use app\controllers\mainController;

$mainController = new mainController();
$showDepartmentsData = $mainController->getDataController('departments', 'department_name', 'ASC');
$showLocationsData = $mainController->getDataController('locations', 'location_name', 'ASC');
?>

<!-- Large Modal -->
<div id="editWifiPassword" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full animate__animated animate__fadeInDownBig md:mx-2" aria-hidden="true">
    <div class="relative w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative rounded-lg shadow-sm bg-gray-900">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <img src="<?= APP_URL ?>app/assets/logos/SSMR_LOGO-1.png" class="h-10 mr-3" alt="">
                <h3 class="text-xl font-medium text-white">
                    Editar Contraseña
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editWifiPassword">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?= $AjaxRoutes['wifiPasswords'] ?>" class="AjaxForm" method="POST" autocomplete="OFF">
                <input type="hidden" name="wifi_ID" id="wifi_ID" value="">
                <input type="hidden" name="wifiModule" value="updateWifi">
                <div class="modal-body p-4 bg-white grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="">
                        <div class="flex items-center">
                            <label for="SSID" class="flex items-center block text-sm font-medium text-gray-900">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#lockFile" />
                                </svg>
                                SSID
                                <span class="font-bold text-red-600 ms-1">*</span>
                            </label>
                        </div>
                        <div class="relative my-2">
                            <input type="text" id="SSID" name="SSID" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="SSID....">
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center">
                            <label for="wifiPassword" class="flex items-center block text-sm font-medium text-gray-900">
                                <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#padLock" />
                                </svg>
                                Contraseña<span class="text-gray-400 ms-1">(Opcional)</span>
                            </label>
                        </div>
                        <div class="relative my-2">
                            <input type="text" id="wifiPassword" name="wifiPassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Contraseña....">
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center">
                            <label for="locations" class="flex items-center block text-sm font-medium text-gray-900">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                                </svg>
                                Ubicación
                                <span class="font-bold text-red-600 ms-1">*</span>
                            </label>
                        </div>
                        <div class="relative my-2">
                            <select id="locations" name="locations" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected value="">Seleccione....</option>
                                <?php foreach ($showLocationsData as $key => $locationsValue) { ?>
                                    <option value="<?= $locationsValue['location_ID'] ?>">
                                        <?= $locationsValue['location_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex items-center">
                            <label for="departments" class="flex items-center block text-sm font-medium text-gray-900">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#departments" />
                                </svg>
                                Departamento
                                <span class="font-bold text-red-600 ms-1">*</span>
                            </label>
                        </div>
                        <div class="relative my-2">
                            <select id="departments" name="departments" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected value="">Seleccione....</option>
                                <?php foreach ($showDepartmentsData as $key => $departmentsValue) { ?>
                                    <option value="<?= $departmentsValue['department_ID'] ?>">
                                        <?= $departmentsValue['department_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <label for="ipDirection" class="flex items-center block text-sm font-medium text-gray-900">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#ipFile" />
                            </svg>
                            Dirección IP / Dirección de Acceso<span class="text-gray-400 ms-1">(Opcional)</span>
                        </label>
                        <div class="relative my-2">
                            <input type="text" id="ipDirection" name="ipDirection" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Dirección IP....">
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center">
                            <label for="departments" class="flex items-center block text-sm font-medium text-gray-900">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#filter" />
                                </svg>
                                Filtro de MAC Avanzado<span class="text-gray-400 ms-1">(Opcional)</span>
                            </label>
                        </div>
                        <div class="flex items-center rounded-sm">
                            <input id="macFilterCheckBox" type="checkbox" value="0" name="macFilterCheckBox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                            <label for="macFilterCheckBox" class="w-full py-4 ms-2 text-sm font-medium text-gray-900">Activado</label>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="w-full flex items-center justify-end p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b">
                    <button data-modal-hide="editWifiPassword" type="button" class="AjaxForm px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 mr-3">
                        <svg class="w-5 h-5 text-white me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Cancelar
                    </button>
                    <button type="submit" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 transition duration-100">
                        <svg class="w-5 h-5 text-white me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-modal-target="editWifiPassword"]').forEach(function(editWifiButton) {
            editWifiButton.addEventListener('click', function() {
                const wifiId = this.getAttribute('data-wifi-id');
                document.getElementById('wifi_ID').value = wifiId;

                let wifiURL = "<?= APP_URL ?>app/ajax/wifiPasswordsAjax.php?wifiModule=getWifiData&wifi_ID=" + wifiId;
                let formData = new FormData();
                formData.append('wifi_ID', wifiId);

                let inputSSID = document.querySelector('.modal-body #SSID');
                let inputPassword = document.querySelector('.modal-body #wifiPassword');
                let inputIpDirection = document.querySelector('.modal-body #ipDirection');
                let inputLocations = document.querySelector('.modal-body #locations');
                let inputDepartments = document.querySelector('.modal-body #departments');
                let macFilterCheckBox = document.querySelector('.modal-body #macFilterCheckBox');

                let fetchURL = '<?= APP_URL ?>app/ajax/departmentsAjax.php';

                // Función para cargar departamentos según la ubicación seleccionada
                function getDepartmentsByLocation(locationId, selectedDepartmentId = null, fromSelector = false) {
                    inputDepartments.innerHTML = '<option selected value="">Cargando Departamentos....</option>';
                    if (!locationId) {
                        inputDepartments.innerHTML = '<option selected value="">Seleccione....</option>';
                        return;
                    }
                    setTimeout(function() {
                        fetch(fetchURL, {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: 'location_ID=' + encodeURIComponent(locationId) + '&getDepartmentsByLocation=1'
                        })
                        .then(response => response.json())
                        .then(data => {
                            let options = '';
                            if (data.length === 0 && fromSelector) {
                                options = '<option value="" selected>No hay departamentos Relacionados....</option>';
                            } else {
                                options = '<option selected value="">Seleccione....</option>';
                                data.forEach(dep => {
                                    options += `<option value="${dep.department_ID}" ${selectedDepartmentId == dep.department_ID ? 'selected' : ''}>${dep.department_name}</option>`;
                                });
                            }
                            inputDepartments.innerHTML = options;
                        })
                        .catch(() => {
                            inputDepartments.innerHTML = '<option selected value="">Error al cargar</option>';
                        });
                    }, 400);
                }

                inputLocations.addEventListener('change', function() {
                    getDepartmentsByLocation(this.value, null, true);
                });

                macFilterCheckBox.addEventListener('change', function() {
                    this.value = this.checked ? '1' : '0';
                });
                document.querySelector('#editWifiPassword form').addEventListener('submit', function() {
                    macFilterCheckBox.value = macFilterCheckBox.checked ? '1' : '0';
                });
                
                fetch(wifiURL, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(dataResponse => {
                        inputSSID.value = dataResponse.data.wifi_SSID;
                        inputPassword.value = dataResponse.data.wifi_password;
                        inputIpDirection.value = dataResponse.data.wifi_ipDirection;
                        inputLocations.value = dataResponse.data.wifi_location_ID;
                        // Cargar departamentos según la ubicación y seleccionar el correspondiente
                        getDepartmentsByLocation(dataResponse.data.wifi_location_ID, dataResponse.data.wifi_department_ID);

                        if (dataResponse.data.wifi_isMACProtected == "1") {
                            macFilterCheckBox.checked = true;
                            macFilterCheckBox.value = "1";
                        } else {
                            macFilterCheckBox.checked = false;
                            macFilterCheckBox.value = "0";
                        }
                    }).catch(err => {
                        console.error(err);
                    });
            });
        });
    });
</script>