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
<div class="row">
    <div class="four columns">
        <label>Current Session</label>
        <select class="u-full-width" name="session">
            <?php
            $sth = $dbh->prepare("SELECT name FROM semester_sessions");
            $sth->execute();
            $result = $sth->fetchAll();

            foreach ($result as $key) {
                echo "<option>" . $key['name'] . "</option>";
                echo $key['name'] . "<br>";
            }
            ?>
        </select>
    </div>
</div>
<div clas="row">
    <table class="u-full-width">
        <thead>
        <tr>
            <th>Advisor</th>
            <th>Nominee</th>
            <?php
            //Selects the GC members to dynamically add table horizontally. TODO: Add a dropdown bar to pick semester session names to check past sessions, then use session id to limit gc_members.
            $sth = $dbh->prepare("SELECT * FROM gc_members");
            $sth->execute();
            $gcmems = $sth->fetchAll();
            $count = 0;
            foreach ($gcmems as $r) {
                echo "<th>" . $r['last_name'] . " Score</th>";
                $count++;
            }
            ?>
            <th>Average Score</th>
        </tr>
        </thead>
        <tbody>
        <?php
        //Basically an sql query that makes the table for us.
        $sth = $dbh->prepare("select ad.name, ap.first_name, ap.last_name, ap.pid from advisors ad, applicants ap, applicant_advisors aa
      where aa.applicant_pid=ap.pid && aa.advisor_id=ad.id
      order by ad.name");
        $sth->execute();
        $result = $sth->fetchAll();
        //This does the dynamic allocation vertically. It goes through the given gc_members and places their score.
        foreach ($result as $key) {
            echo "<tr id = '1'>";
            echo "<td>" . $key['name'] . "</td>";
            echo "<td>" . $key['first_name'] . " " . $key['last_name'] . "</td>";
            $avg = 0;
            $sum = 0;
            $count = 0;
            foreach ($gcmems as $r) {
                $sth = $dbh->prepare("SELECT s.value FROM gc_scores s, applicants a, gc_members g WHERE a.semester_session_id = g.semester_session_id && s.applicants_pid = a.pid && s.gc_members_id = g.id && a.pid = " . $key['pid'] . " && g.id = " . $r['id']);
                $sth->execute();
                $gcval = $sth->fetchAll();
                foreach ($gcval as $g) {
                    $actualval = $g['value'];
                }
                $sum += $actualval;
                $count++;
                echo "<td>" . $actualval . "</td>";
            }
            $avg = $sum / $count;
            echo "<td>$avg</td>";
            echo "</tr>";
        }

        //  TODO: Add code to make the rest of the table create popups. Then output the information to the popup and allow for score changing.
        ?>
        </tbody>
    </table>
</div>

<script>
    var dialog = document.getElementById("userDialog");
    var record = document.getElementById("1");
    var closeBtn = document.getElementById("closeUserDialog");

    record.onclick = function () {
        console.log("Show User Dialog");
        dialog.classList.remove("hidden");
    }

    closeBtn.onclick = function () {
        console.log("Hide User Dialog");
        dialog.classList.add("hidden");
    }
</script>

<?php
require "footer.php";
?>
