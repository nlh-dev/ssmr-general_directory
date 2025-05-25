<?php
use app\controllers\wifiController;
$wifiController = new wifiController();
$totalContraseñas = 0;

try {
    $dbCountRequest = $wifiController->dbRequestExecute("SELECT COUNT(*) as total FROM wifi_directory");
    $totalContraseñas = $dbCountRequest->fetchColumn();
} catch (\Exception $e) {
    $totalContraseñas = 0;
}
?>
<!-- CONTENT GRIDS -->
<div class="p-4 sm:ml-64 content-main transition-all duration-100 flex flex-col h-screen">
   <div class="p-2 mt-10 flex-1">
      <div class="my-4">
         <?php require_once "./app/views/components/breadcrumbs/dashboardBreadcrumb.php" ?>
         <hr class="my-4 border-gray-300">
      </div>
      <div class="grid sm:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5">
         <div class="p-6 bg-gray-900 rounded-lg hover:bg-gray-800 transition duration-100">
            <a href="<?= $routes['wifiList']?>">
               <div class="flex justify-start items-center">
                  <svg class="w-8 h-8 text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                     <use xlink:href="<?= APP_URL ?>/app/assets/svg/FlowbiteIcons.sprite.svg#lockFile" />
                  </svg>
                  <h1 class="mb-2 text-3xl font-bold tracking-tight text-white">
                     Contraseñas
                  </h1>
               </div>
               <p class="font-bold text-gray-200">Total de Registros: <?= $totalContraseñas ?></p>
            </a>
         </div>

      </div>
   </div>
</div>