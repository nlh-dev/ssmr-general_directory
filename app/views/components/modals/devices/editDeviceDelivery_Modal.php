<?php

use app\controllers\mainController;

$mainController = new mainController();
$showDepartmentsData = $mainController->getDataController('departments', 'department_name', 'ASC');
$showLocationsData = $mainController->getDataController('locations', 'location_name', 'ASC');
?>

<!-- Large Modal -->
<div id="editDeliveredDevices" tabindex="0" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full animate__animated animate__fadeInDownBig md:mx-2">
    <div class="relative w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative rounded-lg shadow-sm bg-gray-900">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <img src="<?= APP_URL ?>app/assets/logos/SSMR_LOGO-1.png" class="h-10 mr-3" alt="">
                <h3 class="text-xl font-medium text-white">
                    Editar Entrega
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editDeliveredDevices">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?= $AjaxRoutes['deliveryDevices'] ?>" class="AjaxForm" method="POST" autocomplete="OFF">
                <input type="hidden" name="deviceModule" id="deviceModule" value="updateDeliveredDevices">
                <input type="hidden" name="device_ID" id="device_ID" value="">
                <div class="modal-body p-4 bg-white grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="">
                        <label for="recievedByName" class="flex items-center block text-sm font-medium text-gray-900">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#userSettings" />
                            </svg>
                            Recibido por:<span class="text-gray-400 ms-1">(Opcional)</span>
                        </label>
                        <div class="relative my-2">
                            <input type="text" id="recievedByName" name="recievedByName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Recibido por....">
                        </div>
                    </div>
                    <div class="">
                        <div class="flex items-center justify-between">
                            <label for="deviceDescription" class="flex items-center block text-sm font-medium text-gray-900">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#lockFile" />
                                </svg>
                                Descripción de Dispositivo
                            </label>
                            <p class="font-bold text-red-600">*</p>
                        </div>
                        <div class="relative my-2">
                            <input type="text" id="deviceDescription" name="deviceDescription" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Dispositivo....">
                        </div>
                    </div>
                    <div class="">
                        <div class="flex items-center justify-between">
                            <label for="serialCode" class="flex items-center block text-sm font-medium text-gray-900">
                                <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#qrCode" />
                                </svg>
                                Número de Serial
                            </label>
                            <p class="font-bold text-red-600">*</p>
                        </div>
                        <div class="relative my-2">
                            <input type="text" id="serialCode" name="serialCode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Serial....">
                        </div>
                    </div>
                    <div class="">
                        <div class="flex items-center justify-between">
                            <label for="deliveryDate" class="flex items-center block text-sm font-medium text-gray-900">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#calendarPen" />
                                </svg>
                                Fecha de Entrega
                            </label>
                            <p class="font-bold text-red-600">*</p>
                        </div>
                        <div class="relative my-2">
                            <input type="date" id="deliveryDate" name="deliveryDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                    </div>
                    <div class="">
                        <div class="flex items-center justify-between">
                            <label for="locations" class="flex items-center block text-sm font-medium text-gray-900">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                                </svg>
                                Ubicación
                            </label>
                            <p class="font-bold text-red-600">*</p>
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
                            </label>
                            <p class="font-bold text-red-600">*</p>
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
                        <label for="roomCode" class="flex items-center block text-sm font-medium text-gray-900">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#bed" />
                            </svg>
                            Número de Habitación<span class="text-gray-400 ms-1">(Opcional)</span>
                        </label>
                        <div class="relative my-2">
                            <input type="text" id="roomCode" name="roomCode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Número de Habitación....">
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="w-full flex items-center justify-end p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b">
                    <button data-modal-hide="editDeliveredDevices" type="button" class="AjaxForm px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 mr-3">
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
        // Selecciona el botón de cerrar/cancelar del modal
        document.querySelectorAll('[data-modal-hide="editDeliveredDevices"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                clearModal();
            });
        });

        function clearModal() {
            const form = document.querySelector('#editDeliveredDevices form');
            if (!form) return;
            form.reset();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-modal-target="editDeliveredDevices"]').forEach(function(editDeviceButton) {
            editDeviceButton.addEventListener('click', function() {
                const deviceID = this.getAttribute('data-device-id');
                document.getElementById('device_ID').value = deviceID;

                let inputDeviceID = document.querySelector('#editDeliveredDevices #device_ID');
                let inputRecievedByName = document.querySelector('.modal-body #recievedByName');
                let inputDeviceDescription = document.querySelector('.modal-body #deviceDescription');
                let inputSerialCode = document.querySelector('.modal-body #serialCode');
                let inputDeliveryDate = document.querySelector('.modal-body #deliveryDate');
                let inputLocations = document.querySelector('.modal-body #locations');
                let inputDepartments = document.querySelector('.modal-body #departments');
                let inputRoomCode = document.querySelector('.modal-body #roomCode');

                let fetchURL = '<?= APP_URL ?>app/ajax/deliveryDevicesAjax.php?deviceModule=getDeviceData&device_ID=' + deviceID;
                let formData = new FormData();
                formData.append('device_ID', deviceID);

                fetch(fetchURL, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(dataResponse => {
                        // Unifica el acceso a los datos
                        const data = dataResponse.data || dataResponse || {};
                        const deviceFieldMap = {
                            device_ID: inputDeviceID,
                            device_recievedByName: inputRecievedByName,
                            device_description: inputDeviceDescription,
                            device_serialCode: inputSerialCode,
                            device_deliveryDate: inputDeliveryDate,
                            device_location_ID: inputLocations,
                            device_department_ID: inputDepartments,
                            device_roomCode: inputRoomCode
                        };
                        Object.entries(deviceFieldMap).forEach(([deviceKey, input]) => {
                            if (Array.isArray(input)) {
                                input.forEach(inputMap => {
                                    if (inputMap) inputMap.value = data[deviceKey] || deviceID || '';
                                });
                            } else if (input) {
                                input.value = data[deviceKey] || 'N/A';
                            }
                        });
                    }).catch(err => {
                        console.error(err);
                    });
            });
        });
    });
</script>