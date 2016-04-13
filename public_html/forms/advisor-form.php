<form formdatamethod="post" enctype="multipart/form-data">
 <div class="row">
     <div class="twelve columns text-center">
         <h3>Advisor Form</h3>
         <p>Please type in your advisement letter on the left and click submit. Or upload a pdf on the right and click submit.
          <b>Do not enter in both.</b></p>
     </div>
 </div>
 <div class="row">
     <div class="six columns">
         <label>Type Advisement Letter</label>
         <textarea style="height:300px;" class="u-full-width"  name="advisementLetterTyped"></textarea>
     </div>
     <div class="one columns">
         <div class="verticaldivide"></div>
     </div>
     <div class="five columns">
         <label >Upload Advisement Letter</label>
         <input class="u-full-width"  type="file" name="advisementLetterUpload">
     </div>
 </div>
 <input class="button-primary" type="submit" value="Submit">
</form>


<?php 
require "reference.php"
 ?>
