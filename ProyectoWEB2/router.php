<?php

require_once "./MVC/controllers/controllerHome.php";
require_once "./MVC/controllers/controllerInvertir.php";
require_once "./MVC/controllers/controllerBilletera.php";
require_once "./MVC/controllers/controllerSession.php";

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// leemos la accion que viene por parametro
$action = 'home'; // acción por defecto

if (!empty($_GET['action'])) { // si viene definida la reemplazamos
    $action = $_GET['action'];
}

// parsea la accion Ej: dev/juan --> ['dev', juan]
$params = explode('/', $action);

// determina que camino seguir según la acción
switch ($params[0]) {
    case 'home':
        $controllerHome = new controllerHome();
        $controllerHome -> showHome();
        break;
    case 'addActualizacion':
        $controllerHome = new controllerHome();
        $controllerHome -> addActualizacion();
        break;
    case 'deleteActualizacion':
        $controllerHome = new controllerHome();
        $controllerHome -> deleteActualizacion($params[1]);
        break;
    case 'invertir':
        $controllerInvertir = new controllerInvertir();
        $controllerInvertir -> showInvertir();
        break;
    case 'billetera':
        $controllerBilletera = new controllerBilletera();
        $controllerBilletera -> showBilletera();
        break;
    case 'login':
            $controllerLogin = new controllerSession();
            $controllerLogin -> showLogin();
            break;
    case 'loguearse':
            $controllerLogin = new controllerSession();
            $controllerLogin -> loguearse();
            break;
    case 'cerrarSesion':
       $controllerLogout = new controllerSession();
       $controllerLogout -> cerrarSesion();
            break;
    case 'AgregarPlan':
        $controllerInvertir = new controllerInvertir();
        $controllerInvertir -> addPlan();
        break;
    case 'MostrarPlanes':
        $controllerInvertir = new controllerInvertir();
        $controllerInvertir -> showPlanes();
        break;
    case 'DeletePlan':
        $controllerInvertir = new controllerInvertir();
        $controllerInvertir -> deletePlan($params[1]);
        break;
    case 'showEditPlan':
        $controllerInvertir = new controllerInvertir();
        $controllerInvertir -> showEditPlan($params[1]);
        break;
    case 'editPlan':
        $controllerInvertir = new controllerInvertir();
        $controllerInvertir -> editPlan();
        break;
    case 'precio':
        $controllerHome = new controllerHome();
        $controllerHome -> showConveccion();
        break;
    case 'infoPlan':
        $controllerInvertir = new controllerInvertir();
        $controllerInvertir -> showBuyPlan($params[1]);
        break;
    case 'comprarPlan':
        $controllerBilletera = new controllerBilletera();
        $controllerBilletera->comprarPlan();
        break;
    case 'deleteInversion':
        $controllerBilletera = new controllerBilletera();
        $controllerBilletera->deleteInversion($params[1]);
        break;
    case 'showEditInversion':
        $controllerBilletera = new controllerBilletera();
        $controllerBilletera->showEditInversion($params[1]);
        break;
    case 'editRealizado':
        $controllerBilletera = new controllerBilletera();
        $controllerBilletera->reEdit();
        break;
    default:
        echo('404 Page not found');
        break;
}
