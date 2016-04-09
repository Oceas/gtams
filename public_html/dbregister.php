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

    $phd = 0;
    if ($_POST["csStudent"] == 'yes') {
      $phd = 1;
    }

    $speak = 0;
    if ($_POST["speakTest"] == 'yes') {
      $speak = 1;
    }

    $sess = $_POST["session"];
    $sth = $db->prepare("SELECT id FROM semester_sessions WHERE name = '$sess'");
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);

    foreach ($result as $key => $value) {
      $sessId = $value;
    }

    $sth = $db->prepare("SELECT MAX(link_id) FROM applicants");
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);

    foreach ($result as $key => $value) {
      $linkId = $value;
    }
    $linkId = $linkId+1;

    //Passing data for Applicant Table
    $sql = "INSERT INTO applicants (pid, email, first_name, last_name, phone_number, phd_of_cs, passed_speak, employee_semesters, student_semesters, semester_session_id, link_id)
            VALUES
            ($pid, '$email', '$fname', '$lname', $pnumber, $phd, $speak, $gta, $sgs, $sessId,$linkId)";
    $db->query($sql);

    //Passing data for current advisor
    $sth = $db->prepare("SELECT id FROM advisors WHERE email = '$currAE'");
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);

    $advisorId = '';
    foreach ($result as $key => $value) {
      $advisorId = $value;
    }

    $sql = "INSERT INTO applicant_advisors (current, applicant_pid, advisor_id) VALUES (1 ,$pid, $advisorId)";
    $db->query($sql);

    //Passing data for grad_courses Table
    $gradc = $_POST[graduateCourse][course];
    $gradg = $_POST[graduateCourse][grade];

    foreach ($gradc as $key => $n) {
      $sql = "INSERT INTO grad_courses (course_name, grade, applicant_pid) VALUES ('$n', '$gradg[$key]', $pid)";
      $db->query($sql);
    }

    //Passing data for publications Tables
    $pub = $_POST[publications][publication];
    $pub2 = $_POST[publications][citation];

    foreach ($pub as $key => $n) {
      $sql = "INSERT INTO publications (title, citation, applicant_pid) VALUES ('$n', '$pub2[$key]', $pid)";
      $db->query($sql);
    }

    //Passing data for prev advisors
    $from = $_POST[previousAdivsors][from];
    $till = $_POST[previousAdivsors][till];

    foreach ($from as $key => $n) {
      $sql = "INSERT INTO applicant_advisors (current, applicant_pid, advisor_id, time_period_start, time_period_end) VALUES (0 ,$pid, 1, $n, $till[$key])";
      $db->query($sql);
    }
  }
?>
