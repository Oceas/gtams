<?php
if (!empty($_POST)) {
    require "header.php";
} else {
   header('Location: dashboard.php');
}

 $sth = $dbh->prepare("SELECT * from applicants WHERE ".$_POST['pid']." = pid");
 $sth->execute();
 $apData = $sth->fetchAll();

 foreach ($apData as $n) {
   $applicantsData = $n;
 }


if( $applicantsData['phd_of_cs'] == 1)
{
  $phd = "Yes";
} else {
  $phd = "No";
}

if( $applicantsData['passed_speak'] == 1)
{
  $speak = "Yes";
} else {
  $speak = "No";
}

 $sth = $dbh->prepare("SELECT * from grad_courses WHERE ".$_POST['pid']." = applicant_pid");
 $sth->execute();
 $GCData = $sth->fetchAll();

 $sth = $dbh->prepare("SELECT * from publications WHERE ".$_POST['pid']." = applicant_pid");
 $sth->execute();
 $pubData = $sth->fetchAll();

 $sth = $dbh->prepare("SELECT advisor_id from applicant_advisors WHERE ".$_POST['pid']." = applicant_pid && 1 = current");
 $sth->execute();
 $curr = $sth->fetchAll();

 foreach ($curr as $n) {
   $currID = $n;
 }

 $sth = $dbh->prepare("SELECT * from advisors WHERE ". $currID['advisor_id']." = id");
 $sth->execute();
 $currAll = $sth->fetchAll();

 foreach ($currAll as $n) {
   $currDone = $n;
 }

 $sth = $dbh->prepare("SELECT * from applicant_advisors WHERE ".$_POST['pid']." = applicant_pid && 0 = current");
 $sth->execute();
 $PrevAd = $sth->fetchAll();

?>

<div class="row">
    <div class="six columns">
        <label>Application Status</label>
          <input class="u-full-width" type="text" placeholder=
          <?php
            if($applicantsData['application_status'] == 0){
              echo "Currently-Being-Reviewed";
            }elseif ($applicantsData['application_status'] == 2) {
              echo "Application-Deadline-Missed";
            }elseif ($applicantsData['application_status'] == 3) {
              echo "Advisor-Letter-Deadline-Missed";
            }
          ?>
          readonly>
    </div>
</div>

<div class="row">
    <div class="six columns">
        <label>First Name</label>
        <input class="u-full-width" type="text" placeholder= <?php echo $applicantsData['first_name']; ?> readonly>
    </div>
    <div class="six columns">
        <label>Last Name</label>
        <input class="u-full-width" type="text" placeholder=<?php echo $applicantsData['last_name']; ?> readonly>
    </div>
</div>
<div class="row">
    <div class="six columns">
        <label>Knights Email</label>
        <input class="u-full-width" type="email" placeholder=<?php echo $applicantsData['email']; ?> readonly>
    </div>
    <div class="six columns">
        <label>UCFID: (formerly PID:no letter)</label>
        <input class="u-full-width" type="text" placeholder=<?php echo $applicantsData['pid']; ?> readonly>
    </div>
</div>
<div class="row">
    <div class="six columns">
        <label>Phone Number</label>
        <input class="u-full-width" type="text" placeholder= <?php echo $applicantsData['phone_number']; ?> readonly>
    </div>
</div>
<div class="row">
    <div class="six columns">
        <label>Is a PH.D.Computer Science Student</label>
        <input class="u-full-width" type="text" placeholder= <?php echo $phd; ?> readonly>
    </div>
    <div class="six columns">
        <label>Has passed the SPEAK Test</label>
        <input class="u-full-width" type="text" placeholder=<?php echo $speak; ?> readonly>
    </div>
</div>
<div class="row">
    <div class="six columns">
        <label>Number of semesters (including summers) working as a graduate teaching assistant</label>
        <input class="u-full-width" type="text" placeholder=<?php echo $applicantsData['student_semesters']; ?> readonly>
    </div>
    <div class="six columns">
        <label>Number of semester (including summers) working as a graduate student</label>
        <input class="u-full-width" type="text" placeholder=<?php echo $applicantsData['employee_semesters']; ?> readonly>
    </div>
</div>
<div class="row">
    <div class="six columns">
        <label>Current GPA</label>
        <input class="u-full-width" type="text" placeholder= <?php echo $applicantsData['gpa']; ?> readonly>
    </div>
</div>
<div class="row">
    <table class="u-full-width grey-text">
        <thead>
        <tr>
            <th>Graduate Courses Completed</th>
            <th>Grade Earned</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($GCData as $n) {
          echo "<tr>";
            echo "<td>".$n['course_name']."</td>";
            echo "<td>".$n['grade']."</td>";
          echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<div class="row">
    <table class="u-full-width grey-text">
        <thead>
        <tr>
            <th>Publications</th>
            <th>Publication Citation Information</th>
        </tr>
        </thead>
        <tbody>
          <?php
          foreach ($pubData as $key => $n) {
            echo "<tr>";
              echo "<td>".$n['title']."</td>";
              echo "<td>".$n['citation']."</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="six columns">
        <label>Name of current Ph.D. advisor at UCF</label>
        <input class="u-full-width" type="text" placeholder= <?php echo $currDone['name']; ?> readonly>
    </div>
    <div class="six columns">
        <label>Current Ph.D. advisor's email</label>
        <input class="u-full-width" type="text" placeholder=<?php echo $currDone['email']; ?> readonly>
    </div>
</div>
<div class="row">
    <table class="u-full-width grey-text">
        <thead>
        <tr>
            <th>Name of previous Ph.D. advisors at UCF</th>
            <th>From</th>
            <th>Till</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($PrevAd as $n) {
          $sth = $dbh->prepare("SELECT name from advisors WHERE ".$n['advisor_id']." = id");
          $sth->execute();
          $PrevName = $sth->fetchAll();

          foreach ($PrevName as $key) {
            $name = $key['name'];
          }
          echo "<tr>";
            echo "<td>".$name."</td>";
            echo "<td>".$n['time_period_start']."</td>";
            echo "<td>".$n['time_period_end']."</td>";
          echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<!--If a text advisor's letter is available display-->
<div class="row">
    <div class="twelve columns">
        <label>Advisor's Letter</label>
        <textarea style="height:150px;" class="u-full-width" placeholder="Filler Text" readonly></textarea>
    </div>
</div>
<!--If a file is available display this-->
<div class="row">
    <div class="six columns">
        <input class="u-full-width button-primary" type="button" value="Download Advisor's Letter">
    </div>
</div>
<hr>
<form method="post">
    <div class="row">
        <div class="six columns">
            <label>Your Score for the Student</label>
            <input class="u-full-width button-primary" type="text" name="score" placeholder="80">
        </div>
    </div>
    <div class="row">
        <div class="six columns">
            <input class="u-full-width button-primary" type="button" name="submitScore" value="Submit Score">
        </div>
    </div>
</form>
