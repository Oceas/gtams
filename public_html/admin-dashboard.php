<form>
    <div class="row">
        <div class="twelve columns text-center">
            <h3>Create New Application Session</h3>
        </div>
        <div class="row">
            <div class="six columns">
                <label>Application Submission Deadline</label>
                <input class="u-full-width" type="date" id="submissionDeadlineDate">
            </div>
            <div class="six columns">
                <label>Academic Advisor Letter Deadline</label>
                <input class="u-full-width" type="date" id="letterDeadlineDate">
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="six columns">
                    <label>Name of the GTA Chair</label>
                </div>
                <div class="three columns">
                    <label>Email</label>
                </div>
                <div class="three columns">
                    <label>Password</label>
                </div>
            </div>
            <div class="dynamic-list">
                <div class="six columns">
                    <input class="u-full-width" placeholder="Dr. Jane Doe" type="text"
                           name="gcChairName">
                </div>
                <div class="three columns">
                    <input class="u-full-width" type="email" placeholder="example@ucf.edu" name="gcChairEmail">
                </div>
                <div class="three columns">
                    <input class="u-full-width" type="password" name="gcChairPassword">
                </div>

            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="six columns">
                    <label>Name of Other GC Members</label>
                </div>
                <div class="three columns">
                    <label>Email</label>
                </div>
                <div class="two columns">
                    <label>Password</label>
                </div>
            </div>
            <div class="dynamic-list">
                <div class="six columns">
                    <input class="u-full-width" placeholder="Dr. Jane Doe" type="text"
                           name="gcMembers[name][]">
                </div>
                <div class="three columns">
                    <input class="u-full-width" type="email" name="gcMembers[email][]">
                </div>
                <div class="two columns">
                    <input class="u-full-width" type="password" name="gcMembers[password][]">
                </div>
                <div class="one columns">
                    <input class="button-primary" type="submit" value="+">
                </div>
            </div>
        </div>
        <input class="button-primary" type="submit" value="Submit">
</form>