<?php

use app\controllers\mainController;

$mainController = new mainController;

$showObservationsPriorityData = $mainController->getObservationsPriorityController();
$showObservationsTypeData = $mainController->getObservationsTypeController();
?>


<!-- Large Modal -->
<div id="addObservation" tabindex="0" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full animate__animated animate__fadeInDownBig md:mx-2">
    <div class="relative w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative rounded-lg shadow-sm bg-gray-900">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <img src="<?= APP_URL ?>app/assets/logos/SSMR_LOGO-1.png" class="h-10 mr-3" alt="">
                <h3 class="text-xl font-medium text-white">
                    Añadir Observacion
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="addObservation">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?= $AjaxRoutes['Observations'] ?>" class="AjaxForm" method="POST" autocomplete="OFF">
                <input type="hidden" name="observationsModule" id="observationsModule" value="saveObservations">
                <div class="p-4 bg-white grid grid-cols-1 md:grid-cols-4 gap-5">
                    <div class="col-span-2">
                        <label for="observationReason" class="flex items-center block text-sm font-medium text-gray-900">
                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#userSettings" />
                            </svg>
                            Motivo
                        </label>
                        <div class="relative my-2">
                            <input type="text" id="observationReason" name="observationReason" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Recibido por....">
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="observationDate" class="flex items-center block text-sm font-medium text-gray-900">
                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#calendarPen" />
                            </svg>
                            Fecha de Creación
                        </label>
                        <div class="relative my-2">
                            <input type="date" id="observationDate" name="observationDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="observationType" class="flex items-center block text-sm font-medium text-gray-900">
                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#mailBox" />
                            </svg>
                            Tipo de Observación
                        </label>
                        <div class="relative my-2">
                            <select id="observationType" name="observationType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected>Seleccione....</option>
                                <?php foreach ($showObservationsTypeData as $key => $TypeValue) { ?>
                                    <option value="<?= $TypeValue['observationType_ID'] ?>">
                                        <?= $TypeValue['observationType_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <label for="observationPriority" class="flex items-center block text-sm font-medium text-gray-900">
                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#bellActive" />
                            </svg>
                            Prioridad
                        </label>
                        <div class="relative my-2">
                            <select id="observationPriority" name="observationPriority" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected>Selecione.....</option>
                                <?php foreach ($showObservationsPriorityData as $key => $PriorityValue) { ?>
                                    <option value="<?= $PriorityValue['observationsPriority_ID'] ?>">
                                        <?= $PriorityValue['observationsPriority_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="md:col-span-4">
                        <label for="observationDescription" class="flex items-center block mb-2 text-sm font-medium text-gray-900">
                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#clipboardList" />
                            </svg>
                            Descripción de Observación
                        </label>
                        <textarea id="observationDescription" name="observationDescription" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Descripción..."></textarea>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="w-full flex items-center justify-end p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b">
                    <button data-modal-hide="addObservation" type="button" class="AjaxForm px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 mr-3">
                        <svg class="w-5 h-5 text-white me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Cancelar
                    </button>
                    <button type="submit" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 transition duration-100">
                        <svg class="w-5 h-5 text-white me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>