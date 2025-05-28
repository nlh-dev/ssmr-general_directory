<?php

use app\controllers\dashboardController;

$dashboardController = new dashboardController();
$totalWifiRegisters = $dashboardController->countWifiRegistersController();
$totalDevicesDelivered = $dashboardController->countDevicesDeliveredController();
$totalDevicesWithdrew = $dashboardController->countWithdrewDevicesController();

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
            'subtitle' => '(X) Observaciones',
            'description' => 'Ver Observaciones',
            'icon' => 'floppyDisk',
            'link' => $routes['deviceObservationsList'],
         ],
      ]
   ]
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