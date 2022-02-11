<?php
// this is the main controller for phpmotors

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

require_once '../model/vehicle-model.php';


// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
// exit;

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='http://localhost/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

$classificationList = '<select name="class">';
$classificationList .= "<option value='choose Classification'>Choose Classification</option>";
foreach ($classifications as $classification) {
    $classificationList .= "<option value='" . $classification['classificationName']  . "'>" . $classification['classificationName'] . "</option>";
}
$classificationList .= '</select>';

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
        $carclass = filter_input(INPUT_POST, "class");
        $make = filter_input(INPUT_POST, 'make');
        $model = filter_input(INPUT_POST, 'model');
        $description = filter_input(INPUT_POST, 'description');
        $image = filter_input(INPUT_POST, 'imagePath');
        $thumbnail = filter_input(INPUT_POST, 'thumbnailPath');
        $price = filter_input(INPUT_POST, 'price');
        $stock = filter_input(INPUT_POST, 'stock');
        $color = filter_input(INPUT_POST, 'color');

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
