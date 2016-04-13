<?php
$page_title = "Login";
require "header.php";
?>

<?php
require "footer.php";
?>

<?php
if(!empty($_POST))
{
    //echo '<span style="color:#AFFS;text-align:center;"Invalid username or password.</span>';
  //echo $_POST["email"] . "<br>" . $_POST["password"] . "<br>";

  $sth = $dbh->prepare("SELECT * FROM system_admins");
  $sth->execute();
  $result = $sth->fetchAll();

  $registered = 0;
    //Test if email/password is in Admin table. Set 1 if yes, 5 is no.
  foreach($result as $r)
  {
    if($r['email'] == $_POST['email'] && $r['password_digest'] == $_POST['password'])
    {
        //setcookie()
        $registered = 1;
        break;
    }
    else
    {
      $registered = 5;
    }
  }

  if($registered == 5 || $registered == 0)
  {
    $sth = $dbh->prepare("SELECT * FROM gc_members");
    $sth->execute();
    $result = $sth->fetchAll();

    foreach($result as $r)
    {
      if($r['email'] == $_POST['email'] && $r['password_digest'] == $_POST['password'])
      {
          $cookiename = $r['id'];
          $cookievalue = $r['email'];
          setcookie($cookiename, )
          $registered = 2;
          break;
      }
      else
      {
        $registered = 5;
      }
    }
  }
  //registered values can be: 1=admin, 2=gc member, 3 and above = failed to login.
  if($registered == 1)
  {
    header('Location: admin-dashboard.php');
  }
  else if($registered == 2)
  {
    header('Location: dashboard.php');
  }
  else if($registered > 2)
  {
    echo "Invalid Username or Password <br>";
  }
}
?>

<?php
require "forms/login-form.php";
?>
