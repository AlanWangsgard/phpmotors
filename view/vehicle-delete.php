<?php
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == TRUE) {
    header("Location: /phpmotors/");
};
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header("Location: /phpmotors/");
}
$classificationList = '<select name="classificationId" id="classificationId">';
$classificationList .= "<option>Choose a Car Classification</option>";
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)) {
        if ($classification['classificationId'] == $classificationId) {
            $classificationList .= ' selected ';
        }
    } elseif (isset($invInfo['classificationId'])) {
        if ($classification['classificationId'] === $invInfo['classificationId']) {
            $classificationList .= ' selected ';
        }
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php if (isset($invInfo['invMake'])) {
                echo "Delete $invInfo[invMake] $invInfo[invModel]";
            } ?> | PHP Motors</title>
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
        <div class="carForm">
            <h1><?php if (isset($invInfo['invMake'])) {
                    echo "Delete $invInfo[invMake] $invInfo[invModel]";
                } ?></h1>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
            <p>Confirm Vehicle Deletion. The delete is permanent.</p>
            <form action="/phpmotors/vehicles/index.php" method="post">
                <br>
                <label for="make">Make</label>
                <br>
                <input type="text" name="make" id="make" <?php if (isset($make)) {
                                                                echo "value='$make'";
                                                            } elseif (isset($invInfo['invMake'])) {
                                                                echo "value='$invInfo[invMake]'";
                                                            }  ?> readonly>
                <br>
                <label for="model">Model</label>
                <br>
                <input type="text" name="model" id="model" <?php if (isset($model)) {
                                                                echo "value='$model'";
                                                            } elseif (isset($invInfo['invModel'])) {
                                                                echo "value='$invInfo[invModel]'";
                                                            }  ?> readonly>
                <br>
                <label for="description">Description</label>
                <br>
                <textarea rows="4" name="description" id="description" readonly><?php if (isset($description)) {
                                                                                    echo $description;
                                                                                } elseif (isset($invInfo['invDescription'])) {
                                                                                    echo $invInfo['invDescription'];
                                                                                } ?></textarea>
                <br>
                <input type="submit" value="Delete Vehicle">
                <input type="hidden" name="action" value="deleteVehicle">
                <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                                                                echo $invInfo['invId'];
                                                            } ?>">
            </form>
        </div>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/commonContent/footer.php'; ?>
    </footer>
</body>

</html>