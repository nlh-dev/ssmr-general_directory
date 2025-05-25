<?php

use app\controllers\dashboardController;

$dashboardController = new dashboardController();
$totalWifiRegisters = $dashboardController->countWifiRegistersController();

$dashboardModules = [
   [
      'section' => 'Modulo: Contraseñas',
      'cards' => [
         [
            'title' => 'Directorio',
            'subtitle' => "Total: {$totalWifiRegisters} Registros",
            'description' => 'Ver Directorio de Contraseñas',
            'icon' => 'lockFile',
            'link' => $routes['wifiList'],
         ],
      ]
   ],
   [
      'section' => 'Modulo: Dispositivos',
      'cards' => [
         [
            'title' => 'Control de Entrega',
            'subtitle' => 'Total: (X) Registros',
            'description' => 'Ver Dispositivos Entregados',
            'icon' => 'clipBoard',
            'link' => '#',
         ],
         [
            'title' => 'Historial',
            'subtitle' => 'Total: (X) Registros',
            'description' => 'Ver Historial de Entrega',
            'icon' => 'clipBoard',
            'link' => '#',
         ],
         [
            'title' => 'Observaciones',
            'subtitle' => 'Total: (X) Registros',
            'description' => 'Ver Observaciones',
            'icon' => 'clipBoard',
            'link' => '#',
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
               <h1 class="mb-2 font-bold text-gray-500"><?= $module['section'] ?></h1>
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