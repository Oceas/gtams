<?php
//Checks for submission from the html code.
if(!empty($_POST)){
  //require "header.php";

  // This try catch inderts data into the semester_sessions database.
  try {
    //submission/letter deadlines turned into SQL Timestamp Format.
    $subDead = date("Y-m-d H:i:s", strtotime($_POST["submissionDeadlineDate"]));
    $letDead = date("Y-m-d H:i:s", strtotime($_POST["letterDeadlineDate"]));
    $adminame = $_POST["sessionName"];
    $sql = "INSERT INTO semester_sessions (name, form_deadline, letter_deadline) VALUES ('$adminame', '$subDead', '$letDead')";
    $dbh->query($sql);

    //Gets the id of the semester session that was just inserted.
    $dbID = $dbh->lastInsertId();

    //echo "Successfully placed session data into database.<br>";
  } catch (SDOException $e) {
    echo "Please refresh and try again.<br>";
  }

  //This try catch takes in the GC Chair info and inserts it into the gc_members database. The first 3 variables split up the name. dbID is tje id from before.
  try {
    $name = $_POST["gcChairName"];
    $parts = explode(" ", $name);
    $glast = array_pop($parts);
    $gfirst = implode(" ", $parts);
    $gemail = $_POST["gcChairEmail"];
    $gpass = $_POST["gcChairPassword"];
    //$gchair = 1;
    $sql = "INSERT INTO gc_members (email, password_digest, first_name, last_name, chair, semester_session_id) VALUES ('$gemail', '$gpass', '$gfirst', '$glast', 1, $dbID)";
    $dbh->query($sql);
    //echo "Successfully placed gcChair into database <br>";
  } catch (Exception $e) {
    echo "Please refresh and try again.<br>";
  }

  //The $POST for this returned a 2D array. The foreach loop accesses it to input the data into gc_members that aren't the chair for their semester.
  try
  {
    $member = $_POST[gcMembers][name];
    $memail = $_POST[gcMembers][email];
    $mpass = $_POST[gcMembers][password];
    //Key keeps track of the array index to access the other values for the same gc_member.
    foreach ($member as $key => $n)
    {
      $parts = explode(" ", $n);
      $glast = array_pop($parts);
      $gfirst = implode(" ", $parts);
      $gemail = $memail[$key];
      $gpass = $mpass[$key];

      $sql = "INSERT INTO gc_members (email, password_digest, first_name, last_name, chair, semester_session_id) VALUES ('$gemail', '$gpass', '$gfirst', '$glast', 0, $dbID)";
      $dbh->query($sql);
    }
  } catch (SDOException $e) {
    echo "Please refresh and try again.<br>";
  }

  //This block of code emails the owners of the newly created accounts. NEED TO SET UP TO WORK.
  $sth = $dbh->prepare("SELECT * FROM gc_members");
  $sth->execute();
  $result = $sth->fetchAll();

  foreach($result as $r)
  {
    if($r['semester_session_id'] == $dbID)
    {
      emailGC($r['email'], $r['email'], $r['password_digest']);
    }
  }
  echo "Semester Session successfully created.<br>";

}
?>

<?php
//Function to email.
function emailGC($address, $id, $pass)
{
  $subject = "GTAMS account information (AUTOMATED MAIL, DO NOT REPLY)";
  $siteLink = "http://localhost/gtams/public_html/login.php";
  $home = "http://localhost/gtams/public_html/";
  $headers = "From: group1.cop4710@gmail.com";
  $body1 = "An account has been created for you in the GTAMS application system. Your user id is " . $id . " and the password is " . $pass . ". Username and password can be changed at: " . $siteLink . "   and the site home page is: " . $home;

  $res = mail($address, $subject, $body1, $headers);
  //echo "<br>The email/id/pass is: " . $address . " " . $id . " " . $pass . "<br>";
  //var_export($res);
}
?>
