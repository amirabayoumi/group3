<?php


//Updates user information in the database.
function editUser($id, $firstname, $lastname, $country, $mail, $username, $petname, $password)
{
 
    if (strlen($password) == 0) {
        
        $sql = "UPDATE user SET firstname = :firstname, lastname = :lastname, country = :country, mail = :mail, username = :username, petname = :petname WHERE id = :id";
        $stmt = connectToDB()->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'country' => $country,
            'mail' => $mail,
            'username' => $username,
            'petname' => $petname
        ]);
    } else {
     
        $sql = "UPDATE user SET firstname = :firstname, lastname = :lastname, country = :country, mail = :mail, username = :username, petname = :petname, password = :password WHERE id = :id";
        $stmt = connectToDB()->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'country' => $country,
            'mail' => $mail,
            'username' => $username,
            'petname' => $petname,
            'password' => md5($password)
        ]);
    }

    // Return true if at least one row was updated, false otherwise
    return $stmt->rowCount() > 0; 
}



//Deletes a user from the database.

function deleteThisUser($id)
{
    $pdo = connectToDB(); 

    try {
        $pdo->beginTransaction();

        //first: delete the whishlist
        $sql = "DELETE FROM wishlist WHERE user_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        //then: delete the user
        $sql = "DELETE FROM user WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        // fixing transaction
        $pdo->commit();

        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        // if an error occured rollback the transaction
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function addNewUser($firstname, $lastname, $email, $country, $username, $petname, $password)
{
    $db = connectToDB();
    $sql = "INSERT INTO user (firstname, lastname, mail, country, username, petname, password) 
            VALUES (:firstname, :lastname, :email, :country, :username, :petname, :password)";
    $stmt = $db->prepare($sql);
    return $stmt->execute([
        ':firstname' => $firstname,
        ':lastname' => $lastname,
        ':email' => $email,
        ':country' => $country,
        ':username' => $username,
        ':petname' => $petname,
        ':password' => md5($password)
    ]);
}

//Checks if email or username already exists in DB
function checkExistingUser($username, $email)
{
    $db = connectToDB();
    $sql = "SELECT COUNT(*) FROM user WHERE username = :username OR mail = :email";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':username' => $username,
        ':email' => $email,
    ]);
    return $stmt->fetchColumn() > 0; // true, if user exists
}