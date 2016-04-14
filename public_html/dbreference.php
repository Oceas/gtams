<?php 
   require "dbopen.php"; 
   if (!empty($_POST)) {

   $pid = $_POST['pid'];
   $sessionId = $_POST['sessionId'];
      if(isset($_FILES['advisementLetterUpload'])){
         $file = $_FILES["advisementLetterUpload"]["name"];
         var_dump($file);
         $allowed = array('pdf');
         $fileTemp = $_FILES["advisementLetterUpload"]["tmp_name"];
         var_dump($fileTemp); 
         $file_ext = explode('.', $file);
         $file_ext = strtolower(end($file_ext));
         var_dump($file_ext);
         if(strcmp($file_ext, 'pdf') == 0 ){
            $fileNameNew = uniqid('', true) . '.' . $file_ext;
            $file_destination = 'uploads/' . $fileNameNew;
            var_dump($file_destination);
            if(move_uploaded_file($fileTemp, $file_destination)){
              var_dump($file_destination);
              $sql = "UPDATE applicants SET letter_pdf='".$file_destination."' WHERE pid='".$pid."' AND semester_session_id='".$sessionId."';";
            }
       else {
         $letterText = $_POST["advisementLetterTyped"];
         $sql = "UPDATE applicants SET letter='".$letterText."' WHERE pid='".$pid."' AND semester_session_id='".$sessionId."';";
         
       }
      }
      }
     $dbh->query($sql);
   }
?>
