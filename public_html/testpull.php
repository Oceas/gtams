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
//Grab the form and letter deadlines from the current semester to compare.
$sth = $dbh->prepare("SELECT s.form_deadline, s.letter_deadline FROM semester_sessions s WHERE s.id = " . $curSem);
$sth->execute();
$result = $sth->fetchAll();

foreach ($result as $r)
{
  $appDead = $r['form_deadline'];
  $letDead = $r['letter_deadline'];
}
$letDeadTS = strtotime($letDead);
$appDeadTS = strtotime($appDead);

echo $appDeadTS . " " . $letDeadTS . " Poop";
?>
