<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home | PHP Motors </title>
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
        <div class="greeting">
            <h1>Welcome to PHP Motors!</h1>
            <div class="hero">
                <ul>
                    <li>DMC Delorean</li>
                    <li>3 Cup holders</li>
                    <li>Superman Doors</li>
                    <li>Fuzzy dice!</li>
                </ul>
                <img class="own" src="images/site/own_today.png" alt="Own Today.png">
                <img class="delorean_img" src="images/delorean.jpg" alt="Delorean.jpg">
            </div>
        </div>
        <div class="content">
            <div class="upgrades">
                <h2 class="upgrade_header">Delorean Upgrades</h2>
                <div class="flux">
                    <div class="images">
                        <img src="images/upgrades/flux-cap.png" alt="Flux Capacitor.png">
                    </div>
                    <a href="#" title="Flux Capaciter">Flux Capacitor</a>
                </div>
                <div class="flame">
                    <div class="images">
                        <img src="images/upgrades/flame.jpg" alt="Flame.jpg">
                    </div>
                    <a href="#" title="Flames">Flame Decals</a>
                </div>
                <div class="bumper">
                    <div class="images">
                        <img src="images/upgrades/bumper_sticker.jpg" alt="Bumper_sticker.png">
                    </div>
                    <a href="#" title="Bumper Sticker">Bumper Stickers</a>
                </div>
                <div class="hub">
                    <div class="images">
                        <img src="images/upgrades/hub-cap.jpg" alt="hub-cap.jpg">
                    </div>
                    <a href="#" title="Hub Caps">Hub Caps</a>
                </div>
            </div>
            <div class="reviews">
                <h2>DMC Delorean Reviews</h2>
                <ul>
                    <li>"So fast its almost like traveling in time." (4/5)</li>
                    <li>"Coolest ride on the road." (4/5)</li>
                    <li>"I'm feeling Marty McFly!" (5/5)</li>
                    <li>"The most futuristic ride of our day." (4.5/5)</li>
                    <li>"80's livin and I love it!" (5/5)</li>
                </ul>
            </div>
        </div>
    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/commonContent/footer.php'; ?>
    </footer>
</body>

</html>