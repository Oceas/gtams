<?php
if (!empty($_POST)) {
    require "header.php";
} else {
   header('Location: dashboard.php');
}


?>

<div class="row">
    <div class="six columns">
        <label>First Name</label>
        <input class="u-full-width" type="text" placeholder="John" readonly>
    </div>
    <div class="six columns">
        <label>Last Name</label>
        <input class="u-full-width" type="text" placeholder="Doe" readonly>
    </div>
</div>
<div class="row">
    <div class="six columns">
        <label>Knights Email</label>
        <input class="u-full-width" type="email" placeholder="johndoe@knights.ucf.edu" readonly>
    </div>
    <div class="six columns">
        <label>UCFID: (formerly PID:no letter)</label>
        <input class="u-full-width" type="text" placeholder="1234567" readonly>
    </div>
</div>
<div class="row">
    <div class="six columns">
        <label>Phone Number</label>
        <input class="u-full-width" type="text" placeholder="123-456-7890" readonly>
    </div>
</div>
<div class="row">
    <div class="six columns">
        <label>Is a PH.D.Computer Science Student</label>
        <input class="u-full-width" type="text" placeholder="Yes" readonly>
    </div>
    <div class="six columns">
        <label>Has passed the SPEAK Test</label>
        <input class="u-full-width" type="text" placeholder="Yes" readonly>
    </div>
</div>
<div class="row">
    <div class="six columns">
        <label>Number of semesters (including summers) working as a graduate teaching assistant</label>
        <input class="u-full-width" type="text" placeholder="2" readonly>
    </div>
    <div class="six columns">
        <label>Number of semester (including summers) working as a graduate student</label>
        <input class="u-full-width" type="text" placeholder="5" readonly>
    </div>
</div>
<div class="row">
    <div class="six columns">
        <label>Current GPA</label>
        <input class="u-full-width" type="text" placeholder="3.25" readonly>
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
        <tr>
            <td>COP XXXX</td>
            <td>B</td>
        </tr>
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
        <tr>
            <td>Changes in XXXXXX for XXXXXX</td>
            <td>ACM: 2016 XXXX</td>
        </tr>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="six columns">
        <label>Name of current Ph.D. advisor at UCF</label>
        <input class="u-full-width" type="text" placeholder="Dr. John Doe" readonly>
    </div>
    <div class="six columns">
        <label>Current Ph.D. advisor's email</label>
        <input class="u-full-width" type="text" placeholder="example@ucf.edu" readonly>
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
        <tr>
            <td>Dr. Jane Doe</td>
            <td>02/04/2015</td>
            <td>08/04/2016</td>
        </tr>
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
<div class="row">
    <div class="six columns">
        <input class="u-full-width button-primary" type="button" value="Submit Score">
    </div>
</div>