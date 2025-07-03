<!-- Large Modal -->
<div id="viewWifiPasswordInfo" tabindex="0" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full animate__animated animate__fadeInDownBig md:mx-2">
    <div class="relative w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative rounded-lg shadow-sm bg-gray-900">
            <!-- Modal header -->
            <div class="modal-header flex items-center justify-between p-3 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <div class="flex items-center">
                    <img src="<?= APP_URL ?>app/assets/logos/SSMR_LOGO-1.png" class="h-10 mr-3" alt="">
                    <div class="flex flex-col">
                        <h3 class="text-xl font-medium text-white">
                            Información de Wi-Fi
                        </h3>
                        <div class="flex items-center mt-1">
                            <div class="h-2.5 w-2.5 rounded-full bg-white me-2"></div>
                            <p class="text-white font-semibold text-xs me-1">Fecha de Creación:</p>
                            <p class="text-white font-semibold text-xs" data-field="wifi_fechaCreacion"></p>
                        </div>
                    </div>
                </div>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="viewWifiPasswordInfo">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body p-4 bg-white grid grid-cols-1 md:grid-cols-2 gap-5 rounded-b">
                <input type="hidden" name="observationsModule" id="observationsModule" value="getObservationData" />
                <input type="hidden" name="observation_ID" id="observation_ID" value="" />
                <div class="">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#lockFile" />
                        </svg>
                        SSID
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm">
                            <p class="" data-field="wifi_SSID"></p>
                        </span>
                    </div>
                </div>
                <div class="">
                    <div class="flex items-center">
                        <div class="flex items-center block text-sm font-medium text-gray-900">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#padLock" />
                            </svg>
                            Contraseña
                        </div>
                        <div class="flex items-center ms-4">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="showPasswordToggle" name="showPasswordToggle" value="" class="sr-only peer">
                                <div class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-600"></div>
                                <span class="text-xs ms-2 font-semibold text-gray-600">Ver</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm">
                            <p data-field="wifi_clave"></p>
                        </span>
                    </div>
                </div>
                <div class="">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#ipFile" />
                        </svg>
                        Dirección IP / Dirección de Acceso
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm">
                            <p data-field="wifi_direccionIP"></p>
                        </span>
                    </div>
                </div>
                <div class="">
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
                            <p data-field="wifi_ubicacion"></p>
                        </span>
                    </div>
                </div>
                <div class="">
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
                            <p data-field="wifi_departamento"></p>
                        </span>
                    </div>
                </div>
                <div class="">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#filter" />
                        </svg>
                        Filtro de MAC Avanzado
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm">
                            <p data-field="wifi_filtroMAC"></p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let toggle_wifiPassword;
        let field_wifiPassword;
        document.querySelectorAll('[data-modal-target="viewWifiPasswordInfo"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const wifiId = this.getAttribute('data-wifi-id');
                document.getElementById('wifi_ID').value = wifiId;

                let wifiURL = "<?= APP_URL ?>app/ajax/wifiPasswordsAjax.php?wifiModule=getWifiData&wifi_ID=" + wifiId;


                // FIELDS FROM MODAL BODY
                let field_wifiCreatedAt = document.querySelector('.modal-header [data-field="wifi_fechaCreacion"]');
                let field_wifiSSID = document.querySelector('.modal-body [data-field="wifi_SSID"]');
                let field_wifiIP = document.querySelector('.modal-body [data-field="wifi_direccionIP"]');
                let field_wifiLocation = document.querySelector('.modal-body [data-field="wifi_ubicacion"]');
                let field_wifiDepartment = document.querySelector('.modal-body [data-field="wifi_departamento"]');
                let field_MACFilter = document.querySelector('.modal-body [data-field="wifi_filtroMAC"]');

                // PASSWORD FIELDS
                field_wifiPassword = document.querySelector('.modal-body [data-field="wifi_clave"]');
                toggle_wifiPassword = document.querySelector('.modal-body #showPasswordToggle');



                fetch(wifiURL, {
                        method: 'GET',
                    })
                    .then(response => response.json())
                    .then(dataResponse => {
                        if (dataResponse) {
                            let createdAtDateTime = dataResponse.data.wifi_createdAt;
                            if (createdAtDateTime) {
                                let dateValue = new Date(createdAtDateTime.replace('  ', 'T'));
                                let dateOptions = {
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    hour12: true,
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit'
                                };
                                field_wifiCreatedAt.textContent = dateValue.toLocaleString('es-ES', dateOptions);
                            } else {
                                field_wifiCreatedAt.textContent = 'Fecha de Creación no Encontrada'
                            }
                            field_wifiSSID.textContent = dataResponse.data.wifi_SSID;

                            let realPassword = dataResponse.data.wifi_password || 'N/A';
                            field_wifiPassword.setAttribute('data-password', realPassword);
                            field_wifiPassword.textContent = '*'.repeat(realPassword.length);

                            field_wifiIP.textContent = dataResponse.data.wifi_ipDirection || 'N/A';
                            field_wifiLocation.textContent = dataResponse.data.location_name;
                            field_wifiDepartment.textContent = dataResponse.data.department_name;
                            field_MACFilter.textContent = dataResponse.data.wifi_isMACProtected == 1 ? 'Activado' : 'No Activado'
                        }
                    });

                toggle_wifiPassword.addEventListener('change', function() {
                    let passwordData = field_wifiPassword.getAttribute('data-password') || 'N/A';
                    if (this.checked) {
                        field_wifiPassword.textContent = passwordData;
                    } else {
                        field_wifiPassword.textContent = '*'.repeat(passwordData.length);
                    }
                });
            });
        });
    });
</script>