<?php

// reviews model

function addReview($invId, $clientId, $reviewText){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO reviews (invId, clientId, reviewText)
     VALUES (:invId, :clientId, :reviewText)';
     
    $stmt = $db->prepare($sql);
    
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

function getReviewsByInvId($invId){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'SELECT * FROM reviews as r JOIN clients as c ON r.clientId = c.clientId WHERE invId = :invId ORDER BY reviewDate DESC';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);;
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $reviews;
}

function getReviewsByClientId($clientId){
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'SELECT * FROM reviews as r JOIN clients as c ON r.clientId = c.clientId WHERE r.clientId = :clientId ORDER BY reviewDate DESC';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);;
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $reviews;
}

function getReview(){

}

function updateReview(){

}

function deleteReview(){

}

function buildReviewView($reviewList){
    $reviews = "<div>";
    foreach ($reviewList as $review) {
        $reviews .= "<div class='review'>";
        $reviews .= "<h3>" . $review['clientFirstname'][0] . $review['clientLastname'] . "</h3>";
        $reviews .= "<p>" . $review['reviewText'] . "</p>";
        $reviews .= $review['reviewDate'];
        $reviews .= "</div>";
    }
    $reviews .= "</div>";
    return $reviews;
}

function buildReviewAdmin($reviewList)
{
    $reviews = "<div>";
    foreach ($reviewList as $review) {
        $reviews .= "<div class='review'>";
        $reviews .= "<h3>" . $review['clientFirstname'][0] . $review['clientLastname'] . "</h3>";
        $reviews .= "<p>" . $review['reviewText'] . "</p>";
        $reviews .= $review['reviewDate'] . "<br>";
        $reviews .= "<a href='/phpmotors/reviews/index.php?action=edit'>Edit</a> <a href='/phpmotors/reviews/index.php?action=delete'>Delete</a>";
        $reviews .= "</div>";
    }
    $reviews .= "</div>";
    return $reviews;
}