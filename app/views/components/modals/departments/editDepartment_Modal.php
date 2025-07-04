<?php
use app\controllers\mainController;
$mainController = new mainController();
$showLocationsData = $mainController->getDataController('locations', 'location_name', 'ASC');
?>
<div id="editDepartment" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full animate__animated animate__fadeInDownBig md:mx-2">
    <div class="relative w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative rounded-lg shadow-sm bg-gray-900">
            <!-- Modal header -->
            <div class="flex items-center p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <div class="flex items-center">
                    <img src="<?= APP_URL ?>app/assets/logos/SSMR_LOGO-1.png" class="h-12 mr-3" alt="">
                    <div class="flex-col">
                        <h3 class="text-xl font-medium text-white">Información de
                            <span id="department_name" class="text-xl font-medium text-white"></span>
                        </h3>
                        <div class="flex items-center gap-x-1">
                            <span class="text-xs font-medium px-1.5 py-0.5 rounded-sm bg-yellow-900 text-yellow-300">Editando</span>
                            <div class="flex items-center">
                                <div class="h-2.5 w-2.5 rounded-full bg-white me-1"></div>
                                <span class="text-white font-semibold text-xs me-1">Creado el</span>
                                <span id="department_createdAt" class="text-white font-semibold text-xs"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editDepartment">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?= $AjaxRoutes['departments'] ?>" class="AjaxForm" method="POST" autocomplete="OFF">
                <input type="hidden" name="departmentModule" id="departmentModule" value="editDepartment">
                <input type="hidden" name="department_ID" id="department_ID" value="">
                <div class="p-4 bg-white grid grid-cols-1 gap-5">
                    <div class="">
                        <div class="flex items-center justify-between">
                            <label for="departmentName" class="flex items-center block text-sm font-medium text-gray-900">
                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                                </svg>
                                Nombre del Departamento
                            </label>
                            <p class="font-bold text-red-600">*</p>
                        </div>
                        <div class="relative my-2">
                            <input type="text" id="departmentName" name="departmentName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ubicación....">
                        </div>
                    </div>
                    <div class="">
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
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="w-full flex items-center justify-end p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b">
                    <button data-modal-hide="editDepartment" type="button" class="AjaxForm px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 mr-3">
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
        // También puedes limpiar al abrir el modal si lo deseas
        document.querySelectorAll('[data-modal-target="editDepartment"]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                clearModal();
            });
        });

        function clearModal() {
            const form = document.querySelector('#editDepartment form');
            if (!form) return;
            form.reset();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-modal-target="editDepartment"]').forEach(function(editDepartmentButton) {
            editDepartmentButton.addEventListener('click', function() {
                const departmentId = this.getAttribute('data-department-id');
                document.getElementById('department_ID').value = departmentId;

                let field_departmentName = document.querySelector('#editDepartment #department_name');
                let field_departmentCreatedAt = document.querySelector('#editDepartment #department_createdAt');
                let inputDepartmentName = document.querySelector('#editDepartment #departmentName');
                let inputLocationsName = document.querySelector('#editDepartment #locations');
                let departmentURL = "<?= APP_URL ?>app/ajax/departmentsAjax.php?departmentModule=getDepartmentData&department_ID=" + departmentId;
                let formData = new FormData();
                formData.append('department_ID', departmentId);

                fetch(departmentURL, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(dataResponse => {
                        field_departmentCreatedAt.textContent =
                                (dataResponse.department_createdAtDate ? new Date(dataResponse.department_createdAtDate + 'T' + dataResponse.department_createdAtTime).toLocaleString('es-ES', {
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    hour12: true,
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit'
                                }) : 'Fecha y Hora no encontrada');
                        field_departmentName.textContent = dataResponse.department_name;
                        inputDepartmentName.value = dataResponse.department_name;
                        inputLocationsName.value = dataResponse.department_location_ID;
                    }).catch(err => {
                        console.error(err);
                    });
            });
        });
    });
</script>