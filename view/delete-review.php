<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Review | PHP Motors </title>
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
        <div class="delRev">
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
            <p>Deletes cannot be undone, Are you sure you want to delete the review?</p>
            <form action="/phpmotors/reviews/index.php?action=delete" method="POST">
                <label for="delreviewText">Review Text</label>
                <textarea id="delreviewText" rows="6" name="reviewText" readonly><?php if (isset($review['reviewText'])) {
                                                                    echo $review['reviewText'];
                                                                }; ?></textarea><br>
                <input type="hidden" name="reviewId" value="<?php if (isset($reviewId)) {
                                                                echo $reviewId;
                                                            }   ?>">
                <input type="hidden" name="clientId" value="<?php echo $_SESSION["clientData"]["clientId"] ?>">
                <input type="submit" value="Delete Review">
            </form>
        </div>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/commonContent/footer.php'; ?>
    </footer>
</body>

</html>