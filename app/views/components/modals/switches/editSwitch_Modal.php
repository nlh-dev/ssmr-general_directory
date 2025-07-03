<?php

use app\controllers\mainController;

$mainController = new mainController();
$showDepartmentsData = $mainController->getDataController('departments', 'department_name', 'ASC');
$showLocationsData = $mainController->getDataController('locations', 'location_name', 'ASC');
$showSwitchBrandData = $mainController->getDataController('switch_brand_directory', 'switchBrand_name', 'ASC');


$departmentsByLocation = [];
foreach ($showDepartmentsData as $dep) {
    $departmentsByLocation[$dep['department_ID']] = [
        'name' => $dep['department_name'],
        'location_ID' => $dep['department_location_ID']
    ];
}
?>

<!-- Large Modal -->
<div id="editSwitch" tabindex="0" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full animate__animated animate__fadeInDownBig md:mx-2">
    <div class="relative w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative rounded-lg shadow-sm bg-gray-900">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <img src="<?= APP_URL ?>app/assets/logos/SSMR_LOGO-1.png" class="h-10 mr-3" alt="">
                <h3 class="text-xl font-medium text-white">
                    Editar Switch de Red
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editSwitch">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?= $AjaxRoutes['switches'] ?>" class="AjaxForm" method="POST" autocomplete="OFF">
                <input type="hidden" name="switchModule" id="switchModule" value="editSwitch">
                <input type="hidden" name="switch_ID" id="switch_ID" value="">
                <div class="modal-body p-4 bg-white grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="switchName" class="flex items-center block text-sm font-medium text-gray-900">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#codeFork" />
                                </svg>
                                Nombre de Switch
                                <span class="font-bold text-red-600 ms-1">*</span>
                            </label>
                        </div>
                        <div class="relative my-2">
                            <input type="text" id="switchName" name="switchName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Recibido por....">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <div class="flex items-center justify-between">
                                <label for="serialNumber" class="flex items-center block text-sm font-medium text-gray-900">
                                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#qrCode" />
                                    </svg>
                                    Serial <span class="text-gray-400 ms-1">(Opcional)</span>
                                </label>
                            </div>
                            <div class="relative my-2">
                                <input type="text" id="serialNumber" name="serialNumber" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Recibido por....">
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center">
                                <label for="switchBrand" class="flex items-center block text-sm font-medium text-gray-900">
                                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                        <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#sharingNodes" />
                                    </svg>
                                    Marca
                                    <span class="font-bold text-red-600 ms-1">*</span>
                                </label>
                            </div>
                            <div class="relative my-2">
                                <select id="switchBrand" name="switchBrand" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected value="">Seleccione....</option>
                                    <?php foreach ($showSwitchBrandData as $key => $brandValue) { ?>
                                        <option value="<?= $brandValue['switchBrand_ID'] ?>">
                                            <?= $brandValue['switchBrand_name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="flex items-center">
                            <label for="locations" class="flex items-center block text-sm font-medium text-gray-900">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                                </svg>
                                Ubicación
                                <p class="font-bold text-red-600 ms-1">*</p>
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
                        <div class="flex items-center justify-between">
                            <label for="departments" class="flex items-center block text-sm font-medium text-gray-900">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#departments" />
                                </svg>
                                Departamento
                                <p class="font-bold text-red-600 ms-1">*</p>
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
                        <div class="flex items-center">
                            <label for="primalIpDirection" class="flex items-center block text-sm font-medium text-gray-900">
                                <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#ipFile" />
                                </svg>
                                Dirección IP Primaria
                                <span class="text-gray-500 ms-1">(Opcional)</span>
                            </label>
                        </div>
                        <div class="relative my-2">
                            <input type="text" id="primalIpDirection" name="primalIpDirection" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Dirección IP Primaria....">
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="switchPortAmount" class="flex items-center block text-sm font-medium text-gray-900">
                                <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#arrowUpDown" />
                                </svg>
                                Cantidad de Puertos
                                <p class="font-bold text-red-600 ms-1">*</p>
                            </label>
                        </div>
                        <div class="relative my-2">
                            <input type="number" id="switchPortAmount" name="switchPortAmount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Cantidad de Puertos....">
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="w-full flex items-center justify-end p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b">
                    <button data-modal-hide="editSwitch" type="button" class="AjaxForm px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 mr-3">
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
        document.querySelectorAll('[data-modal-target="editSwitch"]').forEach(function(editSwitchButton) {
            editSwitchButton.addEventListener('click', function() {
                const switchId = this.getAttribute('data-switch-id');
                document.querySelector('#editSwitch #switch_ID').value = switchId;
                
                let switchURL = "<?= APP_URL ?>app/ajax/switchesAjax.php?switchModule=getSwitchData&switch_ID=" + switchId;
                const formData = new FormData();
                formData.append("switch_ID", switchId);

                const editSwitch = document.getElementById('editSwitch');
                let inputSwitchName = editSwitch.querySelector('#switchName');
                let inputSerialNumber = editSwitch.querySelector('#serialNumber');
                let inputSwitchBrand = editSwitch.querySelector('#switchBrand');
                let inputLocations = editSwitch.querySelector('#locations');
                let inputDepartments = editSwitch.querySelector('#departments');
                let inputPrimalIpDirection = editSwitch.querySelector('#primalIpDirection');
                let inputSwitchPortAmount = editSwitch.querySelector('#switchPortAmount');
                
                let fetchDepartmentsURL = '<?= APP_URL ?>app/ajax/departmentsAjax.php';
                function getDepartmentsByLocation(locationId, selectedDepartmentId = null, fromSelector = false) {
                    inputDepartments.innerHTML = '<option selected value="">Cargando Departamentos....</option>';
                    if (!locationId) {
                        inputDepartments.innerHTML = '<option selected value="">Seleccione....</option>';
                        return;
                    }
                    setTimeout(function() {
                        fetch(fetchDepartmentsURL, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
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

                inputLocations.onchange = null;
                inputLocations.addEventListener('change', function() {
                    getDepartmentsByLocation(this.value, null, true);
                });

                fetch(switchURL, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(dataResponse => {
                        inputSwitchName.value = dataResponse.switch_name;
                        inputSerialNumber.value = dataResponse.switch_serial || '';
                        inputSwitchBrand.value = dataResponse.switch_brand_ID;
                        inputLocations.value = dataResponse.switch_location_ID;
                        inputPrimalIpDirection.value = dataResponse.switch_ipDirection || '';
                        inputSwitchPortAmount.value = dataResponse.switch_portAmount;
                        getDepartmentsByLocation(dataResponse.switch_location_ID, dataResponse.switch_department_ID);
                    }).catch(err => {
                        console.error(err);
                    });
            });
        });
    });
</script>