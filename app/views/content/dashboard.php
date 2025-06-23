<?php

use app\controllers\mainController;

$mainController = new mainController();

$totalWifiRegisters = $mainController->countDataController("wifi_directory");
$totalDevicesDelivered = $mainController->countConditionalDataController("devices", "device_isDelivered", 1);
$totalDevicesWithdrew = $mainController->countConditionalDataController("devices", "device_isDelivered", 0);
$totalObservations = $mainController->countConditionalDataController("observations", "observation_isDone", 0);
$totalDepartments = $mainController->countConditionalDataController("departments", "department_isEnable", 1);
$totalLocations = $mainController->countConditionalDataController("locations", "location_isEnable", 1);
$totalStorageTypes = $mainController->countConditionalDataController("storage_types", "storageType_isEnable", 1);
$totalStorageCategories = $mainController->countConditionalDataController("storage_categories", "storageCategory_isEnable", 1);

$dashboardModules = [
   [
      'section' => 'Contraseñas',
      'sectionIcon' => 'lockFile',
      'cards' => [
         [
            'title' => 'Directorio',
            'subtitle' => "$totalWifiRegisters Registro(s)",
            'description' => 'Ver Directorio de Contraseñas',
            'icon' => 'lockFile',
            'link' => $routes['wifiList'],
         ],
      ]
   ],
   [
      'section' => 'Dispositivos',
      'sectionIcon' => 'clipBoard',
      'cards' => [
         [
            'title' => 'Control de Entrega',
            'subtitle' => "$totalDevicesDelivered Entrega(s)",
            'description' => 'Ver Dispositivos Entregados',
            'icon' => 'adjustments',
            'link' => $routes['deviceDeliveryList'],
         ],
         [
            'title' => 'Historial',
            'subtitle' => "$totalDevicesWithdrew Registro(s)",
            'description' => 'Ver Historial de Entrega',
            'icon' => 'book',
            'link' => $routes['deviceHistoryList'],
         ],
         [
            'title' => 'Observaciones',
            'subtitle' => "$totalObservations Observaciones Pendientes",
            'description' => 'Ver Observaciones',
            'icon' => 'floppyDisk',
            'link' => $routes['deviceObservationsList'],
         ],
      ]
   ],
   [
      'section' => 'Inventario',
      'sectionIcon' => 'fileStorage',
      'cards' => [
         [
            'title' => 'Categorías',
            'subtitle' => "$totalStorageCategories Categoría(s)",
            'description' => 'Ver Lista de Categorías',
            'icon' => 'addCardFront',
            'link' => $routes['storageCategoryList'],
         ],
         [
            'title' => 'Tipos',
            'subtitle' => "$totalStorageTypes Registro(s)",
            'description' => 'Ver Existencias de Inventario',
            'icon' => 'addCardBack',
            'link' => $routes['storageTypesList'],
         ],
         [
            'title' => 'Existencias',
            'subtitle' => "(X) Registro(s)",
            'description' => 'Ver Existencias de Inventario',
            'icon' => 'pencil',
            'link' => '#',
         ],
         [
            'title' => 'Movimientos',
            'subtitle' => "(X) Movimientos",
            'description' => 'Ver Lista de Movimientos',
            'icon' => 'codeFork',
            'link' => '#',
         ],
         [
            'title' => 'Historial',
            'subtitle' => "(X) Movimientos Realizados",
            'description' => 'Ver Historial de Movimientos',
            'icon' => 'floppyDisk',
            'link' => '#',
         ],
      ]
   ],
   [
      'section' => 'Opciones',
      'sectionIcon' => 'tools',
      'cards' => [
         [
            'title' => 'Departamentos',
            'subtitle' => "$totalDepartments Departamento(s)",
            'description' => 'Ver Lista de Departamentos',
            'icon' => 'departments',
            'link' => $routes['departmentsList'],
         ],
         [
            'title' => 'Ubicaciones',
            'subtitle' => "$totalLocations Ubicacion(es)",
            'description' => 'Ver Lista de Ubicaciones',
            'icon' => 'tagLocation',
            'link' => $routes['locationsList'],
         ],
      ]
   ],
];
?>
<!-- CONTENT GRIDS -->
<div class="p-4 sm:ml-64 content-main transition-all duration-100 flex flex-col h-screen">
   <div class="p-2 mt-10 flex-1">
      <div class="my-4">
         <?php require_once "./app/views/components/breadcrumbs/dashboardBreadcrumb.php" ?>
         <hr class="my-4 border-gray-300">
      </div>
      <div class="grid grid-cols-1 gap-5">
         <?php foreach ($dashboardModules as $module): ?>
            <div class="rounded-lg border border-gray-300 bg-white p-4">
               <div class="flex items-center mb-4">
                  <svg class="w-6 h-6 text-gray-500 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                     <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#<?= $module['sectionIcon'] ?>" />
                  </svg>
                  <h1 class="font-bold text-gray-500"><?= $module['section'] ?></h1>
               </div>
               <div class="grid lg:grid-cols-3 xl:grid-cols-3 gap-5">
                  <?php foreach ($module['cards'] as $card): ?>
                     <a href="<?= $card['link'] ?>">
                        <div class="p-6 bg-gray-900 rounded-lg hover:bg-gray-800 transition duration-100">
                           <div class="flex justify-between">
                              <div>
                                 <h1 class="mb-2 text-xl font-bold tracking-tight text-white"><?= $card['title'] ?></h1>
                                 <h1 class="mb-2 text-md font-semibold text-gray-500"><?= $card['subtitle'] ?></h1>
                              </div>
                              <svg class="w-10 h-10 text-white items-start" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                 <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#<?= $card['icon'] ?>" />
                              </svg>
                           </div>
                           <div class="flex items-center justify-between">
                              <p class="font-medium text-white"><?= $card['description'] ?></p>
                              <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                 <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#arrowRight" />
                              </svg>
                           </div>
                        </div>
                     </a>
                  <?php endforeach; ?>
               </div>
            </div>
         <?php endforeach; ?>
      </div>
   </div>
</div>