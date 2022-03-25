<?php
// this is the accounts controller for phpmotors

// creat session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

require_once '../model/accounts-model.php';

require_once '../library/functions.php';

require_once '../model/reviws-model.php';

// Get the array of classifications
$classifications = getClassifications();

$navList = createNav($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case 'register':
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST,'clientLastname', FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST,'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST,'clientPassword', FILTER_SANITIZE_STRING));

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        $existingEmail = checkExistingEmail($clientEmail);

        // Check for existing email address in the table
        if ($existingEmail) {
            $_SESSION['message'] = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }

        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        }

        // Send the data to the model
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if ($regOutcome === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');

            $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            include '../view/login.php';
            exit;
        } else {
            $_SESSION['message'] = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'login':
        include "../view/login.php";
        break;
    case 'register':
        include "../view/registration.php";
        break;
    case 'Login':
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        if (empty($clientEmail) || empty($checkPassword)) {
            $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
            include '../view/login.php';
            exit;
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
            $_SESSION['message'] = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view

        $reviewlist = getReviewsByClientId($_SESSION['clientData']['clientId']);
        $reviews = buildReviewAdmin($reviewlist);

        include '../view/admin.php';
        exit;
        break;
    case 'admin':
        $reviewlist = getReviewsByClientId($_SESSION['clientData']['clientId']);
        $reviews = buildReviewAdmin($reviewlist);

        include '../view/admin.php';
        break;
    case "LogOut":
        session_unset();
        session_destroy();
        $_SESSION['loggedin'] = FALSE;
        header('Location: /phpmotors/');
        exit;
    case "up":
        $clientId = $_SESSION['clientData']['clientId'];
        $clientInfo = getClientInfo($clientId);
        array_pop($clientInfo);

        $_SESSION['clientInfo'] = $clientInfo;
        // $clientInfo = getClientInfo($clientId);

        include "../view/client-update.php";
        break;
    case "updateClient":
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname' , FILTER_SANITIZE_STRING));
        $clientLastname = trim(filter_input(INPUT_POST,'clientLastname' , FILTER_SANITIZE_STRING));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail' , FILTER_SANITIZE_STRING));
        $clientId = trim(filter_input(INPUT_POST, 'clientId' , FILTER_SANITIZE_NUMBER_INT));;

        if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
            $clientEmail = checkEmail($clientEmail);
            $existingEmail = checkExistingEmail($clientEmail);
        }

        // Check for existing email address in the table
        if ($existingEmail) {
            $_SESSION['message'] = '<p class="notice">That email address already exists.</p>';
            include '../view/client-update.php';
            exit;
        }

        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail || empty($clientId))){
            $_SESSION['message'] = '<p> Please complete all information for the item!.</p>';
            include '../view/client-update.php';
            exit;
        }

        $updateClientres = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
        if ($updateClientres){
            $message = "<p class='notice'>Congratulations, $clientFirstname, your profile was successfully updated.</p>";
            $_SESSION['message'] = $message;

            $clientData = getClient($clientEmail);
            
            
            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Remove the password from the array
            // the array_pop function removes the last
            // element from an array
            array_pop($clientData);
            // Store the array into the session
            if (isset($_SESSION['clientData'])){
                unset($_SESSION['clientData']);
            }
            $_SESSION['clientData'] = $clientData;

            header('location: /phpmotors/accounts/index.php?action=admin');

            exit;
        } else {
            $_SESSION['message'] = "<p class='notice'>Error. Profile not updated.</p>";
            include '../view/client-update.php';
            exit;
        }
        break;
    case "updatePassword":
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
        $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT));;

        $checkPassword = checkPassword($clientPassword);

        if (empty($clientId) || empty($checkPassword)) {
            $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit;
        }

        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $updateResult = updateClientPassowrd($clientId, $hashedPassword);
        if ($updateResult) {
            $message = "<p class='notice'>Congratulations, $clientFirstname, your profile was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/index.php?action=admin');
        } else {
            $_SESSION['message'] = "<p class='notice'>Error. Profile not updated.</p>";
            include '../view/client-update.php';
            exit;
        }

        break;
}