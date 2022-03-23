<?php
// reviews controller

session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicle-model.php';
require_once '../model/uploads-model.php';
require_once '../library/functions.php';
require_once '../model/reviws-model.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = createNav($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case "add":
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $clientId = $_SESSION['clientData']['clientId'];

        if (empty($invId) || empty($reviewText) || empty($clientId)){
            $_SESSION['message'] = "error";
            echo $invId, $clientId, $reviewText;

            //header ("Location: /phpmotors/vehicles/index.php?action=displayVehicle&invId=". $invId);
            break;
        }
        else{
            echo $invId, $clientId, $reviewText;
            $result = addReview($invId, $clientId, $reviewText);
        }

        if ($result){
            header("Location: /phpmotors/vehicles/index.php?action=displayVehicle&invId=" . $invId);
            break;
        }

        break;
    case "edit":
        include "../view/edit-review.php";
        break;
    case "update":
        break;
    case "confirm-delete":
        include "../view/delete-review.php";
        break;
    case "delete":
        break;
    default:
        if ($_SESSION['loggedin'] == TRUE){
            include "../view/admin.php";
        }
        else{
            header("Location:/phpmotors/");
        }
        break;

}