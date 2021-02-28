<html>
    <head>
    </head>
    <body>
        <nav>
            <div>
                <a href="mobiles_list.php" style="margin-right:20px">HOME</a>
                <a href="add_mobile.php">ADD Mobile</a>
            </div>
        </nav>
        <?php
            require("mysqli_connect.php");
            $q1 = "Select * from online_mobile_store.mobiles";
            $r1 = @mysqli_query($dbc, $q1);

            while($rowdata = mysqli_fetch_array($r1)){
                echo "<p>Mobile Name: ".$rowdata['mobilename']."<br>Color: ".$rowdata['color']."<br>Price:".$rowdata['price']."<br>Brand: ".$rowdata['brand']."</p>";
            }
        ?>
    </body>
</html>
