<?php
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == TRUE) {
    header("Location: /phpmotors/");
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Client Admin | PHP Motors </title>
    <link href="/phpmotors/css/style.css" type="text/css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <header>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/commonContent/header.php'; ?>
    </header>
    <nav>
        <?php //require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/commonContent/nav.php';//
        echo $navList;
        ?>
    </nav>
    <main>
        <h1><?php
            echo $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname'];
            ?></h1>
        <p>You are logged in</p>
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
        }
        ?>
        <ul>
            <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname'] ?></li>
            <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname'] ?></li>
            <li>Email: <?php echo $_SESSION['clientData']['clientEmail'] ?></li>
        </ul>
        <h2>Account Managment</h2>
        <p>Use This link to update account information</p>
        <a href="/phpmotors/accounts/index.php?action=up">Update Account Information</a>
        <?php
        if ($_SESSION['clientData']['clientLevel'] > 1) {
            echo "<h2>Inventory Management</h2><p>Use this link to manage inventory</p><a href='/phpmotors/vehicles/'>Vehicle Management</a>";
        }
        ?>
        <h2>Your Reviews</h2>
        <?php
        //show reviews if they are there ordered by date
        echo "reviews";
        if (isset($reviews)){
            echo $reviews;
        }else{
            echo "no";
        }
        ?>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/commonContent/footer.php'; ?>
    </footer>
</body>

</html>