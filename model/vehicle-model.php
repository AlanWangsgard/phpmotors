<?php
function addClass($classificationName)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO carclassification (classificationName)
     VALUES (:classificationName)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

function addVehicleInv($carclass, $make, $model, $description, $image, $thumbnail, $price, $stock, $color){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();

    // $sql ='SELECT classificationId from carclassification where classificationName = :carclass';

    // $stmt = $db->prepare($sql);

    // $stmt->bindValue(':carclass', $carclass, PDO::PARAM_STR);

    // $stmt->execute();

    

    // The SQL statement
    $sql = 'INSERT INTO inventory (classificationId, invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor)
     VALUES ((SELECT classificationId from carclassification where classificationName = :carclass) , :invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':carclass', $carclass, PDO::PARAM_STR);
    $stmt->bindValue(':invMake', $make, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $model, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $description, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $image, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $thumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $price, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $stock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $color, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}