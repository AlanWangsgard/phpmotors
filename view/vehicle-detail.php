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
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
        } ?>
        <div class="vehiDisplay">
            <?php
            echo $vehicleInfo;
            echo $vehicleImgs;

            ?>
        </div>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<h2>Customer Reviews</h2>
            <h3>Review the Vehicle<h3>
        <form action="/phpmotors/reviews/index.php?action=add" method="POST">
            <input type="text" name="screenName" readonly value="'. substr($_SESSION['clientData']['clientFirstname'], 0, 1). $_SESSION['clientData']['clientLastname'] .'">
            <textarea name="reviewText"></textarea>
            <input type="hidden" name="invId" value="<?php echo' . $invId . ' ?>">
            <input type="hidden" name="clientId" value="<?php echo' . $_SESSION['clientData']['clientId'] . '?>">
            <input type="submit">
        </form>';
        } else {
            echo "<p>You may add a review if you log in</p><a href='/phpmotors/accounts/index.php?action=login'>Log In</a>";
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