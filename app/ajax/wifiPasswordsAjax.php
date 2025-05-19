<?php
    require_once "../../config/app.php";
    require_once "../views/includes/session_start.php";
    require_once "../../autoload.php";

    use app\controllers\wifiController;

    if (isset($_POST['wifiModule'])) {
        $wifiInstance = new wifiController();

        if ($_POST['wifiModule'] == 'saveWifiPassword') {
            echo $wifiInstance -> saveWifiPasswordController();
        }
    }