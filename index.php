<?php
if ( ! session_id() ) @ session_start();
require('./vendor/autoload.php');
require('./classes/view.php');
require_once('./classes/DatabaseConnection.php');

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
} else {
    $controller = 'pages';
    $action     = 'home';
}

$sytemTemplate = 'views/layout.php';

ob_start();
require_once('routes.php');
$pageContent = ob_get_clean();

$_SESSION['sytem_last_url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

require_once($sytemTemplate);
