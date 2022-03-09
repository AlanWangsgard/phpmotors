<?php

function checkEmail($clientEmail){
 $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
 return $valEmail;
}

function checkPassword($clientPassword)
{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

function createNav($classifications)
{
    $navList = '<ul>';
    $navList .= "<li><a href='http://localhost/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';

    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications)
{
    $classificationList = '<select name="classificationId" id="classificationList">';
    $classificationList .= "<option>Choose a Classification</option>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    return $classificationList;
}

function buildVehiclesDisplay($vehicles)
{
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $dv .= '<a href="/phpmotors/vehicles/index.php?action=displayVehicle&invId=' . urldecode($vehicle["invId"]).'"' . '><li>';
        $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= '<hr>';
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "<span>$vehicle[invPrice]</span>";
        $dv .= '</li></a>';
    }
    $dv .= '</ul>';
    return $dv;
}

function buildVehicleInfo($vehicle){
    $info = '<div id="vInfo" >';
    $info .= '<p class="mnm">' . $vehicle["invMake"] . ' ';
    $info .= $vehicle["invModel"] . '</p>';
    $info .= '<img src=' . $vehicle["invImage"] . ' alt="Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com">';
    $info .= '<p class="vDesc" ><span class="vTitle">' .$vehicle["invMake"] . ' ' . $vehicle["invModel"] . ' description:</span><br>' . $vehicle["invDescription"] . '</p>';
    $priceArray = str_split(strrev($vehicle["invPrice"]));
    $properPrice = "";
    for ($i = 0; $i < strlen($vehicle["invPrice"]); $i++){
        if ($i%3 == 0 && $i != 0){
            $properPrice .= ",";
            $properPrice .= $priceArray[$i];
        }else{
            $properPrice .= $priceArray[$i];
        }
    }
    $info .= '<p class="vAttr" >Price: $' . strrev($properPrice);
    $info .= '<br>Color: ' . $vehicle["invColor"];
    $info .= '<br>Stock:'.$vehicle["invStock"] . '</p>';
    $info .= '</div>';

    return $info;
 }