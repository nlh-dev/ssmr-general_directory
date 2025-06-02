<?php
require_once "./app/views/components/modals/viewDeviceWithdrew_Modal.php";
require_once "./app/views/components/modals/editDeviceWithdrew_Modal.php";
?>

<!-- CONTENT GRIDS -->
<div class="p-4 sm:ml-64 content-main transition-all duration-100">
    <div class="p-2 mt-10">
        <div class="my-4">
            <?php require_once "./app/views/components/breadcrumbs/deviceWithdrawListBreadcrumb.php" ?>
            <hr class="my-4 border-gray-300">
        </div>

        <div class="flex items-center justify-between text-gray-800 pb-4">
            <div>
                <h1 class="text-lg font-semibold text-left">
                    Historial de Entrega de Dispositivos
                    <p class="mt-1 text-sm font-normal text-gray-400">Historial de Dispositivos Entregados por el Departamento de Informática del Sistema de Salud Madre Rafols.</p>
                </h1>
            </div>
        </div>

        <?php

        use app\controllers\devicesController;

        $deviceController = new devicesController();

        echo $deviceController->withdrewDevicesListController($url[1], 10, $url[0], "");

        ?>
    </div>
</div>