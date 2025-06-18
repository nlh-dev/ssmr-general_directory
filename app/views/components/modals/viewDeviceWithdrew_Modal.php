<!-- Large Modal -->
<div id="viewWithdrewDeviceInfo" tabindex="0" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full animate__animated animate__fadeInDownBig md:mx-2">
    <div class="relative w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative rounded-lg shadow-sm bg-gray-900">
            <!-- Modal header -->
            <div class="modal-header flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <div class="flex items-center">
                    <img src="<?= APP_URL ?>app/assets/logos/SSMR_LOGO-1.png" class="h-10 mr-3" alt="">
                    <div class="flex flex-col">
                        <h3 class="text-xl font-medium text-white">
                            Información del Dispositivo
                        </h3>
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-white me-2"></div>
                            <p class="font-semibold text-white text-xs mr-1">Retirado por:</p>
                            <p class="text-white font-semibold text-xs" data-field="usuario_retiro"></p>
                            <p class="mx-1 text-white">/</p>
                            <p class="text-white font-semibold text-xs" data-field="fecha_retiro"></p>
                        </div>
                    </div>
                </div>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="viewWithdrewDeviceInfo">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body p-4 bg-white grid grid-cols-1 md:grid-cols-2 gap-5 rounded-b">
                <input type="hidden" name="deviceModule" id="deviceModule" value="getDeviceData" />
                <input type="hidden" name="device_ID" id="device_ID" value="" />
                <div class="">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#userSettings" />
                        </svg>
                        Recibido por:
                    </div>
                    <div class="flex mt-1">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm">
                            <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#userSettings" />
                            </svg>
                            <p data-field="recibido_por"></p>
                        </span>
                    </div>
                </div>
                <div class="">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#lockFile" />
                        </svg>
                        Descripción de Dispositivo:
                    </div>
                    <div class="flex mt-1">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm">
                            <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#lockFile" />
                            </svg>
                            <p data-field="descripcion"></p>
                        </span>
                    </div>
                </div>
                <div class="">
                    <div class="flex items-center">
                        <div class="flex items-center block text-sm font-medium text-gray-900">
                            <svg class="h-4 w-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#qrCode" />
                            </svg>
                            Número de Serial:
                        </div>
                    </div>
                    <div class="flex mt-1">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm">
                            <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#qrCode" />
                            </svg>
                            <p data-field="serial"></p>
                        </span>
                    </div>
                </div>
                <div class="">
                    <div for="roomCode" class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#bed" />
                        </svg>
                        Número de Habitación:
                    </div>
                    <div class="flex mt-1">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#bed" />
                            </svg>
                            <p data-field="habitacion"></p>
                        </span>
                    </div>
                </div>
                <div class="">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                        </svg>
                        Ubicación:
                    </div>
                    <div class="flex mt-1">
                        <span class="flex items-center bg-green-100 text-green-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-green-900 hover:text-white transition duration-100">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                            </svg>
                            <p data-field="ubicacion"></p>
                        </span>
                    </div>
                </div>
                <div class="">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#departments" />
                        </svg>
                        Departamento:
                    </div>
                    <div class="flex mt-1">
                        <span class="flex items-center bg-purple-100 hover:bg-purple-800 text-purple-800 hover:text-white text-xs font-medium px-2.5 py-1.5 rounded-sm transition duration-100">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#departments" />
                            </svg>
                            <p data-field="departamento"></p>
                        </span>
                    </div>
                </div>
                <hr class="md:col-span-2 border-gray-300">
                <div>
                    <div class="flex items-center">
                        <div class="flex items-center block text-sm font-medium text-gray-900">
                            <div class="h-2.5 w-2.5 rounded-full bg-gray-900 me-2"></div>
                            Entregado por:
                        </div>
                    </div>
                    <div class="flex mt-1">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-1.5 py-1 rounded-sm">
                            <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#usersGroup" />
                            </svg>
                            <p data-field="usuario_entrega"></p>
                        </span>
                    </div>
                </div>
                <div>
                    <div class="flex items-center">
                        <div class="flex items-center block text-sm font-medium text-gray-900">
                            <div class="h-2.5 w-2.5 rounded-full bg-gray-900 me-2"></div>
                            Fecha de Entrega:
                        </div>
                    </div>
                    <div class="flex mt-1">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-1.5 py-1 rounded-sm">
                            <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#calendarPen" />
                            </svg>
                            <p data-field="fecha_entrega"></p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-modal-target="viewWithdrewDeviceInfo"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const deviceId = this.getAttribute('data-device-id');
                document.getElementById('device_ID').value = deviceId;

                let fetchURL = '<?= APP_URL ?>app/ajax/deliveryDevicesAjax.php?deviceModule=getDeviceData&device_ID=' + deviceId;

                // FIELDS FROM MODAL HEADER
                let field_WithdrawUser = document.querySelector('.modal-header [data-field="usuario_retiro"]');
                let field_withdrawDate = document.querySelector('.modal-header [data-field="fecha_retiro"]');

                // FIELDS FROM MODAL BODY
                let field_DataRecieved = document.querySelector('.modal-body [data-field="recibido_por"]');
                let field_DeviceDescription = document.querySelector('.modal-body [data-field="descripcion"]');
                let field_SerialCode = document.querySelector('.modal-body [data-field="serial"]');
                let field_DeviceLocation = document.querySelector('.modal-body [data-field="ubicacion"]');
                let field_DeviceDepartment = document.querySelector('.modal-body [data-field="departamento"]');
                let field_DeviceRoom = document.querySelector('.modal-body [data-field="habitacion"]');
                let field_deliveryUser = document.querySelector('.modal-body [data-field="usuario_entrega"]');
                let field_deliveryDate = document.querySelector('.modal-body [data-field="fecha_entrega"]');

                fetch(fetchURL, {
                        method: 'GET',
                    })
                    .then(response => response.json())
                    .then(dataResponse => {
                        if (dataResponse) {
                            field_WithdrawUser.textContent = dataResponse.withdraw_user_fullName || 'N/A';;
                            field_DataRecieved.textContent = dataResponse.device_recievedByName || 'N/A';
                            field_DeviceDescription.textContent = dataResponse.device_description || '';
                            field_SerialCode.textContent = dataResponse.device_serialCode || 'N/A';
                            field_withdrawDate.textContent =
                                (dataResponse.device_withdrawDate ? new Date(dataResponse.device_withdrawDate + 'T' + dataResponse.device_withdrawTime).toLocaleString('es-ES', {
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    hour12: true,
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit'
                                }) : '');
                            field_DeviceLocation.textContent = dataResponse.location_name;
                            field_DeviceDepartment.textContent = dataResponse.department_name;
                            field_DeviceRoom.textContent = dataResponse.device_roomCode || 'N/A';
                            field_deliveryUser.textContent = dataResponse.delivery_user_fullName || 'N/A';
                            field_deliveryDate.textContent =
                                (dataResponse.device_deliveryDate ? new Date(dataResponse.device_deliveryDate + 'T' + dataResponse.device_deliveryTime).toLocaleString('es-ES', {
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    hour12: true,
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit'
                                }) : '');
                        }
                    });
            });
        });
    });
</script>