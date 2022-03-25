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
        <h1>Content Title Here</h1>
        
            <h2>Delete Reviews</h2>
        <form action="/phpmotors/reviews/index.php?action=delete" method="POST">
            <textarea name="reviewText" readonly><?php if (isset($review['reviewText'])){echo $review['reviewText'];};?></textarea>
            <input type="hidden" name="reviewId" value="<?php if (isset($reviewId)){echo $reviewId;}   ?>">
            <input type="hidden" name="clientId" value="<?php echo $_SESSION["clientData"]["clientId"] ?>">
            <input type="submit">
        </form>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/commonContent/footer.php'; ?>
    </footer>
</body>

</html>