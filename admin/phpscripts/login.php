<?php

  function logIn($username, $password, $ip){
    require_once("connect.php");
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    $loginString = "SELECT * FROM tbl_user WHERE user_name='{$username}' AND user_pass = '{$password}'";
    //echo $loginString;
    $user_set = mysqli_query($link, $loginString);

    if(mysqli_num_rows($user_set)){
      $found_user = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
      $id = $found_user['user_id'];
      $_SESSION['users_id'] = $id;
      $_SESSION['users_name'] = $found_user['user_name'];
      if(mysqli_query($link, $loginString)){
        $updateString = "UPDATE tbl_user SET user_ip='{$ip}' WHERE user_id={$id}";
        $updateQuery = mysqli_query($link, $updateString);
      }
      redirect_to("index.php");
    }
    else{
      $message = "Username/Password were incorrect. <br>Please make sure your caps-lock key is turned off.";
      return $message;
    }
    mysqli_close($link);
  }

?>
