<?php
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] == TRUE) {
    header("Location: /phpmotors/");
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Client Management | PHP Motors </title>
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
        <h2>Manage Account</h2>
        <p>Update Account</p>
         <form action="/phpmotors/accounts/" method="post">
                <label for="firstname">First Name</label><br>
                <input type="text" name="clientFirstname" id="firstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}elseif(isset($clientInfo['clientFirstname'])){echo "value=$clientInfo[clientFirstname]";}  ?> required><br>
                <label for="lastname">Last Name</label><br>
                <input type="text" name="clientLastname" id="lastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}elseif(isset($clientInfo['clientLastname'])){echo "value=$clientInfo[clientLastname]";}  ?> required><br>
                <label for="email">Email</label><br>
                <input type="email" name="clientEmail" id="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}elseif(isset($clientInfo['clientEmail'])){echo "value=$clientInfo[clientEmail]";}  ?> required><br>
                <input class="submit" type="submit" name="submit" value="Update Info" id="regbtn">
                <input type="hidden" name="action" value="updateClient">
                <input type="hidden" name="invId" value="<?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} elseif(isset($clientId)){ echo $clientId; } ?>">
            </form>
            <p>Update Password</p>
            <form>
                <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</p>
                <p>*Note Your original password will be changed.</p>
                <label for="password">Password</label><br>
                <input type="password" name="clientPassword" id="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
            </form>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/commonContent/footer.php'; ?>
    </footer>
</body>

</html>