<?php
  require "header.php";

  if (!empty($_POST)) {
    //Variable from the register form
    $fname = $_POST["firstName"];
    $lname = $_POST["lastName"];
    $email = $_POST["email"];
    $pid = $_POST["ucfid"];
    $pnumber = $_POST["phoneNumber"];
    $sgs = $_POST["semestersGS"];
    $gta = $_POST["semestersGTA"];
    $currA = $_POST["currentAdvisor"];
    $currAE = $_POST["currentAdvisorEmail"];
    $gradc = $_POST[graduateCourse][course];
    $gradg = $_POST[graduateCourse][grade];
    $pub = $_POST[publications][publication];
    $pub2 = $_POST[publications][citation];
    $from = $_POST[previousAdivsors][from];
    $till = $_POST[previousAdivsors][till];

    $phd = 0;
    if ($_POST["csStudent"] == 'yes') {
      $phd = 1;
    }

    $speak = 0;
    if ($_POST["speakTest"] == 'yes') {
      $speak = 1;
    }

    $sess = $_POST["session"];
    $sth = $dbh->prepare("SELECT id FROM semester_sessions WHERE name = '$sess'");
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);

    foreach ($result as $key => $value) {
      $sessId = $value;
    }

    $sth = $dbh->prepare("SELECT MAX(link_id) FROM applicants");
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);

    foreach ($result as $key => $value) {
      $linkId = $value;
    }
    $linkId = $linkId+1;

    //Passing data for Applicant Table
    $tot = 0;
    $count = 0;

    foreach ($gradg as $key => $n) {
      if(strcmp($n,"A") == 0){
        $tot += 4;
      }elseif (strcmp($n,"B") == 0){
        $tot += 3;
      }elseif (strcmp($n,"C") == 0){
        $tot += 2;
      }elseif (strcmp($n,"D") == 0){
        $tot += 1;
      }
      $count++;
    }

    $gpa = $tot/$count;

    $sql = "INSERT INTO applicants (pid, email, first_name, last_name, phone_number, phd_of_cs, passed_speak, employee_semesters, student_semesters, semester_session_id, link_id,gpa)
            VALUES
            ($pid, '$email', '$fname', '$lname', $pnumber, $phd, $speak, $gta, $sgs, $sessId,$linkId,$gpa)";
    $res = $dbh->query($sql);
    $flag = 0;
    if (!$res) {
      echo "Errormessage: applicants insert failed"."<br>";
      $flag++;
    }

    //Passing data for current advisor
    $sth = $dbh->prepare("SELECT id FROM advisors WHERE email = '$currAE'");
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);

    $advisorId = '';
    foreach ($result as $key => $value) {
      $advisorId = $value;
    }

    $sql = "INSERT INTO applicant_advisors (current, applicant_pid, advisor_id) VALUES (1 ,$pid, $advisorId)";
    $res = $dbh->query($sql);

    if (!$res) {
      echo "Errormessage: applicant_advisors insert failed"."<br>";
      $flag++;
    }
    //Passing data for grad_courses Table
    foreach ($gradc as $key => $n) {

      $gradeVal = 0;
      if(strcmp($gradg[$key],'A') == 0){
        $gradeVal = 4;
      }elseif (strcmp($gradg[$key],'B') == 0){
        $gradeVal = 3;
      }elseif (strcmp($gradg[$key],'C') == 0){
        $gradeVal = 2;
      }elseif (strcmp($gradg[$key],'D') == 0){
        $gradeVal = 1;
      }

      $sql = "INSERT INTO grad_courses (course_name, grade, applicant_pid) VALUES ('$n',$gradeVal,$pid)";
      $res = $dbh->query($sql);

      if (!$res) {
        echo "Errormessage: grad_courses insert failed"."<br>";
        $flag++;
      }
    }

    //Passing data for publications Tables
    foreach ($pub as $key => $n) {
      $sql = "INSERT INTO publications (title, citation, applicant_pid) VALUES ('$n', '$pub2[$key]', $pid)";
      $res = $dbh->query($sql);

      if (!$res) {
        echo "Errormessage: publications insert failed"."<br>";
        $flag++;
      }
    }

    //Passing data for prev advisors
    //The hard coded 1 is for the past advisors
    foreach ($from as $key => $n) {
      $from = date("Y-m-d H:i:s", strtotime($n));
      $end = date("Y-m-d H:i:s", strtotime($till[$key]));
      $sql = "INSERT INTO applicant_advisors (current, applicant_pid, advisor_id, time_period_start, time_period_end) VALUES (0 ,$pid, 1, '$from', '$end')";
      $res = $dbh->query($sql);

      if (!$res) {
        echo "Errormessage: prev applicant_advisors insert failed"."<br>";
        $flag++;
      }
    }

    if($flag == 0)
    {
      echo "Submited"."<br>";
    }
  }
?>
