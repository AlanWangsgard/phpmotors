INSERT Into clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment) VALUES ("Tony", "Stark", "tony@starkent.com", "Iam1ronM@n", "I am the real Ironman");

UPDATE clients SET clientLevel=3 WHERE clientId=1;

UPDATE inventory SET invDescription=REPLACE(invDescription, "small", "spacious") WHERE invMake="GM" AND invModel="Hummer";

SELECT invModel from inventory INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId WHERE classificationName="SUV";

DELETE from inventory where invMake="Jeep" AND invModel="Wrangler";

Update inventory SET invImage=concat("/phpmotors" , invImage), invThumbnail=concat("/phpmotors" , invThumbnail);