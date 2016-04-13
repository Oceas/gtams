<?php
# MySQL Hostname
$hostname = 'localhost';

# MySQL Database
$database = 'gtasm';

# MySQL Username
$username = 'root';

# MySQL Password
$password = 'b7863781051';

# First we connect to the database. If this fail, it catch a PDOException, and an error message occurs.
try
{
$dbh = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
//echo 'Connected';
}
catch (PDOException $e)
{
echo "Didnt connect: " . $e->getMessage();
}
?>
