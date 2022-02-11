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
        if (isset($message)) {
            echo $message;
        }
        ?>
        <div class="classForm">
        <h3>Classification Name</h3>
        <form action="/phpmotors/vehicles/index.php" method="post">
            <input type="text" name="classificationName">
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