<?php
  date_default_timezone_set('America/Toronto'); //Set the timezone for the date function.

  function logIn($username, $password, $ip){
    require_once("connect.php");
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    $loginString = "SELECT * FROM tbl_users WHERE user_name='{$username}' AND user_password = '{$password}'";
    //echo $loginString;
    $user_set = mysqli_query($link, $loginString);

    if(mysqli_num_rows($user_set)){
      $found_user = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
      if ($found_user["user_status"]!=1){ //If the account is locked, don't add the session and return this message.
        $message = "This account has been locked from too many log-in attempts. Check your email for instructions on unlocking your account.";
        return $message;
      }
      else{ //If it is not locked.
        $id = $found_user['user_id'];
        $_SESSION['users_id'] = $id;
        $_SESSION['users_name'] = $found_user['user_name'];
        $_SESSION['users_login'] = $found_user['user_lastLogin']; //Add the last login to the session.
        if(mysqli_query($link, $loginString)){
          $updateIPString = "UPDATE tbl_users SET user_ip='{$ip}' WHERE user_id={$id}";
          $newDate = date("jS \\of F, Y");
          $updateLoginString = "UPDATE tbl_users SET user_lastLogin='{$newDate}' WHERE user_id={$id}";
          $updateQuery = mysqli_query($link, $updateIPString);
          $updateLoginQuery = mysqli_query($link, $updateLoginString); //Update the last login (after the session has already been made).
        }
        $query = "UPDATE `tbl_logina` SET `login_count` = 0 WHERE `login_user` = '{$username}'"; //Reset the lock count to 0.
        $fixCount = mysqli_query($link, $query);
        redirect_to("index.php");
      }

    }
    //If the login doesn't work.
    else{
      $accountString = "SELECT * FROM tbl_users WHERE user_name = '{$username}'"; //Look for an account with this username.
      $accountExists = mysqli_query($link, $accountString);
      $lockedAccount = mysqli_fetch_array($accountExists, MYSQLI_ASSOC); //Put the account info into a variable for later.
      if(mysqli_num_rows($accountExists)){ //If there is an account with this username.
        $accountString = "SELECT * FROM tbl_logina WHERE login_user = '{$username}'";
        $accountAttempted = mysqli_query($link, $accountString);
        if(mysqli_num_rows($accountAttempted)){ //If there exists an entry for this account in the login attempts table.
          $found_user = mysqli_fetch_array($accountAttempted, MYSQLI_ASSOC);
          if ($found_user["login_count"]<10){ //If the login attempts hasnt reached the lockout threshhold, add to the count.
            $count = $found_user["login_count"]+1;
            $loginID = $found_user["login_id"];
            $query = "UPDATE `tbl_logina` SET `login_count` = {$count} WHERE `tbl_logina`.`login_id` = {$loginID}";
            mysqli_query($link, $query);
            $message = "Username/Password were incorrect. <br>Please make sure your caps-lock key is turned off.";
            return $message;
          }
          else{ //If the lockout threshhold has been met.
            if ($lockedAccount["user_status"] == 1){ //If the account is not locked (aka the first time the threshold is hit).
              $token = openssl_random_pseudo_bytes(16);
              $token = bin2hex($token);
              $query = "UPDATE `tbl_users` SET `user_status` = 0, `user_token` = '{$token}'  WHERE `user_name` = '{$username}'"; //Lock the account and set the unlock token.
              mysqli_query($link, $query);

              //Email Functionality, email the account username the token for unlocking the account.
              $user = $lockedAccount["user_name"];
              $to = $lockedAccount["user_email"];
              $subject = "Your Account Has Been Locked";
              $url = "www.luxtondesign.com/login/unlock.php?token={$token}";
              $body = "Hello {$user}! \n\nWe are sending this email to inform you that your account has been locked due to numerous failed log-in attempts. \n\nPlease visit {$url} to unlock your account. \n\nThanks, LuxtonDesign.";
              mail($to, $subject, $body);
            }

            $message = "This account has been locked from too many log-in attempts. Check your email for instructions on unlocking your account.";

            return $message;
          }
        }
        else{ //If this is the first failed log-in attempt, create a new entry in the login attempts page.
          $newEntry = "INSERT INTO `tbl_logina` (`login_id`, `login_user`, `login_count`, `login_time`, `login_ip`) VALUES (NULL, '{$username}', 1, ".time().", '{$ip}')";
          $enterNewEntry = mysqli_query($link, $newEntry);
          $message = "Username/Password were incorrect. <br>Please make sure your caps-lock key is turned off.";
          return $message;
        }
      }
      else{ //If the username and password are wrong, just return an error message.
        $message = "Username/Password were incorrect. <br>Please make sure your caps-lock key is turned off.";
        return $message;
      }

    }
    mysqli_close($link);
  }

?>
