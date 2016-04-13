<?php
require "header.php";
//---------------                                -----------------------------
//          IGNORE THIS FILE, I COMITTED BY MISTAKE.
//---------------                                -----------------------------



/* $eleven = 12;
//-----------------THIS IS TESTING RETRIEVING DATA FROM DATABSE---------------------------

$sth = $dbh->prepare("SELECT * FROM semester_sessions WHERE id = $eleven");
$sth->execute();
$result = $sth->fetchAll();

foreach ($result as $r)
{
   $name = $r['name'];
}
echo "$name" . "<br>";
$timestamp = strtotime("2/5/16");
echo date("Y-m-d H:i:s", $timestamp) . "<br>";
try {
  $tryTest = "Try Test Succeeded <br>";

  //echo "Successfully placed session data into database.<br>";
} catch (Exception $e) {
  //echo $e->getMessage();
}

echo $tryTest; */

?>

<?php
$sth = $dbh->prepare("SELECT * FROM gc_members");
$sth->execute();
$result = $sth->fetchAll();


echo "<table border='1'>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>";

foreach($result as $r)
{
echo "<tr>";
echo "<td>" . $r['first_name'] . "</td>";
echo "<td>" . $r['last_name'] . "</td>";
echo "</tr>";
}
echo "</table>";
?>
