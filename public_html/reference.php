<?php
   //require "header.php";
   if (!empty($_POST)) {
      //Variable from advisor form
      $sessId = $_GET["sessionId"];
      echo $sessId;
      $pid = $_GET["pid"];
      $letterText = $_POST["advisementLetterTyped"];

      $sql = "UPDATE applicants SET letter='$letterText' WHERE pid='$pid' AND semester_session_id='$sessId'";
      var_dump($sql);
      //die;
      $dbh->query($sql);






   }

?>
