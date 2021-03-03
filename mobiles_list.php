<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {  
    session_start();
    $_SESSION["mobilename"] = $_POST['mobilename'];
    $_SESSION["price"] = $_POST['price'];
    header("Location: http://localhost/onlineMobileStore/NidhiParekh_Project1/checkout.php");
    
  }
?>


<html>
  <head>
  <style>
    input {
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom-style: hidden;
        background-color: #fff;
      }
      
      input:focus {
        outline: none;
      }
}
</style>
  <link rel="stylesheet" href="bootstrap-5.0.0-beta2-dist/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
        
        </head>
        <body>
        <nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="Second navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Mobile Store</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="mobiles_list.php">List</a>
          </li>
        </ul>
        
      </div>
    </div>
  </nav>
            <main>
              <div class="album py-5 bg-light">
                <div class="container">
                  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">     
                    <?php
                        require("mysqli_connect.php");
                        $q1 = "Select * from online_mobile_store.mobiles";
                        $r1 = @mysqli_query($dbc, $q1);
    
                        while($rowdata = mysqli_fetch_array($r1)){
                            echo'
                            <form action="mobiles_list.php" method="post"> 
                            <div class="col">
                            <div class="card shadow-sm">                  
                              <img class="img-fluid" width="100%" height="100%" src=uploads/'.$rowdata['mobilename'].'/'. $rowdata['pictureurl'].' alt="Responsive image"/>
                              <div class="card-body">
                                <p class="card-text">MobileName: <input name="mobilename" value="'.$rowdata['mobilename'].'" readonly></p>
                                <p>Color: '.$rowdata['color'].'</p>
                                <p>Price: <input name="price" value="'.$rowdata['price'].'" readonly></p>
                                <p>Brand: '.$rowdata['brand'].'</p>
                                <div class="d-flex justify-content-between align-items-center">
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                    <input type="submit" value="Buy Now" class="btn btn-sm btn-outline-secondary">
                                  </div>
                                  <small class="text-muted">9 mins</small>
                                </div>
                              </div>
                            </div>
                            </div>
                            </form>';
                        } 
                      ?>
                  </div> 
                </div>
              </div>
    
            </main>
    
        </body>
    </html>';




