<?php
    // DEPARTMENTS MODALS
    require_once "./app/views/components/modals/departments/addDepartment_Modal.php";
    require_once "./app/views/components/modals/departments/editDepartment_Modal.php";
    // LOCATIONS MODAL
    require_once "./app/views/components/modals/locations/addLocation_Modal.php";

?>

<div class="p-4 sm:ml-64 content-main transition-all duration-100">
    <div class="p-2 mt-10">
        <div class="my-4">
            <?php require_once "./app/views/components/breadcrumbs/wifiListBreadcrumb.php" ?>
            <hr class="my-4 border-gray-300">
        </div>

        <div class="flex items-center justify-between text-gray-800 pb-4">
            <div>
                <h1 class="text-lg font-semibold text-left">
                    Departamentos
                    <p class="mt-1 text-sm font-normal text-gray-400">Listado de los Departamentos pertenecientes al Hospital Madre Rafols.</p>
                </h1>
            </div>
            <div class="flex items-center gap-x-2">
                <div>
                    <button data-popover-target="addLocationsPopover" data-popover-placement="top" data-modal-target="addLocation" data-modal-toggle="addLocation" class="flex items-center text-white bg-gray-900 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 text-center transition duration-100" type="button">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>app/assets/svg/FlowbiteIcons.sprite.svg#tagLocation" />
                        </svg>
                    </button>
                    <div data-popover id="addLocationsPopover" role="tooltip"
                        class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                        <div class="px-3 py-2 bg-gray-900 rounded-lg">
                            <h3 class="font-semibold text-white text-xs">Añadir Ubicación</h3>
                        </div>
                        <div data-popper-arrow bg-gray-900></div>
                    </div>
                </div>
                <div class="">
                    <button data-modal-target="addDepartment" data-modal-toggle="addDepartment" class="flex items-center text-white bg-gray-900 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-100" type="button">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>app/assets/svg/FlowbiteIcons.sprite.svg#addSymbol" />
                        </svg>
                        Añadir Departamento
                    </button>
                </div>
            </div>
        </div>


        <?php

        use app\controllers\departmentsController;

        $departmentsController = new departmentsController();

        echo $departmentsController->departmentsListController($url[1], 10, $url[0], "");

        ?>
    </div>
</div>