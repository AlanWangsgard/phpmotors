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
            $_SESSION["message"] = "<p>error, please fill out the form completely.</p>";
            header ("Location: /phpmotors/vehicles/index.php?action=displayVehicle&invId=". $invId);
            break;
        }
        else{
            unset($_SESSION["message"]);
            $result = addReview($invId, $clientId, $reviewText);
        }

        if ($result){
            $_SESSION['message'] = "Thank you for adding a review!";
            header("Location: /phpmotors/vehicles/index.php?action=displayVehicle&invId=" . $invId);
            break;
        }

        break;
    case "edit":
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        if (empty($reviewId)){
            $_SESSION['message'] = "Could not get review";
            header("Location: /phpmotors/accounts/index.php?action=admin");
            break;
        }

        $review = getReview($reviewId);
        $item = getInvItemInfo($review['invId']);
        include "../view/edit-review.php";
        break;
    case "update":
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);

        if (empty($reviewId)) {
            $_SESSION['message'] = "could not get Id";
            header("Location: /phpmotors/reviews/index.php?action=edit&reviewId=$reviewId");
            break;
        }

        if (empty($reviewText)) {
            $_SESSION['message'] = "Please include review text";
            header("Location: /phpmotors/reviews/index.php?action=edit&reviewId=$reviewId");
            // include "../view/edit-review.php";
            break;
        }
        $updated = updateReview($reviewId, $reviewText);
        if (empty($updated)) {
            $_SESSION['message'] = "could not update review";
            header("Location: /phpmotors/reviews/index.php?action=edit&reviewId=$reviewId");
            break;
        }
        $_SESSION['message'] = "Review updated succesfully";
        header("Location: /phpmotors/accounts/index.php?action=admin");
        break;
    case "confirm-delete":
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        if (empty($reviewId)){
            $_SESSION['message'] = "Could not delete";
            include "../view/delete-review.php";
            break;
        }

        $review = getReview($reviewId);
        $item = getInvItemInfo($review['invId']);
        include "../view/delete-review.php";
        break;
    case "delete":
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        if (empty($reviewId)){
            $_SESSION['message'] = "could not get Id";
            include "../view/delete-review.php";
            break;
        }
        $deleted = deleteReview($reviewId);
        if (empty($deleted)) {
            $_SESSION['message'] = "could not get delete review";
            include "../view/delete-review.php";
            break;
        }
        $_SESSION['message'] = "Review Deleted succesfully";
        header("Location: /phpmotors/accounts/index.php?action=admin");
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