<?php
$page_title = "Register";
require "header.php";
?>

<div class="row">
    <div class="twelve columns text-center">
        <h3>Graduate Coordinator Dashboard</h3>
        <p>To view more information about an application including letters, scoring comments,
            or to leave a score simply click on the applicants row</p>
    </div>
</div>
<table class="u-full-width">
    <thead>
    <tr>
        <th>Nominator</th>
        <th>Nominee</th>
        <th>Anderson Score</th>
        <th>Ashley Score</th>
        <th>Hua Score</th>
        <th>Average Score</th>
    </tr>
    </thead>
    <tbody>
    <tr id="1">
        <td>Dr. Mark Heinrich</td>
        <td>Scott Anderson</td>
        <td>89</td>
        <td>100</td>
        <td>100</td>
        <td>Priceless</td>
    </tr>
    <tr>
        <td>Dr. Mark Heinrich</td>
        <td>Timothy Ashley</td>
        <td>89</td>
        <td>100</td>
        <td>100</td>
        <td>Priceless</td>
    </tr>
    <tr>
        <td>Dr. Mark Heinrich</td>
        <td>Brandon Aulet</td>
        <td>89</td>
        <td>100</td>
        <td>100</td>
        <td>Priceless</td>
    </tr>
    <tr>
        <td>Dr. Mark Heinrich</td>
        <td>Ussama Azam</td>
        <td>89</td>
        <td>100</td>
        <td>100</td>
        <td>Priceless</td>
    </tr>
    <tr>
        <td>Dr. Mark Heinrich</td>
        <td>Joshua Barrington</td>
        <td>89</td>
        <td>100</td>
        <td>100</td>
        <td>Priceless</td>
    </tr>
    </tbody>
</table>

<div id="userDialog" class="dialog hidden">
    <div class="dialog-body">
        <div class="dialog-header">
            <div class="row">
                <div class="six columns">
                    Scott Anderson's Record
                </div>
                <div class="six columns">
                    <span id="closeUserDialog" class="close">×</span>
                </div>
            </div>
        </div><!--   End of Dialog Header     -->
    <div class="dialog-content">
        <div class="row">
            Applicant Information
        </div>
        <div class="row">
            Advisor Information
        </div>
        <div class="row">
            GCS Scores
        </div>
        <div class="row">
            Leave a score
        </div>
    </div>
    </div>
</div>

<script>
    var dialog = document.getElementById("userDialog");
    var record = document.getElementById("1");
    var closeBtn = document.getElementById("closeUserDialog");

    record.onclick = function(){
        console.log("Show User Dialog");
        dialog.classList.remove("hidden");
    }

    closeBtn.onclick = function(){
        console.log("Hide User Dialog");
        dialog.classList.add("hidden");
    }
</script>

<?php
require "footer.php";
?>
