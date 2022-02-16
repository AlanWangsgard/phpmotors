<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register | PHP Motors </title>
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
        <div class="register">
            <h1>Register</h1>
            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>
            <form method="post">
                <label for="firstname">First Name</label><br>
                <input type="text" name="clientFirstname" id="firstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required><br>
                <label for="lastname">Last Name</label><br>
                <input type="text" name="clientLastname" id="lastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required><br>
                <label for="email">Email</label><br>
                <input type="email" name="clientEmail" id="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br>
                <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</p>
                <label for="password">Password</label><br>
                <input type="password" name="clientPassword" id="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                <input class="submit" type="submit" name="submit" value="Register" id="regbtn">
                <input type="hidden" name="action" value="register">
                <!-- <button class="submit">Register</button><br> -->
            </form>
        </div>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/commonContent/footer.php'; ?>
    </footer>
</body>

</html>