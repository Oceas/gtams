<?php
   require "dbopen.php";
   if (!empty($_POST)) {

      if(isset($_FILES['advisementLetterUpload'])){
         var_dump($_FILES);
         $allowed = array('pdf');
         $file = $_FILES["advisementLetterUpload"];
         $fileName = $file["advisementLetterUpload"]['name'];
         $fileTemp = $file["advisementLetterUpload"]['tmp_name'];

        //$var_dump($_POST);
        $file_ext = explode('.', $fileName);
        $file_ext = strtolower(end($file_ext));

        if(in_array($file_ext, $allowed)){
            $var_dump($_POST);
            $fileNameNew = uniqid('', true) . '.' . $file_ext;
            $file_destination = 'uploads/' . $fileNameNew;
            if(move_uploaded_file($fileTemp, $file_destination)){
               var_dump($file_destination);
            }
         }
      }
      //Variable from advisor form
      $letterText = $_POST["advisementLetterTyped"];
      $letterFile = $_FILES["advisementLetterUpload"];
      var_dump($letterFile);
      $pid = $_POST["pid"];
      var_dump($letterFile);
      $sessionId = $_POST["sessionId"];

      $file_ext = explode('.', $letterFile);
      $file_ext = strtolower(end($file_ext));
      $fileTempLoc = $letterFile["advisementLetterUpload"]['tmp_name'];
      $allowed = array('pdf');



      if (isset($letterFile)) {
         $sql = "UPDATE applicants SET letter_pdf='".$letterFile."' WHERE pid='".$pid."' AND semester_session_id='".$sessionId."' ORDER BY created_at desc limit 1;";
      } else {
         $sql = "UPDATE applicants SET letter='".$letterText."' WHERE pid='".$pid."' AND semester_session_id='".$sessionId."' ORDER BY created_at desc limit 1;";
      }
      $dbh->query($sql);
   }
?>
