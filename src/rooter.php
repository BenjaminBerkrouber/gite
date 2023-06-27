<?php

include_once('model/admin/base/base.php');

// Récupérer l'URL demandée
$path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");

if (file_exists(__DIR__.'/'.$path)) {
    // Si c'est le cas, renvoyez ce fichier
    return false;
}

// Définir les routes et les actions correspondantes
$routes = [
    '' => 'HomeController',

    'admin/dashboard' => 'adminDashBoard',
    'admin/login' => 'adminLogin',

    'admin/user' => 'adminUserManagement',
    'admin/user/create' => 'createUser',
    'admin/user/update' => 'updateUser',
    'admin/user/delete' => 'deleteUser',

    'admin/gite' => 'adminGiteManagement',
    'admin/gite/create' => 'createGite',
    'admin/gite/update' => 'updateGite',
    'admin/gite/delete' => 'deleteGite',

    'admin/reservation' => 'adminReservationManagement',
    'admin/reservation/update' => 'updateReservation',
    'admin/reservation/delete' => 'deleteReservation',
    // Ajoutez vos routes supplémentaires ici
];

// Vérifier si la route demandée existe
if (array_key_exists($path, $routes)) {
    $action = $routes[$path];

    // Appeler l'action correspondante
    if (function_exists($action)) {
        call_user_func($action);
    } else {
        // Gérer le cas où l'action n'existe pas
       require('404.php');
    }
} else {
    // Gérer le cas où la route demandée n'existe pas
    require('404.php');
}

// Actions correspondantes aux routes

function HomeController(){
    require('index.php');
}

function adminUserManagement()
{
    session_start();
    // vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['username'])) {
        header('Location: /admin/login');
        exit();
    }

    require('model/admin/dao_admin_user.php');
    $users = get_all_users();
    require('model/admin/user.php');
}

function adminDashBoard(){
    require('dashboard.php');
}

function adminLogin(){
    require('adminLogin.php');
}

function createUser()
{
    require('model/admin/dao_admin_user.php');
    require('controller/admin/user/create_user.php');

}

function updateUser()
{
    require('model/admin/dao_admin_user.php');
    require('controller/admin/user/update_user.php');
}

function deleteUser()
{
    require('model/admin/dao_admin_user.php');
    require('controller/admin/user/delete_user.php');
}

function adminGiteManagement(){
    require('model/admin/dao_admin_gite.php');
    $gites = get_all_gites();
    require('model/admin/gite.php');
}

function createGite(){
    require('model/admin/dao_admin_gite.php');
    require('controller/admin/gite/create_gite.php');
}

function updateGite(){
    require('model/admin/dao_admin_gite.php');
    require('controller/admin/gite/update_gite.php');
}

function deleteGite(){
    require('model/admin/dao_admin_gite.php');
    require('controller/admin/gite/delete_gite.php');
}


function adminReservationManagement(){
    require('model/admin/dao_admin_reservation.php');
    require('model/admin/reservation.php');
}

function updateReservation(){
    require('model/admin/dao_admin_reservation.php');
    require('controller/admin/reservation/update_reservation.php');

}

function deleteReservation(){
    require('model/admin/dao_admin_reservation.php');
    require('controller/admin/reservation/delete_reservation.php');
}

$pageActive = "acceuil";

?>