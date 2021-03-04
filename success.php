<?php
    session_start();
    $_SESSION["mobilename"] = "";
    $_SESSION["price"] = "";
?>

<html>
  <head>
        <link rel="stylesheet" href="bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap-5.0.0-beta2-dist/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="css/product.css">
        </head>
        <body>
        <nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="Second navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Mobile Planet</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="mobiles_list.php">Mobiles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="checkout.php">Checkout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <main>
  <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
    <div class="col-md-5 p-lg-5 mx-auto my-5">
      <h1 class="display-6 fw-normal"><?php echo"Thank you for Shopping with Us"; ?></h1>
      
      <a class="btn btn-outline-secondary" href="mobiles_list.php">Continue Shopping</a>
    </div>
  </div>
  </main>
  </html>