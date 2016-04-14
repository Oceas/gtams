<?php
  //Find what the date is two days from now.
  $twodays = time() + (60*60*48);
  //echo date("Y-m-d", $twodays);

  //Select current Semester Session ID.
  $sth = $dbh->prepare("SELECT MAX(id) AS max FROM semester_sessions");
  $sth-> execute();
  $result = $sth->fetchAll();

  //Set the result from before as $curSem. (Current Semester)
  foreach ($result as $r)
  {
    $curSem = $r['max'];
  }

  //Grab the form and letter deadlines from the current semester to compare.
  $sth = $dbh->prepare("SELECT s.form_deadline, s.letter_deadline FROM semester_sessions s WHERE s.id = " . $curSem);
  $sth->execute();
  $result = $sth->fetchAll();

  foreach ($result as $r)
  {
    $appDead = $r['form_deadline'];
    $letDead = $r['letter_deadline'];
  }

  //Turn the SQL Timestamp formats into UNIX Timestamp Formats
  $letDeadTS = strtotime($letDead);
  $appDeadTS = strtotime($appDead);

  //2-Day Warning Functions.
  $sth = $dbh->prepare("SELECT count(*) AS total FROM applicants WHERE semester_session_id = " . $curSem);
  $sth->execute();
  $result = $sth->fetchAll();

foreach ($result as $r)
{
  $currApplicants = $r['total'];
}

if ($currApplicants > 0)
{
  warning($twodays, $letDead, $curSem, $dbh);
  checkStatus($appDeadTS, $letDeadTS, $curSem, $dbh);
}
?>

<?php
//Function to check for 2-days
function warning ($twodays, $letDeadTS, $curSem, $dbh)
{
  //echo "WARNING! WARNING! WARNING!";
  //Checks if the letter deadline is within two days but still ahead of today.
  if ($letDeadTS <= $twodays && $letDeadTS >= time() )
  {
    $sth = $dbh->prepare("SELECT a.pid, a.first_name, a.last_name, a.advisor_verified, a.warning_sent FROM applicants a WHERE a.semester_session_id = 3");
    $sth->execute();
    $results = $sth->fetchAll();

    foreach ($results as $r)
    {
      if(!$r['advisor_verified'] && !$r['warning_sent'])
      {
        $sth = $dbh->prepare("SELECT ad.email FROM advisors ad, applicant_advisors a, applicants ap WHERE ad.id = a.advisor_id && ap.pid = a.applicant_pid && ap.pid = ".$r['pid']." && a.current = true");
        $sth->execute();
        $address = $sth->fetchAll();

        foreach ($address as $a)
        {
          emailAD($a['email'], $r['first_name']. " ".$r['last_name']);
          $setTrue = "UPDATE applicants SET warning_sent = true WHERE pid = " . $r['pid'];
          $dbh->query($setTrue);
        }
      }
    }
  }
}
 ?>

<?php
function checkStatus($appDeadTS, $letDeadTS, $curSem, $dbh)
{
  $sth = $dbh->prepare("SELECT pid, created_at, semester_session_id, advisor_verified, application_status FROM applicants WHERE semester_session_id = " . $curSem);
  $sth->execute();
  $result = $sth->fetchAll();

  foreach($result as $r)
  {
    //Checks to see if the application was created after the application deadline.
    //If so, set application_status to 2 and return.
    $createdAt = strtotime($r['created_at']);
    if($createdAt > $appDeadTS && $r['application_status'] == 0)
    {
      $deadlinePassed = "UPDATE applicants SET application_status = 2 WHERE pid = " . $r['pid'];
      $dbh->query($deadlinePassed);
      echo "Applicant set to application deadline passed <br>";
      continue;
    }

  //  If the application was created before the deadline, then check to see if the letter
  //  deadline has passed. If so, set the application_status to 3 as needed.

    else if(!$r['advisor_verified'] && $r['application_status'] == 0)
    {
      if(time() > $letDeadTS)
      {
        $deadlinePassed = "UPDATE applicants SET application_status = 3 WHERE pid = " . $r['pid'];
        $dbh->query($deadlinePassed);
        echo "Applicant set to letter deadline passed <br>";
        continue;
      }
    }
  }
}
?>

 <?php
 //Function to email.
 function emailAD($address, $sname)
 {
   $subject = "GTAMS 2-Day Warning (AUTOMATED MAIL, DO NOT REPLY)";
   $siteLink = "http://localhost/gtams/public_html/login.php";
   $home = "http://localhost/gtams/public_html/";
   $headers = "From: group1.cop4710@gmail.com";
   $body1 = "This is an automated 2-Day warning. You have less than 48 Hours to submit a letter to the GTAMS system. Failure to submit a letter will result in the disqualification of " . $sname . ".<br>";

   $res = mail($address, $subject, $body1, $headers);
   //echo "<br>The email/id/pass is: " . $address . " " . $id . " " . $pass . "<br>";
   //var_export($res);
 }
 ?>
