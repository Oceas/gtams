<?php
//Starts the session.
require_once "sessionstart.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $page_title; ?></title>
    <link type="text/css" rel="stylesheet" href="resources/css/stylesheet.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="resources/css/structure-merge.css"/>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

</head>

<body>

<!--Navbar -->
<?php require "navbar.php" ?>

<!--Opening the Database -->
<?php require_once "dbopen.php" ?>

<?php require "system_management.php" ?>
