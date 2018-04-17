<?php

session_start();

if (isset($_POST['submit'])) {

	include 'dbconn.php';

	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

	//Error handlers
	//Check if inputs are empty
	if (empty($uid) || empty($pwd)) {
		header("Location: ../index.php?login=empty");
		exit();
	} else {
		$sql = "SELECT * FROM user WHERE username = '$uid' or email = '$uid'";

		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			$output = "<script>console.log( 'Debug Objects: " . $resultCheck . "' );</script>";
			console.log($resultCheck);

			header("Location: ../index.php?login=erroremail");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) {


				//De-hashing the password

				$hashedPwdCheck = password_verify($pwd, $row['password']);

				if ($hashedPwdCheck == false) {
					header("Location: ../index.php?login=errorpassword");
					exit();
				} elseif ($hashedPwdCheck == true) {
					//Log in the user here
					$_SESSION['u_id'] = $row['id'];
					$_SESSION['u_first'] = $row['fn'];
					$_SESSION['u_last'] = $row['ln'];
					$_SESSION['u_email'] = $row['email'];
					$_SESSION['u_uid'] = $row['username'];
					header("Location: ../index.php?login=success");
					exit();
				}
			}
		}
	}
} else {
	header("Location: ../index.php?login=errorelse");
	exit();
}
