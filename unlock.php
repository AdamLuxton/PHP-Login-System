<?php

  require_once('admin/phpscripts/init.php');

  if(isset($_GET['token'])){
    $token = $_GET['token'];

    $header = unlock_account($token);

  }
  else{
    $header = "YOU'RE IN THE WRONG PLACE!"; //If there's no token.
  }

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

    <title><?php echo $header; ?></title>
    <link rel="stylesheet" href="css/app.css">
  </head>

  <body>

  <div class="mainContainer">
    <div class="centering">
      <div class="container">
        <div class="row">
          <div id="loginHeader" class="col-xs-10 col-xs-push-1 col-sm-6 col-md-4 col-md-push-4 col-sm-push-3">
            <h1>
              <?php
                echo $header;
              ?>
            </h1>
          </div>
        </div>
        <div class="row">
          <div id="loginContainer" class="col-xs-10 col-xs-push-1 col-sm-6 col-md-4 col-md-push-4 col-sm-push-3">
            <a href="loginpage.php" class="btn btn-lg btn-info" id="logBtn">BACK TO LOG IN</a>
          </div>
        </div>
      </div>
    </div>
  </div>
    <script src="js/jquery/dist/jquery.js"></script>
    <script src="js/javascripts/bootstrap.js"></script>
  </body>
</html>
