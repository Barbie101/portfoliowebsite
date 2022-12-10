<?php
session_start();

if(isset($_SESSION["logged"]) && $_SESSION["logged"] == "TRUE"){
    displayUsers();
}
else {
    header("refresh:4, url='ass5.html'");
    echo "Sorry, you are not logged in.";
}
//displayUsers();
function displayUsers(){
    //Database
    $servername = "localhost";
    $username = "root";
    $password = "Password1";
    $database = "firstclass";



    $conn = new mysqli($servername, $username, $password, $database);

    //check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

    //Check if the user credentials are valid
    $sql = "SELECT id, user FROM users order by user";

    $result = $conn->query($sql);

	if ($result) {
        print "<div style='margin: auto; width: 30%; margin-top: 250px; padding: 60px; background-color: rgb(83, 204, 144); border-radius: 50px; text-align: center;'>";
		print "Current users:</br>";
        while($row = $result->fetch_assoc()){
            $id = $row['id'];
            $user = $row['user'];

            echo "<a href='edit.php?id=$id&current_user={$_SESSION['user']}' style='text-decoration: none;'>$user</a></br>";
        }
        print "<a href='user.php' style='float: left; text-decoration: none; color: black;'>Go back</a>";
        print "</div>";
	} else {
        echo "No users found.";
    }
}
?>  