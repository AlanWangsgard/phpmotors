<img src="/phpmotors/images/site/logo.png" alt="Logo.png">
<?php
if (isset($_SESSION['clientData']['clientFirstname'])) {
    echo "<a class='cookie' href='/phpmotors/accounts/index.php?action=admin' id='cookie'>Welcome " .$_SESSION['clientData']['clientFirstname']. "!</span>";
}
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
    echo "<a class='log' href='/phpmotors/accounts/?action=LogOut'>" . $_SESSION['clientData']['clientFirstname']." | Log Out</a>";
}else{
    echo '<a class="log" href="http://localhost/phpmotors/accounts/index.php?action=login" title="Login or Register With PHP Motors">My Account</a>';

}
?>
