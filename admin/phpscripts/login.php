<?php
  date_default_timezone_set('America/Toronto');

  function logIn($username, $password, $ip){
    require_once("connect.php");
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    $loginString = "SELECT * FROM tbl_users WHERE user_name='{$username}' AND user_password = '{$password}'";
    //echo $loginString;
    $user_set = mysqli_query($link, $loginString);

    if(mysqli_num_rows($user_set)){
      $found_user = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
      $id = $found_user['user_id'];
      $_SESSION['users_id'] = $id;
      $_SESSION['users_name'] = $found_user['user_name'];
      $_SESSION['users_login'] = $found_user['user_lastLogin'];
      if(mysqli_query($link, $loginString)){
        $updateIPString = "UPDATE tbl_users SET user_ip='{$ip}' WHERE user_id={$id}";
        $newDate = date("jS \\of F, Y");
        $updateLoginString = "UPDATE tbl_users SET user_lastLogin='{$newDate}' WHERE user_id={$id}";
        $updateQuery = mysqli_query($link, $updateIPString);
        $updateLoginQuery = mysqli_query($link, $updateLoginString);
      }
      redirect_to("index.php");
    }
    else{
      $accountString = "SELECT user_id FROM tbl_users WHERE user_name = '{$username}'";
      $accountExists = mysqli_query($link, $accountString);
      if(mysqli_num_rows($accountExists)){

      }
      else{
        $message = "Username/Password were incorrect. <br>Please make sure your caps-lock key is turned off.";
        return $message;
      }

    }
    mysqli_close($link);
  }

?>
