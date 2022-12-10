<?php
session_start();

if(isset($_SESSION["logged"]) && $_SESSION["logged"] == "TRUE"){
    displayProfile();
}
else {
    header("refresh:4, url='index.html'");
    echo "Sorry, you are not logged in.";
}

function displayProfile(){
//Database connection
$servername = "localhost";
$username = "root";
$password = "Password1";
$database = "firstclass";

$id = $_GET['id'];

$conn = new mysqli($servername, $username, $password, $database);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, user, pass, background FROM users WHERE id = '$id'";

$result = $conn->query($sql);

if($result){
    $row = $result->fetch_assoc();
    $user = $row['user'];
    $pass = $row['pass'];
    $bg = $row['background'];

    print "
    <head>
    <script src='background.js'>changeBG({$bg});</script>
    </head>
    <script>
        changeBG({$bg});
    </script>
    <form action='update.php?id={$id}' method='POST'>
    <div style='margin: auto; width: 30%; margin-top: 250px; padding: 60px; background-color: rgb(83, 204, 144); border-radius: 50px; text-align: center;'>
        <h1 style='font-family: sans-serif'>Edit account for {$user}.</h1><br>
        <label>Username:</label>
        <input type='text' name='user' id='user' value='{$user}' required/><br>
        <label>Password:</label>
        <input type='text' name='pass' id='pass' required/><br></br>
        <label>Change Background:</label></br>
        <select name='bg' id='bg' onchange='changeBG(this.value)'>
                    <option value='1'>Option 1</option>
                    <option value='2'>Option 2</option>
                    <option value='3'>Option 3</option>
                    <option value='4'>Option 4</option>
        </select></br></br>
        <input type='submit' name='submit' id='submit'/><br>
        
        </form>
        <form action='delete.php?id={$id}' method='POST'>
        <input type='submit' name='submit' value='Delete' id='submit'/><br>
       </from> 
        <a href='user.php' style='float: left; text-decoration: none; color: black;'>Go back</a>
    </div>
    ";
      
}
}
?>