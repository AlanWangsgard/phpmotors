<?php
// this is the vehicles controller for phpmotors

// creat session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

require_once '../model/vehicle-model.php';

require_once '../library/functions.php';

require_once '../model/uploads-model.php';

require_once '../model/reviws-model.php';


// Get the array of classifications
$classifications = getClassifications();

$navList = createNav($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'addClassification':
        $classificationName = filter_input(INPUT_POST, 'classificationName');

        // Check for missing data
        if (empty($classificationName)) {
            $_SESSION['message'] = '<p class="serverMessage">Please enter a classification name to be added.</p>';
            include '../view/add-classification.php';
            exit;
        }

        // Send the data to the model
        $regOutcome = addClass($classificationName);

        // Check and report the result
        if ($regOutcome === 1) {
            header("Refresh:0");
            include '../view/vehicle-man.php';
            exit;
        } else {
            $_SESSION['message'] = "<p class='serverMessage'>Classification not added</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;
    case 'addVehicletoInv':
        $classificationId = trim(filter_input(INPUT_POST, "class", FILTER_SANITIZE_STRING));
        $make = trim(filter_input(INPUT_POST, 'make', FILTER_SANITIZE_STRING));
        $model = trim(filter_input(INPUT_POST,'model', FILTER_SANITIZE_STRING));
        $description = trim(filter_input(INPUT_POST,'description', FILTER_SANITIZE_STRING));
        $image = trim(filter_input(INPUT_POST,'imagePath', FILTER_SANITIZE_STRING));
        $thumbnail = trim(filter_input(INPUT_POST,'thumbnailPath', FILTER_SANITIZE_STRING));
        $price = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ALLOW_FRACTION));
        $stock = trim(filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT));
        $color = trim(filter_input(INPUT_POST,'color', FILTER_SANITIZE_STRING));

        // Check for missing data
        if (empty($classificationId) || empty($make) || empty($model) || empty($description) || empty($image) || empty($thumbnail) || empty($price) || empty($stock) || empty($color)) {
            $_SESSION['message'] = '<p class="serverMessage">Please fill out all feilds for a vehicle to be added.</p>';
            include '../view/add-vehicle.php';
            exit;
        }

        // Send the data to the model
        $regOutcome = addVehicleInv($classificationId,$make, $model, $description, $image, $thumbnail, $price, $stock, $color);

        // Check and report the result
        if ($regOutcome === 1) {
            $_SESSION['message'] = "<p class='serverMessage'>Vehicle added</p>";
            $classificationList = buildClassificationList($classifications);
            include '../view/vehicle-man.php';
            exit;
        } else {
            $_SESSION['message'] = "<p class='serverMessage'>Vehicle not added</p>";
            include '../view/add-vehicle.php';
            exit;
        }
        break;

    case 'addClass':
        include "../view/add-classification.php";
        break;
    case 'addVehicle':
        include "../view/add-vehicle.php";
        break;
    case 'getInventoryItems':
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray);
        // echo json_encode("hello");
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        exit;
        break;
    case 'updateVehicle':
        $classificationId = trim(filter_input(INPUT_POST, "classificationId", FILTER_SANITIZE_STRING));
        $make = trim(filter_input(INPUT_POST, 'make', FILTER_SANITIZE_STRING));
        $model = trim(filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING));
        $description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
        $image = trim(filter_input(INPUT_POST, 'imagePath', FILTER_SANITIZE_STRING));
        $thumbnail = trim(filter_input(INPUT_POST, 'thumbnailPath', FILTER_SANITIZE_STRING));
        $price = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ALLOW_FRACTION));
        $stock = trim(filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT));
        $color = trim(filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        if (
            empty($classificationId) || empty($make) || empty($model)
            || empty($description) || empty($image) || empty($thumbnail)
            || empty($price) || empty($stock) || empty($color)
        ) {
            $_SESSION['message'] = '<p> Please complete all information for the item! Double check the classification of the item.</p>';
            include '../view/vehicle-update.php';
            exit;
        }

        $updateResult = updateVehicle($make, $model, $description, $image, $thumbnail, $price, $stock, $color, $classificationId, $invId);
        if ($updateResult) {
            $message = "<p class='notice'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $_SESSION['message'] = "<p class='notice'>Error. the $invMake $invModel was not updated.</p>";
            include '../view/vehicle-update.php';
            exit;
        }
        break;
    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;
        break;
    case 'deleteVehicle':
        $invMake = filter_input(INPUT_POST, 'make', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error: $invMake $invModel was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
        $vehicles = getVehiclesByClassification($classificationName);
        if (!count($vehicles)) {
            $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        unset($_SESSION['message']);
        include '../view/classification.php';
        break;
    case 'displayVehicle':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_STRING);

        if (empty($invId)){
            $_SESSION['Vmessage'] = "Server could not get Vehicle Id";
            include '../view/vehicle-detail.php';
             break;
        }else{
            $vehicle = getInvItemInfo($invId);
            if (empty($vehicle)) {
                $_SESSION['Vmessage'] = "No vehicle was found";
                include '../view/vehicle-detail.php';
                break;
            }
            
        }
        $tnImg = getThumbnail($invId);
        $vehicleImgs =  wrapThumbnails($tnImg);
        $vehicleInfo = buildVehicleInfo($vehicle);

        $reviewlist = getReviewsByInvId($invId);

        if (empty($reviewlist)){
            $reviews = "<p>Be the first to leave a review!</p>";
        }else{
        $reviews = buildReviewView($reviewlist);
        }
        include '../view/vehicle-detail.php';
        break;
    default:
        $classificationList = buildClassificationList($classifications);
        include '../view/vehicle-man.php';
        break;
        exit;
}
