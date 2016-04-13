<?php
  $page_title = "Logout";
  require "header.php";
?>

<form action="ad-dash_connect.php" method="post">
  <div class="row">
     <div class="twelve columns text-center">
         <h3>Create New Application Session</h3>
     </div>
     <div class="row">
         <div class="twelve columns">
             <label>Name of Application Session</label>
             <input class="u-full-width" type="text" name="sessionName"/>
         </div>
     </div>
     <div class="row">
         <div class="six columns">
             <label>Application Submission Deadline</label>
             <input class="u-full-width" type="date" name="submissionDeadlineDate">
         </div>
         <div class="six columns">
             <label>Academic Advisor Letter Deadline</label>
             <input class="u-full-width" type="date" name="letterDeadlineDate">
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
             <div class="three columns">
                 <label>Password</label>
             </div>
         </div>
         <div id="dynamic-gcmembers" class="row">
             <div class="six columns">
                 <input class="u-full-width" placeholder="Dr. Jane Doe" type="text"
                        name="gcMembers[name][]">
             </div>
             <div class="three columns">
                 <input class="u-full-width" type="email" name="gcMembers[email][]">
             </div>
             <div class="three columns">
                 <input class="u-full-width" type="password" name="gcMembers[password][]">
             </div>
         </div>
         <div class="row">
             <div class="three columns">
                 <input class="u-full-width button-primary" type="button" onclick="addGCMember('dynamic-gcmembers');" value="Add Another GC Member">
             </div>
         </div>
     </div>
     <input class="button-primary" type="submit" value="Submit">
</form>

<script>
    function addGCMember(divName) {
        console.log("Clicked");
        var newdiv = document.createElement('div');
        newdiv.classList.add("row");
        newdiv.innerHTML = "<div class='six columns'>" + "<input class='u-full-width' placeholder='Dr. Jane Doe' type='text' name='gcMembers[name][]'>" + "</div>"
            + "<div class='three columns'>" + "<input class='u-full-width' type='email' name='gcMembers[email][]'>" + "</div>"
            + "<div class='three columns'>" + "<input class='u-full-width' type='password' name='gcMembers[password][]'>" + "</div>";
        document.getElementById(divName).appendChild(newdiv);
    }
</script>

<?php
  require "footer.php";
?>
