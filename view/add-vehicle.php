<!DOCTYPE html>
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
            if (isset($message)) {
                echo $message;
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
                <input type="text" name="make">
                <br>
                <label for="model">Model</label>
                <br>
                <input type="text" name="model">
                <br>
                <lable for="description">Description</lable>
                <br>
                <textarea rows="4" name="description"></textarea>
                <br>
                <label for="imagePath">Image Path</label>
                <br>
                <input type="text" name="imagePath">
                <br>
                <label for="thumbnailPath">Thumbnail Path</label>
                <br>
                <input type="text" name="thumbnailPath">
                <br>
                <label for="price">Price</label>
                <br>
                <input type="text" name="price">
                <br>
                <label for="stock"># in stock</label>
                <br>
                <input type="text" name="stock">
                <br>
                <label for="color">Color</label>
                <br>
                <input type="text" name="color">
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