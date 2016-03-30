<form>
    <div class="row">
        <div class="twelve columns text-center">
            <h3>GTA Registration Form</h3>
        </div>
    </div>
    <div class="row">
        <div class="six columns">
            <label for="firstName">First Name</label>
            <input class="u-full-width" type="text" placeholder="John" id="firstName">
        </div>
        <div class="six columns">
            <label for="lastName">Last Name</label>
            <input class="u-full-width" type="text" placeholder="Doe" id="lastName">
        </div>
    </div>
    <div class="row">
        <div class="six columns">
            <label for="email">Knights Email</label>
            <input class="u-full-width" type="email" placeholder="example@knights.ucf.edu" id="email">
        </div>
        <div class="six columns">
            <label for="ucfid">UCFID: (formerly PID:no letter)</label>
            <input class="u-full-width" type="text" placeholder="1324567" id="ucfid">
        </div>
    </div>
    <div class="row">
        <div class="six columns">
            <label for="password">Password</label>
            <input class="u-full-width" type="password" id="password">
        </div>
        <div class="six columns">
            <label for="confirmPassword">Confirm Password</label>
            <input class="u-full-width" type="password" id="confirmPassword">
        </div>
    </div>
    <div class="row">
        <div class="six columns">
            <label for="phoneNumber">Phone Number</label>
            <input class="u-full-width" type="tel" placeholder="123-456-7890" id="phoneNumber">
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
            <input class="u-full-width" type="text" placeholder="0" id="semestersGS">
        </div>
        <div class="six columns">
            <label for="speakTest">Have you passed the SPEAK Test?</label>
            <select class="u-full-width" id="speakTest">
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
            <label for="semestersGTA">Number of semesters (including summers) working as a graduate teaching assistant</label>
            <input class="u-full-width" type="text" placeholder="0" id="semestersGTA">
        </div>
    </div>
    <input class="button-primary" type="submit" value="Submit">
</form>