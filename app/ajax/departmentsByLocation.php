<?php
require_once '../../autoload.php'; // Ajusta el path según tu estructura
use app\controllers\wifiController;

$controller = new wifiController();
$controller->getDepartmentsByLocationController();