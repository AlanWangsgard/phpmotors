<img src="/phpmotors/images/site/logo.png" alt="Logo.png">
<?php
if (isset($_SESSION['clientData']['clientFirstname'])) {
    echo "<span id='cookie'>Welcome " .$_SESSION['clientData']['clientFirstname']. "!</span>";
}
if (isset($_SESSION['loggedin'])){
    echo "<a href='/phpmotors/index.php?action=LogOut'>" . $_SESSION['clientData']['clientFirstname']." | Log Out</a>";
}else{
    echo '<a href="http://localhost/phpmotors/accounts/index.php?action=login" title="Login or Register With PHP Motors">My Account</a>';

}
?>
