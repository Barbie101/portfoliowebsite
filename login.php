<?php
    session_start();
    //Database
    $servername = "localhost";
    $username = "root";
    $password = "Password1";
    $database = "firstclass";

    //Login
    $user = $_POST['user'];
    $pass = $_POST['pass'];


    $conn = new mysqli($servername, $username, $password, $database);

    //check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

    //Check if the user credentials are valid
    $sql = "SELECT id, user, pass, background FROM users WHERE user = '$user'";

    $result = $conn->query($sql);
	if ($result) {
        $row = $result->fetch_assoc();
        $hashed_pass = $row['pass'];
        if(hash_equals($hashed_pass, crypt($pass, $hashed_pass)) && $user = $row['user']){
            session_start();
            $_SESSION['logged'] = "TRUE";
            $_SESSION['user'] = $user;
            $_SESSION['bg'] = $row['background'];
            header("location: user.php?current_user={$user}");

        }
        else {
            echo "Sorry your credentials were incorrect.";
            header("refresh: 4, url='login.html'");
        }
	} else {
		echo "There was a problem " . $conn->error;
	}


?>  