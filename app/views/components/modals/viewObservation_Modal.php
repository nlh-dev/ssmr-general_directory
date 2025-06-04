<!-- Large Modal -->
<div id="viewObservationInfo" tabindex="0" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full animate__animated animate__fadeInDownBig md:mx-2">
    <div class="relative w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative rounded-lg shadow-sm bg-gray-900">
            <!-- Modal header -->
            <div class="modal-header flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <div class="flex items-center">
                    <img src="<?= APP_URL ?>app/assets/logos/SSMR_LOGO-1.png" class="h-10 mr-3" alt="">
                    <div class="flex flex-col">
                        <h3 class="text-xl font-medium text-white">
                            Información de Observación
                        </h3>
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-white me-2"></div>
                            <p class="font-semibold text-white text-xs mr-1">Creada por:</p>
                            <span class="flex items-center bg-gray-100 text-gray-900 text-xs font-medium px-1.5 py-1 rounded-sm mt-1">
                                <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#users" />
                                </svg>
                                <p data-field="usuario"></p>
                            </span>
                            </p>
                            <p class="mx-2 text-white">/</p>
                            <span class="flex items-center bg-gray-100 text-gray-900 text-xs font-medium px-1.5 py-1 rounded-sm mt-1">
                                <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#calendarPen" />
                                </svg>
                                <p data-field="fecha_creacion"></p>
                            </span>
                        </div>
                    </div>
                </div>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="viewObservationInfo">
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
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#clipBoard" />
                        </svg>
                        Motivo:
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm ml-2">
                            <p data-field="observacion_motivo"></p>
                        </span>
                    </div>
                </div>
                <div class="">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#clipBoard" />
                        </svg>
                        Estado:
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm ml-2">
                            <p data-field="observacion_estado"></p>
                        </span>
                    </div>
                </div>
                <div class="">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#mailBox" />
                        </svg>
                        Tipo de Observación:
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center bg-green-100 text-green-900 text-xs font-medium px-2.5 py-1.5 rounded-sm hover:bg-green-900 hover:text-white transition duration-100 mt-2">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#mailBox" />
                            </svg>
                            <p data-field="observacion_tipo"></p>
                        </span>
                    </div>
                </div>
                <div class="">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#bellActive" />
                        </svg>
                        Prioridad:
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center bg-purple-100 hover:bg-purple-800 text-purple-800 hover:text-white text-xs font-medium px-2.5 py-1.5 rounded-sm transition duration-100">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#bellActive" />
                            </svg>
                            <p data-field="observacion_prioridad"></p>
                        </span>
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#clipboardList" />
                        </svg>
                        Descripción de Observación:
                    </div>
                    <div class="flex items-center mt-2">
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm">
                            <p data-field="observacion_descripcion"></p>
                        </span>
                    </div>
                </div>
                <hr class="col-span-2 text-gray-300">
                <div class="col-span-2">
                    <div class="flex items-center block text-sm font-medium text-gray-900">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#calendarPen" />
                        </svg>
                        Fecha de Actualización:
                        <span class="flex items-center bg-gray-900 text-white text-xs font-medium px-2.5 py-1.5 rounded-sm ml-2">
                            <p data-field="fecha_actualizacion"></p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function setObservationColors(type, prio, typeSpan, prioSpan) {
        // Limpiar clases previas
        typeSpan.className = "flex items-center text-xs font-medium px-2.5 py-1.5 rounded-sm transition duration-100";
        prioSpan.className = "flex items-center text-xs font-medium px-2.5 py-1.5 rounded-sm transition duration-100";

        // Colores para tipo
        switch (type.trim().toLowerCase()) {
            case "error":
                typeSpan.classList.add("bg-red-100", "text-red-900", "hover:bg-red-800", "hover:text-white");
                break;
            case "sugerencia":
                typeSpan.classList.add("bg-emerald-100", "text-emerald-900", "hover:bg-emerald-900", "hover:text-white");
                break;
            case "alerta":
                typeSpan.classList.add("bg-yellow-100", "text-yellow-900", "hover:bg-yellow-500", "hover:text-white");
                break;
            case "nota":
                typeSpan.classList.add("bg-indigo-100", "text-indigo-900", "hover:bg-indigo-800", "hover:text-white");
                break;
            default:
                typeSpan.classList.add("bg-gray-200", "text-gray-900");
        }

        // Colores para prioridad
        switch (prio.trim().toLowerCase()) {
            case "baja":
                prioSpan.classList.add("bg-green-100", "text-green-800", "hover:bg-green-800", "hover:text-white");
                break;
            case "media":
                prioSpan.classList.add("bg-teal-100", "text-teal-800", "hover:bg-teal-800", "hover:text-white");
                break;
            case "alta":
                prioSpan.classList.add("bg-yellow-100", "text-yellow-800", "hover:bg-yellow-500", "hover:text-white");
                break;
            case "critica":
                prioSpan.classList.add("bg-red-100", "text-red-800", "hover:bg-red-800", "hover:text-white");
                break;
            default:
                prioSpan.classList.add("bg-gray-100", "text-gray-800", "hover:bg-gray-800", "hover:text-white");
        }
    }

    function setObservationStateColor(isDone, stateSpan) {
        stateSpan.className = "flex items-center text-xs font-medium px-2.5 py-1.5 rounded-sm ml-2 transition duration-100";
        if (isDone == 1) {
            stateSpan.classList.add("bg-emerald-100", "text-emerald-900", "hover:bg-emerald-900", "hover:text-white");
        } else {
            stateSpan.classList.add("bg-red-100", "text-red-900", "hover:bg-red-800", "hover:text-white");
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-modal-target="viewObservationInfo"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const deviceId = this.getAttribute('data-observation-id');
                document.getElementById('observation_ID').value = deviceId;

                let fetchURL = '<?= APP_URL ?>app/ajax/observationsAjax.php?observationsModule=getObservationData&observation_ID=' + deviceId;

                // FIELDS FROM MODAL HEADER
                let field_UserID = document.querySelector('.modal-header [data-field="usuario"]');
                let field_CreatedAtDate = document.querySelector('.modal-header [data-field="fecha_creacion"]');

                // FIELDS FROM MODAL BODY
                let field_ObservationReason = document.querySelector('.modal-body [data-field="observacion_motivo"]');
                let field_ObservationState = document.querySelector('.modal-body [data-field="observacion_estado"]');
                let field_ObservationType = document.querySelector('.modal-body [data-field="observacion_tipo"]');
                let field_ObservationPrio = document.querySelector('.modal-body [data-field="observacion_prioridad"]');
                let field_ObservationDescription = document.querySelector('.modal-body [data-field="observacion_descripcion"]');
                let field_UpdateAtDate = document.querySelector('.modal-body [data-field="fecha_actualizacion"]');

                fetch(fetchURL, {
                        method: 'GET',
                    })
                    .then(response => response.json())
                    .then(dataResponse => {
                        if (dataResponse) {
                            field_UserID.textContent = dataResponse.user_fullName;
                            field_CreatedAtDate.textContent =
                                (dataResponse.observation_createdAtDate ? new Date(dataResponse.observation_createdAtDate + 'T' + dataResponse.observation_createdAtTime).toLocaleString('es-ES', {
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    hour12: true,
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit'
                                }) : '');
                            field_UpdateAtDate.textContent =
                                (dataResponse.observation_updatedAtDate ? new Date(dataResponse.observation_updatedAtDate + 'T' + dataResponse.observation_updatedAtTime).toLocaleString('es-ES', {
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    hour12: true,
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit'
                                }) : '');
                            field_ObservationDescription.textContent = dataResponse.observation_description || 'Sin Descripción';
                            field_ObservationReason.textContent = dataResponse.observation_reason;
                            field_ObservationType.textContent = dataResponse.observationType_name;
                            field_ObservationPrio.textContent = dataResponse.observationsPriority_name;
                            field_ObservationState.textContent = dataResponse.observation_isDone == 0 ? 'No Realizada' : 'Realizada'
                            setObservationStateColor(dataResponse.observation_isDone, field_ObservationState.parentElement);
                            setObservationColors(
                                dataResponse.observationType_name,
                                dataResponse.observationsPriority_name,
                                field_ObservationType.parentElement,
                                field_ObservationPrio.parentElement
                            );
                        }
                    });
            });
        });
    });
</script>