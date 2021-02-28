
    <html>
        <head>
        <link rel="stylesheet" href="bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap-5.0.0-beta2-dist/css/bootstrap-grid.min.css">
        </head>
        <body>
            <nav>
                <div>
                    <a href="mobiles_list.php" style="margin-right:20px">HOME</a>
                    <a href="add_mobile.php">ADD Mobile</a>
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
                            echo '
                            <div class="col">
                            <div class="card shadow-sm">                  
                              <img class="img-fluid" width="100%" height="100%" src=uploads/'.$rowdata['mobilename'].'/'. $rowdata['pictureurl'].' alt="Responsive image"/>
                              <div class="card-body">
                                <p class="card-text">MobileName: '.$rowdata['mobilename'].'<br>Color: '.$rowdata['color'].'<br>Price:'.$rowdata['price'].'<br>Brand: '.$rowdata['brand'].'</p>
                                <div class="d-flex justify-content-between align-items-center">
                                  <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                  </div>
                                  <small class="text-muted">9 mins</small>
                                </div>
                              </div>
                            </div>';
                        } 
                      ?>
                  </div> 
                </div>
              </div>
    
            </main>
    
        </body>
    </html>';




