<?php
    include_once "./autoload.php";
    include_once "./config/app.php";
    include_once "./config/routes.php";
    include_once "./app/views/includes/session_start.php";
    
    if (isset($_GET['views'])) {
        $url = explode("/", $_GET['views']);
    } else {
        $url = ["login"];
    }
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once "./app/views/includes/head.php" ?>
</head>

<body>

<?php
    use app\controllers\viewsController;
    use app\controllers\wifiController;

    $instaceWifi = new wifiController();

    $viewsController = new viewsController();
    $obtainViews = $viewsController -> obtainViewsController($url[0]);

    if ($obtainViews == "login" || $obtainViews == "404") {
        require_once "./app/views/content/".$obtainViews.".php";
    } else {
        require_once $obtainViews;
        require_once "./app/views/layout/sidebar.php";
    }

    require_once "./app/views/includes/scripts.php"
?>

</body>

</html>