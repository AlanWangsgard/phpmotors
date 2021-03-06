<?php
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == TRUE) {
    header("Location: /phpmotors/");
};
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header("Location: /phpmotors/");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Classification | PHP Motors </title>
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
        <h1>Add Car Classification</h1>
        <?php
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
        }
        ?>
        <div class="classForm">
            <h3>Classification Name</h3>
            <form action="/phpmotors/vehicles/index.php" method="post">
                <span>The classification name must be 30 characters or less.</span><br>
                <input type="text" name="classificationName" maxlength="30" required>
                <br>
                <input type="submit" value="Add Classification">
                <input type="hidden" name="action" value="addClassification">
            </form>
        </div>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/commonContent/footer.php'; ?>
    </footer>
</body>

</html>