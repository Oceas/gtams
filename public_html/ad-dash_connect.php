<?php
if(!empty($_POST)){
  require "header.php";

  // ----------------ToDo : NEED ADMIN NAME FROM LOGIN INFORMATION-----------------
  try {
    $subDead = date("Y-m-d H:i:s", strtotime($_POST["submissionDeadlineDate"]));
    $letDead = date("Y-m-d H:i:s", strtotime($_POST["letterDeadlineDate"]));
    $adminame = $_POST["sessionName"];
    $sql = "INSERT INTO semester_sessions (name, form_deadline, letter_deadline) VALUES ('$adminame', '$subDead', '$letDead')";
    $dbh->query($sql);

    //$idSelect = "SELECT id FROM semester_sessions WHERE name = '$adminame', form_deadline = '$subDead'"
    $dbID = $dbh->lastInsertId();

    //echo "Successfully placed session data into database.<br>";
  } catch (SDOException $e) {
    //echo $e->getMessage();
  }

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
    die();
  }

  try
  {
    $member = $_POST[gcMembers][name];
    $memail = $_POST[gcMembers][email];
    $mpass = $_POST[gcMembers][password];
    foreach ($member as $key => $n)
    {
      //$name = "This is the name:" . $v['name'];
      //echo "The name is " .$n. " email is " . $memail[$key] . " and the password is " . $mpass[$key] . "<br>";
      $parts = explode(" ", $n);
      $glast = array_pop($parts);
      $gfirst = implode(" ", $parts);
      $gemail = $memail[$key];
      $gpass = $mpass[$key];
    //  echo "This is what's going in: " . $gemail . " " . $gpass . " " . $gfirst . " " . $glast . "<br>";
      $sql = "INSERT INTO gc_members (email, password_digest, first_name, last_name, chair, semester_session_id) VALUES ('$gemail', '$gpass', '$gfirst', '$glast', 0, $dbID)";
      $dbh->query($sql);
    }
    //echo "Successfully placed array data into database.<br>";
  } catch (SDOException $e) {
    //echo $e->getMessage();
  }

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
  echo "<br>The email/id/pass is: " . $address . " " . $id . " " . $pass . "<br>";
  var_export($res);
}
?>
