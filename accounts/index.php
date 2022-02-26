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
    include '../view/admin.php';
    exit;
    break;
    case 'admin':
    include '../view/admin.php';
    break;
    case "LogOut":
        session_unset();
        session_destroy();
        $_SESSION['loggedin'] = FALSE;
        header('Location: /phpmotors/');
    exit;
}