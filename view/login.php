<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login | PHP Motors </title>
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
        <div class="login">
            <h1>Sign In</h1>
            <label for="email">Email</label><br>
            <input type="text" name="user_email" id="email"><br>
            <label for="password">Password</label><br>
            <input type="text" name="user_password" id="password"><br>
            <button class="submit">Sign in</button><br>
            <a href="?action=register">Not a member yet?</a>
        </div>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/commonContent/footer.php'; ?>
    </footer>
</body>

</html>