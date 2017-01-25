<?php

	function redirect_to($location) {
		if($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}

	function unlock_account($token){
		require_once("connect.php");
		$query = "SELECT * FROM tbl_users WHERE user_token = '{$token}' LIMIT 1"; //Look for a user with this token.
		$account = mysqli_query($link, $query);
		if(mysqli_num_rows($account)){ //If a user is found.
			$query = "UPDATE `tbl_users` SET `user_status` = 1, `user_token` = NULL  WHERE `user_token` = '{$token}'"; //Set the account to unlocked.
			mysqli_query($link, $query);
			$message = "Your account has been unlocked!";
			return $message;
		}
		else{ //If theres no locked account with this token.
			$message = "There is no locked account with this email.";
			return $message;
		}
	}

?>
