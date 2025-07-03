<!-- Large Modal -->
<div id="viewSwitchInfo" tabindex="0" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full animate__animated animate__fadeInDownBig md:mx-2">
    <div class="relative w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative rounded-lg shadow-sm bg-gray-900">
            <!-- Modal header -->
            <div class="modal-header flex items-center justify-between p-3 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <div class="flex items-center">
                    <img src="<?= APP_URL ?>app/assets/logos/SSMR_LOGO-1.png" class="h-10 mr-3" alt="">
                    <div class="flex flex-col">
                        <h3 class="text-xl font-medium text-white">
                            Información de Switch
                        </h3>
                        <div class="flex items-center mt-1">
                            <div class="h-2.5 w-2.5 rounded-full bg-white me-2"></div>
                            <p class="text-white font-semibold text-xs me-1">Fecha de Creación:</p>
                            <p class="text-white font-semibold text-xs" data-field="switch_createdAt"></p>
                        </div>
                    </div>
                </div>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="viewSwitchInfo">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body p-4 bg-white grid grid-cols-1 md:grid-cols-4 gap-5 rounded-b">
                <input type="hidden" name="switch_ID" id="switch_ID" value="" />
                <div class="md:col-span-2">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#codeFork" />
                        </svg>
                        Nombre del Switch
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm">
                            <p class="" data-field="switch_nombre"></p>
                        </span>
                    </div>
                </div>
                <div class="">
                    <div class="flex items-center">
                        <div class="flex items-center block text-sm font-medium text-gray-900">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#qrCode" />
                            </svg>
                            Serial
                        </div>
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm">
                            <p data-field="switch_serial"></p>
                        </span>
                    </div>
                </div>
                <div class="">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#sharingNodes" />
                        </svg>
                        Marca
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm">
                            <p data-field="switch_marca"></p>
                        </span>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#ipFile" />
                        </svg>
                        Dirección IP Primaria
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm">
                            <p class="" data-field="switch_primalIp"></p>
                        </span>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#codeMerge" />
                        </svg>
                        Cantidad de Puertos
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm">
                            <p class="" data-field="switch_totalPorts"></p>
                        </span>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#codeMerge" />
                        </svg>
                        Puertos Disponibles
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm">
                            <p class="" data-field="switch_availablePorts"></p>
                        </span>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#codeMerge" />
                        </svg>
                        Puertos Utilizados
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm">
                            <p class="" data-field="switch_usedPorts"></p>
                        </span>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                        </svg>
                        Ubicacion
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center bg-green-100 text-green-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-green-900 hover:text-white transition duration-100">
                            <svg class="shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                            </svg>
                            <p data-field="switch_location"></p>
                        </span>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#departments" />
                        </svg>
                        Departamento
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-purple-800 hover:text-white transition duration-100">
                            <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#departments" />
                            </svg>
                            <p data-field="switch_department"></p>
                        </span>
                    </div>
                </div>
                <div class="md:col-span-4 relative">
                    <hr class="absolute inset-x-0 top-1/2 transform -translate-y-1/2 z-0 md:col-span-4 text-gray-300">
                    <div class="flex items-center justify-center relative z-10">
                        <div class="px-4 py-1 bg-white rounded-full border border-gray-300 flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-gray-500 me-2"></div>
                            <p class="text-gray-500 font-semibold text-xs me-1">Fecha de Actualización:</p>
                            <p class="text-gray-500 font-semibold text-xs" data-field="switch_updatedAt"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-modal-target="viewSwitchInfo"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const switchId = this.getAttribute('data-switch-id');
                document.getElementById('switch_ID').value = switchId;

                let switchURL = "<?= APP_URL ?>app/ajax/switchesAjax.php?switchModule=getAllSwitchData&switch_ID=" + switchId;

                // FIELDS FROM MODAL
                let field_switchCreatedAt = document.querySelector('.modal-header [data-field="switch_createdAt"]');
                let field_switchUpdatedAt = document.querySelector('.modal-body [data-field="switch_updatedAt"]');
                let field_switchName = document.querySelector('.modal-body [data-field="switch_nombre"]');
                let field_switchSerial = document.querySelector('.modal-body [data-field="switch_serial"]');
                let field_switchBrand = document.querySelector('.modal-body [data-field="switch_marca"]');
                let field_switchPrimalIp = document.querySelector('.modal-body [data-field="switch_primalIp"]');
                let field_switchTotalPorts = document.querySelector('.modal-body [data-field="switch_totalPorts"]');
                let field_switchAvailablePorts = document.querySelector('.modal-body [data-field="switch_availablePorts"]');
                let field_switchUsedPorts = document.querySelector('.modal-body [data-field="switch_usedPorts"]');
                let field_switchLocation = document.querySelector('.modal-body [data-field="switch_location"]');
                let field_switchDepartment = document.querySelector('.modal-body [data-field="switch_department"]');

                fetch(switchURL, {
                        method: 'GET',
                    })
                    .then(response => response.json())
                    .then(dataResponse => {
                        if (dataResponse) {
                            // Combinar fecha y hora para createdAt y updatedAt
                            let createdAtDate = dataResponse.switch_createdAtDate;
                            let createdAtTime = dataResponse.switch_createdAtTime;
                            let updatedAtDate = dataResponse.switch_updatedAtDate;
                            let updatedAtTime = dataResponse.switch_updatedAtTime;
                            let dateOptions = {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true,
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            };
                            if (createdAtDate && createdAtTime) {
                                let dateValue = new Date(createdAtDate + 'T' + createdAtTime);
                                field_switchCreatedAt.textContent = dateValue.toLocaleString('es-ES', dateOptions);
                            } else {
                                field_switchCreatedAt.textContent = 'Fecha de Creación no Encontrada';
                            }
                            if (updatedAtDate && updatedAtTime) {
                                let dateValue = new Date(updatedAtDate + 'T' + updatedAtTime);
                                field_switchUpdatedAt.textContent = dateValue.toLocaleString('es-ES', dateOptions);
                            } else {
                                field_switchUpdatedAt.textContent = 'Fecha de Actualización no Encontrada';
                            }
                            // ...resto de asignaciones...
                            field_switchName.textContent = dataResponse.switch_name;
                            field_switchSerial.textContent = dataResponse.switch_serialCode || 'N/A';
                            field_switchBrand.textContent = dataResponse.switchBrand_name;
                            field_switchPrimalIp.textContent = dataResponse.switch_ipManagement || 'N/A';
                            field_switchTotalPorts.textContent = dataResponse.switch_portAmount + ' Puertos';
                            field_switchAvailablePorts.textContent = dataResponse.available_ports + ' Puertos';
                            field_switchUsedPorts.textContent = dataResponse.used_ports + ' Puertos';
                            field_switchLocation.textContent = dataResponse.location_name;
                            field_switchDepartment.textContent = dataResponse.department_name;
                        }
                    });
            });
        });
    });
</script>