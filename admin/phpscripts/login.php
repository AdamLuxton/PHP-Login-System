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
      if ($found_user["user_status"]!=1){
        $message = "This account has been locked from too many log-in attempts. Check your email for instructions on unlocking your account.";
        return $message;
      }
      else{
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
        $query = "UPDATE `tbl_logina` SET `login_count` = 0 WHERE `login_user` = '{$username}'";
        $fixCount = mysqli_query($link, $query);
        redirect_to("index.php");
      }

    }
    else{
      $accountString = "SELECT user_id FROM tbl_users WHERE user_name = '{$username}'";
      $accountExists = mysqli_query($link, $accountString);
      if(mysqli_num_rows($accountExists)){
        $accountString = "SELECT * FROM tbl_logina WHERE login_user = '{$username}'";
        $accountAttempted = mysqli_query($link, $accountString);
        if(mysqli_num_rows($accountAttempted)){
          $found_user = mysqli_fetch_array($accountAttempted, MYSQLI_ASSOC);
          if ($found_user["login_count"]<3){
            $count = $found_user["login_count"]+1;
            $loginID = $found_user["login_id"];
            $query = "UPDATE `tbl_logina` SET `login_count` = {$count} WHERE `tbl_logina`.`login_id` = {$loginID}";
            mysqli_query($link, $query);
            $message = "Username/Password were incorrect. <br>Please make sure your caps-lock key is turned off.";
            return $message;
          }
          else{
            $query = "UPDATE `tbl_users` SET `user_status` = 0 WHERE `user_name` = '{$username}'";
            mysqli_query($link, $query);
            $message = "This account has been locked out after too many failed log-in attempts. Check your email for instructions on how to unlock your account.";
            return $message;
          }
        }
        else{
          $newEntry = "INSERT INTO `tbl_logina` (`login_id`, `login_user`, `login_count`, `login_time`, `login_ip`) VALUES (NULL, '{$username}', 1, ".time().", '{$ip}')";
          $enterNewEntry = mysqli_query($link, $newEntry);
          $message = "Username/Password were incorrect. <br>Please make sure your caps-lock key is turned off.";
          return $message;
        }
      }
      else{
        $message = "Username/Password were incorrect. <br>Please make sure your caps-lock key is turned off.";
        return $message;
      }

    }
    mysqli_close($link);
  }

?>
