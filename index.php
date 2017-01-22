<?php
require_once("admin/phpscripts/init.php");
confirm_logged_in();
date_default_timezone_set('America/Toronto');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Welcom <?php echo $_SESSION['users_name']; ?></title>
    <link rel="stylesheet" href="css/app.css">
  </head>

  <body>

  <!--  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">LEARN THE HEROES</a></li>
            <li><a href="#">LEARN THE ITEMS</a></li>
          </ul>
        </div>
      </div>
    </nav>-->
  <div class="mainContainer">
    <div class="centering">
      <div class="container">
        <div class="row">
          <div id="loginHeader" class="col-xs-10 col-xs-push-1 col-sm-6 col-md-4 col-md-push-4 col-sm-push-3">
            <h1>
              <?php
                $hour = idate('H');
                if(($hour>4)&&($hour<12)){
                  echo "GOOD MORNING ".strtoupper($_SESSION['users_name']);
                }
                else if(($hour>=12)&&($hour<18)){
                  echo "GOOD AFTERNOON ".strtoupper($_SESSION['users_name']);
                }
                else{
                  echo "GOOD EVENING ".strtoupper($_SESSION['users_name']);
                }
              ?>
            </h1>
          </div>
        </div>
        <div class="row">
          <div id="loginContainer" class="col-xs-10 col-xs-push-1 col-sm-6 col-md-4 col-md-push-4 col-sm-push-3">
            <?php
            echo "<p>Your last log-in was on the ".$_SESSION['users_login'].".</p>";
            //echo date("jS \\of F, Y");
            //echo idate('H');
            //echo "UPDATE tbl_user SET user_lastLogin='".date("j/n/y")."' WHERE user_id=0";
            ?>
            <a href="admin/phpscripts/caller.php?caller_id=logout" class="btn btn-lg btn-info" id="logBtn">LOG OUT</a>
          </div>
        </div>
      </div>
    </div>
  </div>
    <script src="js/jquery/dist/jquery.js"></script>
    <script src="js/javascripts/bootstrap.js"></script>
  </body>
</html>
