<?php
session_start();

if(isset($_SESSION["logged"]) && $_SESSION["logged"] == "TRUE"){
    update();
}
else {
    header("refresh:4, url='ass5.html'");
    echo "Sorry, you are not logged in.";
    
}
function update(){
//Database
$servername = "localhost";
$username = "root";
$password = "Password1";
$database = "firstclass";

//Login
$user = $_POST['user'];
$pass = $_POST['pass'];
$background = $_POST['bg'];
$id = $_GET['id'];
$hashed_pass = crypt($pass, "DM");
$bg = $_POST['bg'];
$double_id = (double)$id;
$conn = new mysqli($servername, $username, $password, $database);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Update an account
$sql = "UPDATE users SET user = '{$user}', pass = '{$hashed_pass}', background = '{$bg}' WHERE id = '{$double_id}'";


$result = $conn->query($sql);
if ($result) {
    if(hash_equals($hashed_pass, crypt($pass, $hashed_pass))){
        $_SESSION['logged'] = "TRUE";
        $_SESSION['user'] = $user;
        $_SESSION['bg'] = $background;
        echo "Your information has been updated!";
        header("refresh:3, url='user.php'");
    }
} else {
    echo "There was a problem " . $conn->error;
}
}
?>