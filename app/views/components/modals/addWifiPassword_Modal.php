<?php

use app\controllers\wifiController;

$wifiController = new wifiController();
$showDepartmentsData = $wifiController->getDepartmentsController();
$showLocationsData = $wifiController->getLocationsController();

$departmentsByLocation = [];
foreach ($showDepartmentsData as $dep) {
    $departmentsByLocation[$dep['department_ID']] = [
        'name' => $dep['department_name'],
        'location_ID' => $dep['department_location_ID']
    ];
}
?>

<!-- Large Modal -->
<div id="addWifiPassword" tabindex="0" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full animate__animated animate__fadeInDownBig md:mx-2">
    <div class="relative w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative rounded-lg shadow-sm bg-gray-900">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <img src="<?= APP_URL ?>app/assets/logos/SSMR_LOGO-1.png" class="h-10 mr-3" alt="">
                <h3 class="text-xl font-medium text-white">
                    Añadir Contraseña
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="addWifiPassword">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?= $wifiAjaxRoutes['saveWifiPassword'] ?>" class="AjaxForm" method="POST" autocomplete="OFF">
                <input type="hidden" name="wifiModule" id="wifiModule" value="saveWifiPassword">
                <div class="p-4 bg-white grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="">
                        <label for="SSID" class="flex items-center block text-sm font-medium text-gray-900">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#lockFile" />
                            </svg>
                            SSID
                        </label>
                        <div class="relative my-2">
                            <input type="text" id="SSID" name="SSID" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="SSID....">
                        </div>
                    </div>
                    <div class="">
                        <div class="flex items-center justify-between">
                            <label for="wifiPassword" class="flex items-center block text-sm font-medium text-gray-900">
                                <svg class="mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#padLock" />
                                </svg>
                                Contraseña
                            </label>
                            <div>
                                <input id="wifiCheckbox" name="wifiCheckbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                                <label for="wifiCheckbox" class="ms-2 text-sm font-medium text-gray-900">
                                    No Posee
                                </label>
                            </div>
                        </div>
                        <div class="relative my-2">
                            <input type="text" id="wifiPassword" name="wifiPassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Contraseña....">
                        </div>
                    </div>
                    <div class="">
                        <label for="ipDirection" class="flex items-center block text-sm font-medium text-gray-900">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#ipFile" />
                            </svg>
                            Dirección IP
                        </label>
                        <div class="relative my-2">
                            <input type="text" id="ipDirection" name="ipDirection" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Dirección IP....">
                        </div>
                    </div>
                    <div class="">
                        <label for="locations" class="flex items-center block text-sm font-medium text-gray-900">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                            </svg>
                            Ubicación
                        </label>
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
                        <label for="departments" class="flex items-center block text-sm font-medium text-gray-900">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#departments" />
                            </svg>
                            Departamento
                        </label>
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
                </div>
                <!-- Modal footer -->
                <div class="w-full flex items-center justify-end p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b">
                    <button data-modal-hide="addWifiPassword" type="button" class="AjaxForm px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 mr-3">
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
        const wifiCheckbox = document.getElementById('wifiCheckbox');
        const wifiPasswordInput = document.getElementById('wifiPassword');

        wifiCheckbox.addEventListener('change', function() {
            wifiPasswordInput.readOnly = this.checked;
            wifiPasswordInput.disabled = false;
            if (this.checked) {
                wifiPasswordInput.classList.add('cursor-not-allowed');
                wifiPasswordInput.classList.add('bg-gray-200');
                wifiPasswordInput.classList.remove('focus:ring-blue-500');
                wifiPasswordInput.classList.remove('focus:border-blue-500');
                wifiPasswordInput.classList.remove('bg-gray-50');
                wifiPasswordInput.value = '';
            } else {
                wifiPasswordInput.classList.remove('cursor-not-allowed');
                wifiPasswordInput.classList.remove('bg-gray-200');
                wifiPasswordInput.classList.add('focus:ring-blue-500');
                wifiPasswordInput.classList.add('focus:border-blue-500');
                wifiPasswordInput.classList.add('bg-gray-50');
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona el botón de cerrar/cancelar del modal
        document.querySelectorAll('[data-modal-hide="addWifiPassword"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                clearAddWifiPasswordModal();
            });
        });

        // También puedes limpiar al abrir el modal si lo deseas
        document.querySelectorAll('[data-modal-target="addWifiPassword"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                clearAddWifiPasswordModal();
            });
        });

        function clearAddWifiPasswordModal() {
            const form = document.querySelector('#addWifiPassword form');
            if (!form) return;
            form.reset();

            // Si tienes selects personalizados, restáuralos manualmente
            form.querySelectorAll('select').forEach(function(select) {
                select.selectedIndex = 0;
            });

            // Limpia estilos y clases de los inputs
            const wifiPasswordInput = form.querySelector('#wifiPassword');
            if (wifiPasswordInput) {
                wifiPasswordInput.classList.remove('cursor-not-allowed', 'bg-gray-200');
                wifiPasswordInput.classList.add('focus:ring-blue-500', 'focus:border-blue-500', 'bg-gray-50');
                wifiPasswordInput.readOnly = false;
                wifiPasswordInput.disabled = false;
            }
            const wifiCheckbox = form.querySelector('#wifiCheckbox');
            if (wifiCheckbox) {
                wifiCheckbox.checked = false;
            }
        }
    });

    // Relación departamentos-ubicaciones desde PHP
    const departmentsByLocation = <?= json_encode($departmentsByLocation) ?>;

    document.addEventListener('DOMContentLoaded', function() {
        const locationsSelect = document.getElementById('locations');
        const departmentsSelect = document.getElementById('departments');

        locationsSelect.addEventListener('change', function() {
            const selectedLocation = this.value;
            departmentsSelect.innerHTML = '<option value="">Cargando Departamentos...</option>';

            setTimeout(() => {
                departmentsSelect.innerHTML = '<option value="">Seleccione....</option>';
                Object.entries(departmentsByLocation).forEach(([id, dep]) => {
                    if (dep.location_ID == selectedLocation) {
                        const option = document.createElement('option');
                        option.value = id;
                        option.textContent = dep.name;
                        departmentsSelect.appendChild(option);
                    }
                });
            }, 400);
        });
    });
</script>