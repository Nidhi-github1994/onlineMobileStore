<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {  
    require("mysqli_connect.php");
    $username = mysqli_real_escape_string($dbc,$_POST['username']);
    $password = mysqli_real_escape_string($dbc,$_POST['password']);

    $select = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $r1= @mysqli_query($dbc, $select);
    
    if(mysqli_num_rows($r1) > 0){
        session_start();
        $_SESSION["login"] = true;
        header("Location: http://localhost/onlineMobileStore/NidhiParekh_Project1/mobiles_list.php");
    }
    else{
        echo "Invalid login credentials";
    }
    mysqli_close($dbc);
} 
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Simple HTML Form</title>
	<style type="text/css">
    .error{
        color:red;
    }
	</style>
</head>
<body>
<form action="login.php" method="post">

	<fieldset><legend>Please Add Username & Password:</legend>

    <p><label>Username: <input type="text" name="username" size="30" maxlength="50"></label></p>

    <p><label>Password : <input type="text" name="password" size="30" maxlength="50"></label></p>

	<p align="center"><input type="submit" value="Submit" name="submit"></p>
	</fieldset>

</form>

</body>
</html>