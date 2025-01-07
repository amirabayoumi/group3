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
    $sql = "DELETE FROM user WHERE id = :id";
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->rowCount() > 0;
}
