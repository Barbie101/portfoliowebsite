<?php
    //Database
    $servername = "localhost";
    $username = "root";
    $password = "Password1";
    $database = "firstclass";

    //Login
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $background = $_POST['bg'];
    $hashed_pass = crypt($pass, "DM");

    $conn = new mysqli($servername, $username, $password, $database);

    //check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

    //Check if the user already exists
    $sql = "SELECT user FROM users WHERE user = '$user'";

    $result = $conn->query($sql);
    /*if($result){
        echo "<div style='margin: auto; margin-top: 400px; padding: 20px; background-color: aqua; text-align: center; width: 10%; border: 2px solid black; border-radius: 25px;'>";
        echo "Sorry, a user with that name already exists";
        echo "</div>";
        header("refresh: 2, url='register.html'");
    }
    else { */

    //Register a new account
    $sql = "INSERT INTO users (user, pass, background) VALUES ('{$user}', '{$hashed_pass}', '{$background}');";

    $result = $conn->query($sql);
	if ($result) {
        if(hash_equals($hashed_pass, crypt($pass, $hashed_pass))){
            session_start();
            $_SESSION['logged'] = "TRUE";
            $_SESSION['user'] = $user;
            $_SESSION['bg'] = $background;
            header("location: user.php?current_user={$user}");
        }
	} else {
		echo "There was a problem " . $conn->error;
	}
    //}

?>  