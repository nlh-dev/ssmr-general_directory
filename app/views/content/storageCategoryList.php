<?php
require_once "./app/views/components/modals/addStorageCategory_Modal.php";

?>

<!-- CONTENT GRIDS -->
<div class="p-4 sm:ml-64 content-main transition-all duration-100">
    <div class="p-2 mt-10">
        <div class="my-4">
            <?php require_once "./app/views/components/breadcrumbs/storageTypes_CategoriesBreadcrumb.php" ?>
            <hr class="my-4 border-gray-300">
        </div>

        <div class="flex items-center justify-between text-gray-800 pb-4">
            <div>
                <h1 class="text-lg font-semibold text-left">
                    Lista de Categorías
                    <p class="mt-1 text-sm font-normal text-gray-400">Listado de Categorías de Articulos del Inventario de Informática del Hospital Madre Rafols.</p>
                </h1>
            </div>
            <div class="flex items-center space-x-4">
                <div>
                    <button data-popover-target="addType" data-popover-placement="bottom" data-modal-target="addStock" data-modal-toggle="addStock" class="flex items-center text-white bg-gray-900 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2 text-center transition duration-100" type="button">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>app/assets/svg/FlowbiteIcons.sprite.svg#addCardBack" />
                        </svg>
                    </button>
                    <div data-popover id="addType" role="tooltip"
                        class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-gray-900 rounded-lg opacity-0">
                        <div class="px-3 py-2 bg-gray-900 rounded-lg">
                            <h3 class="font-semibold text-white text-xs">Añadir Tipo</h3>
                        </div>
                        <div data-popper-arrow bg-gray-900></div>
                    </div>
                </div>
                <div>
                    <button data-popover-target="categoryList" data-popover-placement="bottom" data-modal-target="addStorageCategory" data-modal-toggle="addStorageCategory" class="flex items-center text-white bg-gray-900 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2 text-center transition duration-100" type="button">
                        <svg class="w-6 h-6 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                            <use xlink:href="<?= APP_URL ?>app/assets/svg/FlowbiteIcons.sprite.svg#addCardFront" />
                        </svg>
                        Añadir Categoría
                    </button>
                </div>
            </div>
        </div>

        <?php

        use app\controllers\storageController;

        $storageController = new storageController();

        echo $storageController->storageCategoryListController($url[1], 10, $url[0], "");

        ?>
    </div>
</div>