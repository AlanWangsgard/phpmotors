<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Review | PHP Motors </title>
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
        <div class="editRev">
            <?php
            if (isset($item)) {
                echo "<h1>" . $item['invMake'] . " " . $item['invModel'] . " Review</h1>";
            }
            ?>
            <?php
            if (isset($review)) {
                echo "<p>Reviewed on " . date("d M Y", strtotime($review['reviewDate'])) . "</p>";
            }
            ?>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
            <form action="/phpmotors/reviews/index.php?action=update" method="POST">
                <label for="editreviewText">Review Text</label>
                <textarea required id="editreviewText" rows="6" name="reviewText"><?php if (isset($review['reviewText'])) {
                                                                                echo $review['reviewText'];
                                                                            }; ?></textarea><br>
                <input type="hidden" name="reviewId" value="<?php if (isset($reviewId)) {
                                                                echo $reviewId;
                                                            }   ?>">
                <input type="hidden" name="clientId" value="<?php echo $_SESSION["clientData"]["clientId"] ?>">
                <input type="submit" value="Edit Review">
            </form>
        </div>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/commonContent/footer.php'; ?>
    </footer>
</body>

</html>