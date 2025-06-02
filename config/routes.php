<?php
    // ROUTES FOR URL REDIRECTION
    $routes = [
        'dashboard' => APP_URL . 'dashboard/',
        'users' => APP_URL . 'users/',
        'wifiList' => APP_URL . 'wifiList/',
        'deviceDeliveryList' => APP_URL . 'deviceDeliveryList/',
        'deviceHistoryList' => APP_URL . 'deviceHistoryList/',
        'deviceObservationsList' => APP_URL . 'deviceObservationsList/',
        'locationsList' => APP_URL . 'locationsList/',
        'departmentsList' => APP_URL . 'departmentsList/',
    ];

    // AJAX REQUESTS
    $AjaxRoutes = [
        'wifiPasswords' => APP_URL . 'app/ajax/wifiPasswordsAjax.php',
        'deliveryDevices' => APP_URL . 'app/ajax/deliveryDevicesAjax.php',
        'Observations' => APP_URL . 'app/ajax/observationsAjax.php'
    ];
?>