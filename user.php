<?php
session_start();

if(isset($_SESSION["logged"]) && $_SESSION["logged"] == "TRUE"){
    displayProfile();
}
else {
    header("refresh:4, url='ass5.html'");
    echo "Sorry, you are not logged in.";
}

?>
<?php
function displayProfile(){
print "
<!DOCTYPE html>
<head>
    <script src='background.js'></script>
</head>
<body>
<script>
    changeBG({$_SESSION['bg']});
</script>
<div style='margin: auto; width: 30%; margin-top: 250px; padding: 60px; background-color: rgb(83, 204, 144); border-radius: 50px; text-align: center;'>
    <label style='font-size: 30px;'>Hi <span style='font-family: sans-serif;'>{$_SESSION['user']}</span>.</label></br>
    <form action='users.php?current_user={$_SESSION['user']}' method='POST'>
        <input style='float: right;' type='submit' name='users' value='View Users'>
    </form>
    <form action='logoff.php' method='POST'>
        <input  style='float:left;' type='submit' name='logoff' value='Log Off'/>
    </form>
</div>
</body>
</html>
";
}
?>