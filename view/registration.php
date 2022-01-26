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
            <label for="firstname">Email</label><br>
            <input type="text" name="first_name" id="firstname"><br>
            <label for="lastname">Last Name</label><br>
            <input type="text" name="last_name" id="lastname"><br>
            <label for="email">Email</label><br>
            <input type="text" name="user_email" id="email"><br>
            <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</p>
            <label for="password">Password</label><br>
            <input type="text" name="user_password" id="password"><br>
            <button class="showPassword">Show Passowrd</button><br>
            <button class="submit">Register</button><br>
        </div>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/commonContent/footer.php'; ?>
    </footer>
</body>

</html>