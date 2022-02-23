<?php
// this is the main controller for phpmotors

// creat session
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';

require_once 'library/functions.php';


// Get the array of classifications
$classifications = getClassifications();

$navList = createNav($classifications);

// // Check if the firstname cookie exists, get its value
// if (isset($_SESSION['clientData']['clientFirstname'])) {
//     $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
// }

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'template':
        include "view/template.php";
        break;
    case "LogOut":
        session_unset();
        session_destroy();
        include 'view/home.php';
        exit;
    default:
        include 'view/home.php';
}

