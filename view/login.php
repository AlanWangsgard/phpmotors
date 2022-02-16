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
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form method="post">
            <label for="email">Email</label><br>
            <input type="email" name="clientEmail" id="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br>
            <label for="password">Password</label><br>
            <span>Password must be at least 8 charachters, have 1 uppercase leeter, 1 number, and 1 special character.</span><br>
            <input type="password" name="clientPassword" id="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br>
            <button class="submit">Sign in</button><br>
            <input type="hidden" name="action" value="Login">
            <a href="?action=register">Not a member yet?</a>
            </form>
        </div>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/commonContent/footer.php'; ?>
    </footer>
</body>

</html>