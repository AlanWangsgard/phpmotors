<?php
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == TRUE) {
    header("Location: /phpmotors/");
};
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header("Location: /phpmotors/");
}
    $classificationList = '<select name="class">';
    $classificationList .= "<option value='choose Classification'>Choose Classification</option>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'";
        if(isset($classificationId)){
            if($classification['classificationId'] == $classificationId){
                $classificationList .= "selected";
            }
        }
        $classificationList .= "> $classification[classificationName] </option>";
    }
    $classificationList .= '</select>';
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Vehicle | PHP Motors </title>
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
            <h1>Add Vehicle</h1>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
            <p>*All feilds are required</p>
            <form action="/phpmotors/vehicles/index.php" method="post">
                <?php
                echo $classificationList
                ?>
                <br>
                <label for="make">Make</label>
                <br>
                <input type="text" name="make" id="make" <?php if(isset($make)){echo "value='$make'";}  ?> required>
                <br>
                <label for="model">Model</label>
                <br>
                <input type="text" name="model" id="model" <?php if(isset($model)){echo "value='$model'";}  ?> required>
                <br>
                <label for="description">Description</label>
                <br>
                <textarea rows="4" name="description" id="description" required><?php if(isset($description)){echo $description;}  ?></textarea>
                <br>
                <label for="imagePath">Image Path</label>
                <br>
                <input type="text" name="imagePath" id="imagePath" <?php if(isset($image)){echo "value='$image'";}  ?> required>
                <br>
                <label for="thumbnailPath">Thumbnail Path</label>
                <br>
                <input type="text" name="thumbnailPath" id="thumbnailPath" <?php if(isset($thumbnail)){echo "value='$thumbnail'";}  ?> required>
                <br>
                <label for="price">Price</label>
                <br>
                <input type="text" name="price" id="price" <?php if(isset($price)){echo "value='$price'";}  ?> required>
                <br>
                <label for="stock"># in stock</label>
                <br>
                <input type="text" name="stock" id="stock" <?php if(isset($stock)){echo "value='$stock'";}  ?> required>
                <br>
                <label for="color">Color</label>
                <br>
                <input type="text" name="color" id="color" <?php if(isset($color)){echo "value='$color'";}  ?> required>
                <br>
                <input type="submit" value="Add Vehicle">
                <input type="hidden" name="action" value="addVehicletoInv">
            </form>
        </div>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/commonContent/footer.php'; ?>
    </footer>
</body>

</html>