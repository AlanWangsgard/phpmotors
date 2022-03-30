<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vehicle Details | PHP Motors </title>
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
        <p>Vehicle Reviews are at the bottom of the page.</p>
        <div class="vehiDisplay">
            <?php
            echo $vehicleInfo;
            echo $vehicleImgs;

            ?>
        </div>
        <div class="reviewHead">
        <h2>Customer Reviews</h2>
        <?php
        echo "<h3>Review the " . $vehicle['invMake'] ." ". $vehicle["invModel"] . "</h3>";
        ?>
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
        } ?>
        </div>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '
            <div class="reviewForm">
        <form action="/phpmotors/reviews/index.php?action=add" method="POST">
            <label for="screenName">Screen Name</label><br>
            <input class="uinput" id="screenName" type="text" name="screenName" readonly value="' . substr($_SESSION['clientData']['clientFirstname'], 0, 1) . $_SESSION['clientData']['clientLastname'] . '"><br>
            <label for="reviewText">Review</label><br>
            <textarea class="uinput" id="reviewText" name="reviewText" rows="6"></textarea><br>
            <input type="hidden" name="invId" value="<?php echo' . $invId . ' ?>">
            <input type="hidden" name="clientId" value="<?php echo' . $_SESSION['clientData']['clientId'] . '?>">
            <input class="btn" type="submit" value="Submit Review">
        </form></div>';
        } else {
            echo "<p>You may add a review if you <a href='/phpmotors/accounts/index.php?action=login'>Log In</a></p>";
        }

        if (isset($reviews)) {
            echo $reviews;
        }
        ?>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/commonContent/footer.php'; ?>
    </footer>
</body>

</html>