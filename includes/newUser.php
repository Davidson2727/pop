<?php


if (isset($_POST['submit'])){

  include_once 'dbconn.php';

    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $userid = mysqli_real_escape_string($conn, $_POST['uid']);
    $passwrd = mysqli_real_escape_string($conn, $_POST['pwd']);


    //Error handlers
    //Check for empty fields
    if (empty($first) || empty($last) || empty($email) || empty($userid) || empty($passwrd)) {
		header("Location: ../signup.php?signup=emptyyyyyyyyyyyyyyyyyyy");

		exit();
	} else {
		//Check if input characters are valid
		if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
			header("Location: ../signup.php?signup=invalid");
			exit();
		} else {
			//Check if email is valid
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				header("Location: ../signup.php?signup=email");
				exit();
			} else {
				$sql = "SELECT * FROM users WHERE username='$userid'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if ($resultCheck > 0) {
					header("Location: ../signup.php?signup=usertaken");
					exit();
				} else {
					//Hashing the password
					$hashedPwd = password_hash($passwrd, PASSWORD_DEFAULT);
					//Insert the user into the database
          $sql="INSERT INTO user(username,email,fn,ln,password) VALUES ('$userid','$email','$first','$last','$hashedPwd');";
					mysqli_query($conn, $sql);
					header("Location: ../signup.php?signup=success");
					exit();
				}
			}
		}
	}
}

else {
	header("Location: ../signup.php");
	exit();
}
