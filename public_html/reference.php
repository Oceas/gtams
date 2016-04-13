<?php
   require "header.php";
   if (!empty($_POST)) {
      //Variable from advisor form
      $sessID = $_GET["sessionId"];
      $pid = $_GET["pid"];
      $letterText = $_POST["advisementLetterTyped"];
      var_export($letterText);

      $sql = "UPDATE applicants SET letter=".$letterText." WHERE pid=".$pid." AND semester_session_id=".$sessionId;
      $sht->query(sql);






   }

?>
