<?php
    // ROUTES FOR URL REDIRECTION
    $routes = [
        'dashboard' => APP_URL . 'dashboard/',
        'users' => APP_URL . 'users/',
        'wifiList' => APP_URL . 'wifiList/',
        'switchList' => APP_URL . 'switchList/',
        'switchPortList' => APP_URL . 'switchPortList/',
        'switchBrandList' => APP_URL . 'switchBrandList/',
        'deviceDeliveryList' => APP_URL . 'deviceDeliveryList/',
        'deviceHistoryList' => APP_URL . 'deviceHistoryList/',
        'observationsList' => APP_URL . 'observationsList/',
        'locationsList' => APP_URL . 'locationsList/',
        'departmentsList' => APP_URL . 'departmentsList/',
        'storageList' => APP_URL . 'storageList/',
        'storageCategoryList' => APP_URL . 'storageCategoryList/',
        'storageTypesList' => APP_URL . 'storageTypesList/',
        'storageMovementsList' => APP_URL . 'storageMovementsList/',
        'storageHistoryList' => APP_URL . 'storageHistoryList/',
    ];

    // AJAX REQUESTS
    $AjaxRoutes = [
        'wifiPasswords' => APP_URL . 'app/ajax/wifiPasswordsAjax.php',
        'switches' => APP_URL . 'app/ajax/switchesAjax.php',
        'deliveryDevices' => APP_URL . 'app/ajax/deliveryDevicesAjax.php',
        'Observations' => APP_URL . 'app/ajax/observationsAjax.php',
        'locations' => APP_URL . 'app/ajax/locationsAjax.php',
        'departments' => APP_URL . 'app/ajax/departmentsAjax.php',
        'storage' => APP_URL . 'app/ajax/storageAjax.php',
    ];
?>