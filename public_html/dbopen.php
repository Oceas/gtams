<?php
//user
$user = '';

//password
$passwd = '';

//Connecting to the DataBase
try {
    $db = new PDO('mysql:host=localhost;dbname=gtams', $user, $passwd);
} catch (PDOException $e) {
    echo $e->getMessage()."<br>";
    die();
}
?>
