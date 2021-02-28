<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {  
    require("mysqli_connect.php");
    $errors = false;
    
    if (empty($_POST['mobilename'])) {
        echo "<p>Please enter Mobile name.</p>";
    }
    else{
        $mobilename = mysqli_real_escape_string($dbc,$_POST['mobilename']);
    }

    if (empty($_POST['brand'])) {
        echo "<p>Please enter Brand.</p>";
    }
    else{
        $brand = mysqli_real_escape_string($dbc,$_POST['brand']);
    }

    if (empty($_POST['color'])) {
        echo "<p>Please enter color.</p>";
    }
    else{
        $color = mysqli_real_escape_string($dbc,$_POST['color']);
    }

    if (empty($_POST['price'])) {
        echo "<p>Please enter price.</p>";
    }
    else{
        $price = mysqli_real_escape_string($dbc,$_POST['price']);
    }

    if (empty($_POST['modelnumber'])) {
        echo "<p>Please enter Model Number.</p>";
    }
    else{
        $modelnumber = mysqli_real_escape_string($dbc,$_POST['modelnumber']);
    }
    if(isset($_FILES['upload']))
    {
        echo"hi2";
        $mobilename = mysqli_real_escape_string($dbc,$_POST['mobilename']);
        $image = $_FILES['upload']['name'];
        if(! file_exists("uploads")){
            mkdir("uploads");
          }
          
          if( ! file_exists("uploads/$mobilename")){
            mkdir("uploads/".$mobilename);
          }
          
          if (move_uploaded_file($_FILES['upload']['tmp_name'], "uploads/$mobilename/$image")) {
              
            $q = "INSERT INTO mobiles (mobilename, modelid, color, price, brand, pictureurl) VALUES('$mobilename', '$modelnumber', '$color', '$price', '$brand','$image')"; 
            mysqli_query($dbc, $q) or die(mysqli_error($dbc));           
          } else {
            echo "error";
          }
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
<nav>
    <div>
        <a href="mobiles_list.php" style="margin-right:20px">HOME</a>
        <a href="add_mobile.php">ADD MOBILE</a>
    </div>
</nav>
<form enctype="multipart/form-data" action="add_mobile.php" method="post">

	<fieldset><legend>Please Add Mobile Details:</legend>

    <p><label>Mobile Name: <input type="text" name="mobilename" size="30" maxlength="50" value="<?php 
            if(isset ($_POST['mobilename'])) echo$_POST['mobilename'];
    ?>"></label></p>

    <p><label>Brand : <input type="text" name="brand" size="30" maxlength="50" value="<?php 
            if(isset ($_POST['brand'])) echo$_POST['brand'];
    ?>"></label></p>

    <p><label>Color : <input type="text" name="color" size="30" maxlength="50" value="<?php 
            if(isset ($_POST['color'])) echo$_POST['color'];
    ?>"></label></p>

	<p><label>Price: <input type="text" name="price" size="30" maxlength="50" value="<?php 
            if(isset ($_POST['price'])) echo$_POST['price'];
    ?>"></label></p>

    <p><label>Model Number: <input type="text" name="modelnumber" size="30" maxlength="50" value="<?php 
            if(isset ($_POST['modelnumber'])) echo$_POST['modelnumber'];
    ?>"></label></p>

    <p>Mobile Picture: <input type="file" name="upload"></p>

	<p align="center"><input type="submit" value="Submit" name="submit"></p>
	</fieldset>

</form>

</body>
</html>