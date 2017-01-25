<?php
  //ini_set('display_errors',1); MACS ONLY
  //error_reporting(E_ALL);

  require_once("admin/phpscripts/init.php");
  $ip = $_SERVER["REMOTE_ADDR"];
  //echo $ip;
  if(isset($_POST['submit'])){
    //echo "Thanks for clicking!";
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if($username != "" && $password != ""){
      $result = logIn($username, $password, $ip);
      $message = $result;
    }
    else{
      $message = "Please fill out the log-in form.";
    }
  }

  confirm_logged_out();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Log-In</title>
    <link rel="stylesheet" href="css/app.css">
  </head>

  <body>

  <div class="mainContainer">
    <div class="centering">
      <div class="container">
        <div class="row">
          <div id="loginHeader" class="col-xs-10 col-xs-push-1 col-sm-6 col-md-4 col-md-push-4 col-sm-push-3">
            <h1>SIGN INTO YOUR ACCOUNT</h1>
          </div>
        </div>
        <div class="row">
          <div id="loginContainer" class="col-xs-10 col-xs-push-1 col-sm-6 col-md-4 col-md-push-4 col-sm-push-3">
            <h1 class="hidden">SIGN-IN</h1>
            <?php if(!empty($message)){echo "<p class='error'>".$message."</p>";} ?>
            <form action="loginpage.php" method="post">
                <label for="username" class="hidden">Username:</label>
                <input type="username" name="username" placeholder="Enter Your Username" class="form-control" id="username">
                <label for="password" class="hidden">Password:</label>
                <input type="password" name="password" placeholder="Enter Your Password" class="form-control" id="password">
              <a href="forgotPassword.php" id="pwForget">Forgot Your Password?</a>
              <input type="submit" class="btn btn-lg btn-info" id="logBtn" name="submit" value="LOG-IN">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
    <script src="js/jquery/dist/jquery.js"></script>
    <script src="js/javascripts/bootstrap.js"></script>
  </body>
</html>
