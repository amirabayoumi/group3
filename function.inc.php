<?php

error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

//-------------------------------------DB connection------------------------------------------//
function connectToDB()
{
    // CONNECTIE to db
    $db_host = '127.0.0.1';
    $db_user = 'root';
    $db_password = 'root';
    $db_db = 'petshop';
    $db_port = 8889;

    try {
        $db = new PDO('mysql:host=' . $db_host . '; port=' . $db_port . '; dbname=' . $db_db, $db_user, $db_password);
    } catch (PDOException $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        die();
    }
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    return $db;
}
//*********************************************************************/
//-------------------------USER/clients Functions -------------------
//*********************************************************************/

//------------------------- 1- get all user list for CRUD --------------

function getUser()
{
    $sql = 'SELECT * from user';
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUserById($id)
{
    $sql = 'SELECT * FROM user WHERE id = :id';
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateUser($id, $firstname, $lastname, $country, $mail, $username, $petname, $password)
{
    if (strlen($password) == 0) {
        $sql = "UPDATE user SET firstname = :firstname, lastname = :lastname, country = :country, mail = :mail, username = :username, petname = :petname WHERE id = :id";
        $stmt = connectToDB()->prepare($sql);
        $stmt->execute(['id' => $id, 'firstname' => $firstname, 'lastname' => $lastname, 'country' => $country, 'mail' => $mail, 'username' => $username, 'petname' => $petname]);
    } else {
        $sql = "UPDATE user SET firstname = :firstname, lastname = :lastname, country = :country, mail = :mail, username = :username, petname = :petname, password = :password WHERE id = :id";
        $stmt = connectToDB()->prepare($sql);
        $stmt->execute(['id' => $id, 'firstname' => $firstname, 'lastname' => $lastname, 'country' => $country, 'mail' => $mail, 'username' => $username, 'petname' => $petname, 'password' => md5($password)]);
    }

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function deleteUser($id)
{
    $sql = "DELETE FROM user WHERE id = :id";
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute(['id' => $id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//------------------------ 2- add new user via register form page ------------

function addUser(String $firstname, String $lastname, String $country,  String $mail, String $username, String $password): bool|int
{
    $db = connectToDB();
    $sql = "INSERT INTO user (firstname, lastname, country, mail, username, password, policy) VALUES (:firstname, :lastname, :country, :mail, :username, :password, 1) ;";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':firstname' => $firstname,
        ':lastname' => $lastname,
        ':country' => $country,
        ':mail' => $mail,
        ':username' => $username,
        ':password' => md5($password)
    ]);
    return $db->lastInsertId();
}
//------------------ 3- validation for mail if this user mail is exist before-----
function isMailExist(String $email): bool
{
    $sql = "SELECT Count(*) FROM user WHERE mail=:mail";

    $stmt = connectToDB()->prepare($sql);
    $stmt->execute([
        ':mail' => $email,
    ]);

    return  (bool)$stmt->fetchColumn();
}

//------------ 4- get user wishlist or his winkel cart -------------
function getWishlistById($id)
{
    $sql = 'select * from product left join wishlist 
on product_id = product.id left join user on user_id = user.id where user.id =:id';
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//**********************************************/
// --------------- Sign in page ---------------/
//**********************************************/
//----------------------- 1- return user id by filter mail and password in user table 

function isValidLogin(String $mail, String $pass): bool|int
{
    $sql = "SELECT id FROM user WHERE mail=:mail AND password=MD5(:password)";

    $stmt = connectToDB()->prepare($sql);
    $stmt->execute([
        ':mail' => $mail,
        ':password' => $pass
    ]);
    return $stmt->fetchColumn();
}
//---------------- if sign in is true , user session start by his id 
function setLogin($uid = false)
{
    $_SESSION['loggedin'] = time() + 3600;

    if ($uid) {
        $_SESSION['uid'] = $uid;
    }
}
//**********************************************/
// --------------- Admin page ---------------/
//**********************************************/
// ------------------------- check admin name and  permission key --------
function isValidLoginAdmin(String $adminName, String $key): bool|int
{
    $sql = "SELECT id FROM admin WHERE name=:name AND admin_key=:pass;";

    $stmt = connectToDB()->prepare($sql);
    $stmt->execute([
        ':name' => $adminName,
        ':pass' => $key
    ]);
    return $stmt->fetchColumn();
}
// -------------- if permission key is true , Admin session start Admin mode
function setLoginAdmin($uid = false)
{
    $_SESSION['loggedinAdmin'] = time() + 3600;

    if ($uid) {
        $_SESSION['uidAdmin'] = $uid;
    }
}




//********************************************************************************************************/
//--------------------  check sessions for admin and user 
//--------------- those function is used to navigate user and admin to right page, if they are log in before, they don't have to log in again if the the session still open 
//********************************************************************************************************/
function isLoggedIn(): bool
{
    session_start();

    $loggedin = FALSE;

    if (isset($_SESSION['loggedin'])) {
        if ($_SESSION['loggedin'] > time()) {
            $loggedin = TRUE;
            setLogin();
        }
    }

    return $loggedin;
}

function isLoggedInAdmin(): bool
{
    session_start();

    $loggedin = FALSE;

    if (isset($_SESSION['loggedinAdmin'])) {
        if ($_SESSION['loggedinAdmin'] > time()) {
            $loggedin = TRUE;
            setLoginAdmin();
        }
    }

    return $loggedin;
}

function requiredLoggedIn()
{
    if (!isLoggedIn()) {
        header("Location: signin.php");
        exit;
    }
}

function requiredLoggedInAdmin()
{
    if (!isLoggedInAdmin()) {
        header("Location: index.php");
        exit;
    }
}

function requiredLoggedOut()
{
    if (isLoggedIn()) {
        header("Location: profile.php");
        exit;
    }
}
function requiredLoggedOutAdmin()
{
    if (isLoggedInAdmin()) {
        header("Location: adminProfile.php");
        exit;
    }
}


//********************************************************************************************************/
//------------------------------- product by OG tags ------------------------
//********************************************************************************************************/


//----- to get all product for main page -----------

function getItems()
{
    $sql = "select * from product;";
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// ---- search by product title ------------
function getItemsBySearch(String $search)
{
    $sql = "select* from product where title like'%$search%';";
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute([]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//----- to get all category in main page -----------
function getCategory()
{
    $sql = "select* from category;";
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute([]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// ---- filter product by category  ------------
function getItemsByCat(String $name)
{
    $sql = "select product.*, category.name as catName from category left join product on category.id = product.category_id where category.name = :name;";
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute([
        'name' => $name
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//--------------------api 
function getOgViaApi(String $ogUrl): bool|stdClass
{
    $curl_handle = curl_init();

    $apiURL = "https://opengraph.io/api/1.1/site/" . urlencode($ogUrl) . "?app_id=4b00ea99-9be1-4a4f-8d85-c40958ba6672";

    curl_setopt($curl_handle, CURLOPT_URL, $apiURL); // de locatie waar ik een request naartoe stuur
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true); // ik wil een antwoord ontvangen van de request url
    curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false); // expliciet zeggen dat we van http naar https toch willen werken

    $curl_data = curl_exec($curl_handle);
    curl_close($curl_handle);

    $response = json_decode($curl_data);

    if ($response === null)
        return false;

    return $response;
}

// --------------------------- insert new product to shop list by OG tags 
function insertOgLink(String $url, $title, $description, $image, $price, Int $cat): bool|int
{
    $db = connectToDB();
    $sql = "INSERT INTO product (url, title, description, image, price,status,stock, category_id) VALUES ( :url, :title, :description, :image ,:price ,1,1,:category);";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'url' => $url,
        'title' => mb_strimwidth($title, 0, 250, "..."),
        'description' => mb_strimwidth($description, 0, 250, "..."),
        'image' => mb_strimwidth($image, 0, 250, "..."),
        'price' => $price,
        'category' => $cat
    ]);

    return $db->lastInsertId();
}


function getProductPerPage(int $start, int $rows): array
{
    $sql = "SELECT * FROM product limit :start, :rows;";
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute([
        ':start' => $start,
        ':rows' => $rows

    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getProductByID(Int $id)
{
    $sql = "SELECT * FROM product where id=:id;";
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute([
        ':id' => $id
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function deleteProduct(int $id)
{
    $sql = "DELETE FROM product WHERE id = :id;";
    $stmt = connectToDB()->prepare($sql);
    $stmt->execute([
        ':id' => $id
    ]);
    $stmt->fetchAll(PDO::FETCH_ASSOC);
}
