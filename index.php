<?php
require_once("admin/phpscripts/init.php");
confirm_logged_in();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
  </head>
  <body>
    <h1>Welcome <?php echo $_SESSION['users_name']; ?> to your admin panel</h1>
    <a href="admin/phpscripts/caller.php?caller_id=logout">Log Out</a>
  </body>
</html>
