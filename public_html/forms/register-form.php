<form action="dbregister.php" method="post">
    <div class="row">
        <div class="twelve columns text-center">
            <h3>GTA Registration Form</h3>
        </div>
    </div>
    <div class="row">
        <div class="six columns">
            <label>Session Apply For</label>
            <select class="u-full-width" name="session">
              <?php
                    $sth = $db->prepare("SELECT name FROM semester_sessions");
                    $sth->execute();
                    $result = $sth->fetchAll();

                    foreach ($result as $key) {
                      echo "<option>" . $key['name'] . "</option>";
                    }
               ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="six columns">
            <label for="firstName">First Name</label>
            <input class="u-full-width" type="text" placeholder="John" name="firstName">
        </div>
        <div class="six columns">
            <label for="lastName">Last Name</label>
            <input class="u-full-width" type="text" placeholder="Doe" name="lastName">
        </div>
    </div>
    <div class="row">
        <div class="six columns">
            <label for="email">Knights Email</label>
            <input class="u-full-width" type="email" placeholder="example@knights.ucf.edu" name="email">
        </div>
        <div class="six columns">
            <label for="ucfid">UCFID: (formerly PID:no letter)</label>
            <input class="u-full-width" type="text" placeholder="1324567" name="ucfid">
        </div>
    </div>
    <div class="row">
        <div class="six columns">
            <label for="phoneNumber">Phone Number</label>
            <input class="u-full-width" type="tel" placeholder="123-456-7890" name="phoneNumber">
        </div>
        <div class="six columns">
            <label for="csStudent">Are you a PH.D. Student in Computer Science?</label>
            <div style="padding:10px;">
                <input type="radio" name="csStudent" value="yes" checked> Yes </input>
                <input type="radio" name="csStudent" style="margin-left: 20px;" value="no"> No </input>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="six columns">
            <label for="semestersGS">Number of semester (including summers) working as a graduate student</label>
            <input class="u-full-width" type="text" placeholder="0" name="semestersGS">
        </div>
        <div class="six columns">
            <label for="speakTest">Have you passed the SPEAK Test?</label>
            <select class="u-full-width" name="speakTest">
                <option value="null">Please select one</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
                <option value="graduateUSA">Graduated from a U.S. Institution</option>
                <option value="newlyAdmitted">Newly Admitted Student</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="six columns">
            <label for="semestersGTA">Number of semesters (including summers) working as a graduate teaching
                assistant</label>
            <input class="u-full-width" type="text" placeholder="0" name="semestersGTA">
        </div>
    </div>
    <div class="row">
        <div class="row">
            <div class="eight columns">
                <label>Graduate Courses Completed</label>
            </div>
            <div class="four columns">
                <label>Grade Earned</label>
            </div>
        </div>
        <div class="row">
            <div class="row" id="dynamic-course">
                <div class="eight columns">
                    <input class="u-full-width" placeholder="COP XXXX" type="text" name="graduateCourse[course][]">
                </div>
                <div class="four columns">
                    <input class="u-full-width" placeholder="B" type="text" name="graduateCourse[grade][]">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="three columns">
                <input class="u-full-width button-primary" type="button" onclick="addCourse('dynamic-course');" value="Add Another Course">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row">
            <div class="eight columns">
                <label>Publications</label>
            </div>
            <div class="four columns">
                <label>Publication Citation Information</label>
            </div>
        </div>
        <div class="dynamic-list" id="dynamic-publication">
            <div class="eight columns">
                <input class="u-full-width" placeholder="Changes in XXXXXX for XXXXXX" type="text"
                       name="publications[publication][]">
            </div>
            <div class="four columns">
                <input class="u-full-width" placeholder="ACM: 2016 XXXX" type="text" name="publications[citation][]">
            </div>
        </div>
        <div class="row">
            <div class="three columns">
                <input class="u-full-width button-primary" type="button" onclick="addPublication('dynamic-publication');" value="Add Another Publication">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="seven columns">
            <label for="currentAdvisorName">Name of current Ph.D. advisor at UCF</label>
            <input class="u-full-width" type="text" placeholder="Dr. John Doe" name="currentAdvisor">
        </div>
        <div class="five columns">
            <label for="currentAdvisorEmail">Current Ph.D. advisor's email</label>
            <input class="u-full-width" type="email" placeholder="example@ucf.edu" name="currentAdvisorEmail">
        </div>
    </div>
    <div class="row">
        <div class="row">
            <div class="six columns">
                <label>Name of previous Ph.D. advisors at UCF</label>
            </div>
            <div class="three columns">
                <label>From</label>
            </div>
            <div class="three columns">
                <label>Till</label>
            </div>
        </div>
        <div class="row">
            <div id="dynamic-advisor">
                <div class="six columns">
                    <input class="u-full-width" placeholder="Dr. Jane Doe" type="text"
                           name="previousAdivsors[advisor][]">
                </div>
                <div class="three columns">
                    <input class="u-full-width" type="date" name="previousAdivsors[from][]">
                </div>
                <div class="three columns">
                    <input class="u-full-width" type="date" name="previousAdivsors[till][]">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="three columns">
                <input class="u-full-width button-primary" type="button" onclick="addAdvisor('dynamic-advisor');" value="Add Another Advisor">
            </div>
        </div>
    </div>
    <hr/>
    <input class="button-primary" type="submit" value="Submit">
</form>

<script>

    function addCourse(divName) {
        console.log("Clicked");

        var newdiv = document.createElement('div');
        newdiv.classList.add("row");
        newdiv.innerHTML = "<div class='eight columns'>" + "<input class='u-full-width' placeholder='COP XXXX' type='text' name='graduateCourse[course][]'>" + "</div>"
            + "<div class='four columns'>" + "<input class='u-full-width' placeholder='B' type='text' name='graduateCourse[grade][]'>" + "</div>";
        document.getElementById(divName).appendChild(newdiv);
    }

    function addPublication(divName) {
        console.log("Clicked");

        var newdiv = document.createElement('div');
        newdiv.classList.add("row");
        newdiv.innerHTML = "<div class='eight columns'>" + "<input class='u-full-width' placeholder='Changes in XXXXXX for XXXXXX' type='text' name='publications[publication][]'>" + "</div>"
            + "<div class='four columns'>" + "<input class='u-full-width' placeholder='ACM: 2016 XXXX' type='text' name='publications[citation][]'>" + "</div>";
        document.getElementById(divName).appendChild(newdiv);
    }

    function addAdvisor(divName) {
        console.log("Clicked");

        var newdiv = document.createElement('div');
        newdiv.classList.add("row");
        newdiv.innerHTML = "<div class='six columns'>" + "<input class='u-full-width' placeholder='Dr. Jane Doe' type='text' name='previousAdivsors[advisor][]'>" + "</div>"
            + "<div class='three columns'>" + "<input class='u-full-width' type='date' name='previousAdivsors[from][]'>" + "</div>"
            + "<div class='three columns'>" + "<input class='u-full-width' type='date' name='previousAdivsors[till][]'>" + "</div>";
        document.getElementById(divName).appendChild(newdiv);
    }

</script>
