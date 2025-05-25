<?php
    // ROUTES FOR URL REDIRECTION
    $routes = [
        'dashboard' => APP_URL . 'dashboard/',
        'users' => APP_URL . 'users/',
        'wifiList' => APP_URL . 'wifiList/',
        'locationsList' => APP_URL . 'locationsList/',
        'departmentsList' => APP_URL . 'departmentsList/',
    ];

    // AJAX REQUESTS
    $wifiAjaxRoutes = [
        'saveWifiPassword' => APP_URL . 'app/ajax/wifiPasswordsAjax.php',
        'getWifiPassword' => APP_URL . 'app/ajax/wifiPasswordsAjax.php',
        'deleteWifiPassword' => APP_URL . 'app/ajax/wifiPasswordsAjax.php',
        'updatedWifiPassword' => APP_URL . 'app/ajax/wifiPasswordsAjax.php',
        'updateWifiState' => APP_URL . 'app/ajax/wifiPasswordsAjax.php',
    ];
?>