<?php

require_once "./app/views/components/modals/devices/addDeviceDelivery_Modal.php";
require_once "./app/views/components/modals/devices/viewDeviceDelivery_Modal.php";
require_once "./app/views/components/modals/devices/editDeviceDelivery_Modal.php";
require_once "./app/views/components/modals/devices/withdrawDeliveredDevice_Modal.php";

?>

<!-- CONTENT GRIDS -->
<div class="p-4 sm:ml-64 content-main transition-all duration-100">
    <div class="p-2 mt-10">
        <div class="my-4">
            <?php require_once "./app/views/components/breadcrumbs/deviceDeliveryListBreadcrumb.php" ?>
            <hr class="my-4 border-gray-300">
        </div>

        <div class="flex items-center justify-between text-gray-800 pb-4">
            <div>
                <h1 class="text-lg font-semibold text-left">
                    Control de Entrega de Dispositivos
                    <p class="mt-1 text-sm font-normal text-gray-400">Listado de Dispositivos Entregados por el Departamento de Informática del Hospital Madre Rafols.</p>
                </h1>
            </div>
            <div class="">
                <button data-modal-target="addDeviceDelivery" data-modal-toggle="addDeviceDelivery" class="flex items-center text-white bg-gray-900 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-100" type="button">
                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                        <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#addSymbol" />
                    </svg>
                    Añadir Entrega
                </button>
            </div>
        </div>

        <?php

        use app\controllers\devicesController;

        $deviceController = new devicesController();

        echo $deviceController->deliveredDevicesListController($url[1], 10, $url[0], "");

        ?>

    </div>
</div>