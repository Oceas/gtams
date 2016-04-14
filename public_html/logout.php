<div class="nav-bar menu-bar">
    <p class="nav-application-name">GTAMS</p>

    <div class="container-right">
        <ul>
            <li><a href="register.php">REGISTER</a></li>
            <li><a href="login.php">LOGIN</a></li>
        </ul>
    </div>
</div>

<?php
  session_unset();
  echo "The session vars are: " . $_SESSION["type"] . $_SESSION["id"] . $_SESSION["email"];
  $page_title = "Logout";
  require "header.php";
?>
<div class="twelve columns text-center">
    <h3>You have been logged out</h3>
</div>
<?php
  require "forms/controllers/logout.php";
?>

<?php
  require "footer.php";
?>
