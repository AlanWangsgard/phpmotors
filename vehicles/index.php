<?php
// this is the main controller for phpmotors

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

require_once '../model/vehicle-model.php';

require_once '../library/functions.php';


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
            $message = '<p class="serverMessage">Please enter a classification name to be added.</p>';
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
            $message = "<p class='serverMessage'>Classification not added</p>";
            include '../view/add-classification.php';
            exit;
        }
        break;
    case 'addVehicletoInv':
        $carclass = trim(filter_input(INPUT_POST, "class", FILTER_SANITIZE_STRING));
        $make = trim(filter_input(INPUT_POST, 'make', FILTER_SANITIZE_STRING));
        $model = trim(filter_input(INPUT_POST,'model', FILTER_SANITIZE_STRING));
        $description = trim(filter_input(INPUT_POST,'description', FILTER_SANITIZE_STRING));
        $image = trim(filter_input(INPUT_POST,'imagePath', FILTER_SANITIZE_STRING));
        $thumbnail = trim(filter_input(INPUT_POST,'thumbnailPath', FILTER_SANITIZE_STRING));
        $price = trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ALLOW_FRACTION));
        $stock = trim(filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT));
        $color = trim(filter_input(INPUT_POST,'color', FILTER_SANITIZE_STRING));

        // Check for missing data
        if (empty($carclass) || empty($make) || empty($model) || empty($description) || empty($image) || empty($thumbnail) || empty($price) || empty($stock) || empty($color)) {
            $message = '<p class="serverMessage">Please fill out all feilds for a vehicle to be added.</p>';
            include '../view/add-vehicle.php';
            exit;
        }

        // Send the data to the model
        $regOutcome = addVehicleInv($carclass,$make, $model, $description, $image, $thumbnail, $price, $stock, $color);

        // Check and report the result
        if ($regOutcome === 1) {
            $message = "<p class='serverMessage'>Vehicle added</p>";
            include '../view/vehicle-man.php';
            exit;
        } else {
            $message = "<p class='serverMessage'>Vehicle not added</p>";
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
    default:
        include '../view/vehicle-man.php';
}
