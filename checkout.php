<?php
    session_start();
    $mobilename = $_SESSION["mobilename"];
    $price = $_SESSION["price"];
    require("mysqli_connect.php");
    
    
    $select_from_mobilelist = "SELECT * FROM online_mobile_store.mobiles WHERE 
            mobilename='$mobilename' AND price='$price'";
    $r1 = @mysqli_query($dbc, $select_from_mobilelist);    
    while($rowdata = mysqli_fetch_array($r1)){
      $mobileid = $rowdata['mobileid'];
    }
    
    
    $select_from_inventory = "SELECT * FROM online_mobile_store.inventory WHERE mobileid='$mobileid'";
    $r2 = @mysqli_query($dbc, $select_from_inventory);
    while($rowdata = mysqli_fetch_array($r2)){
      $available_mobile_quantity = $rowdata['available_unit'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {  
      
      $errors = false;
  
      if (empty($_POST['firstname']) || empty($_POST['lastname']) ||
           empty($_POST['email']) || empty($_POST['street']) || 
           empty($_POST['country']) || empty($_POST['state']) || empty($_POST['zip']) ||
           empty($_POST['nameoncard']) || empty($_POST['cardnumber']) || 
           empty($_POST['expirydate']) || empty($_POST['cvv'])) {
          $errors = true;
      }
      else {
          $firstName = mysqli_real_escape_string($dbc,$_POST['firstname']);
          $lastName = mysqli_real_escape_string($dbc,$_POST['lastname']);
          $email = mysqli_real_escape_string($dbc,$_POST['email']);
          $street = mysqli_real_escape_string($dbc,$_POST['street']);
          $country = mysqli_real_escape_string($dbc,$_POST['country']);
          $state = mysqli_real_escape_string($dbc,$_POST['state']);
          $zip = mysqli_real_escape_string($dbc,$_POST['zip']);
          $nameOnCard = mysqli_real_escape_string($dbc,$_POST['nameoncard']);
          $cardNumber = mysqli_real_escape_string($dbc,$_POST['cardnumber']);
          $expiryDate = mysqli_real_escape_string($dbc,$_POST['expirydate']);
          $cvv = mysqli_real_escape_string($dbc,$_POST['cvv']);
          $quantity = mysqli_real_escape_string($dbc,$_POST['quantity']);
          $paymenttype = mysqli_real_escape_string($dbc,$_POST['paymentMethod']);

          $remaining_quantity = $available_mobile_quantity-$quantity;

      }
      if(!$errors) {
          $insert_into_customers = "INSERT INTO customers (first_name, last_name, email, street, country, state, zip) 
                    VALUES('$firstName', '$lastName', '$email', '$street', '$country', '$state', '$zip')";
      
          if (mysqli_query($dbc, $insert_into_customers)) {
            $last_id = mysqli_insert_id($dbc);
            $insert_into_orders = "INSERT INTO orders (customerid, mobileid, order_quantity, payment_method, name_on_card, card_number, total_amount) 
            VALUES('$last_id', '$mobileid', '$quantity', '$paymenttype', '$nameOnCard', '$cardNumber', '$price* $quantity')";
            if(mysqli_query($dbc, $insert_into_orders)){
              $update_inventory = "UPDATE inventory SET available_unit='$remaining_quantity' WHERE mobileid='$mobileid'";
              mysqli_query($dbc, $update_inventory);
            }
          }
      }
      mysqli_close($dbc);
  } 
  
    
?>

<html>
  <head>
        <link rel="stylesheet" href="bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap-5.0.0-beta2-dist/css/bootstrap-grid.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
          $('document').ready( function() {
            $('#quantity').change(function(){ 
              var total = $('#quantity').val() * $('#price').text();
              $('#total').text("$"+ total);
            });
          });          
        </script>
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
  <div class="container">
  <main>
  <div class="py-5 text-center">
      <h2>Checkout form</h2>
      <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
    </div>
    <form action="checkout.php" class="row g-3" method="post">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Your cart</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0"><?php echo $_SESSION["mobilename"]?></h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">$</span><span class="text-muted" id="price"><?php echo $_SESSION["price"]?></span>
          </li>
          
          
          <li class="list-group-item d-flex justify-content-between bg-light">
            <div class="text-muted">
              <h6 class="my-0">Quantity</h6>
            </div>
            <select class="form-select" name="quantity" id="quantity" required="" style="width:25%">
                <option value=1>1</option>
                <option value=2>2</option>
                <option value=3>3</option>
              </select>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (CAD)</span>
            <strong id="total"><?php echo "$".$_SESSION["price"]?></strong>
          </li>
        </ul>

      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Billing address</h4>
        <form class="needs-validation" novalidate="">
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">First name</label>
              <input type="text" class="form-control" name="firstname" id="firstName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Last name</label>
              <input type="text" class="form-control" name="lastname" id="lastName" placeholder="" value="" required="">
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">Email </label>
              <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Street </label>
              <input type="text" class="form-control" name="street" id="address2" placeholder="Street & unit">
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Country</label>
              <input type="text" class="form-control" name="country" id="country" placeholder="" required="">
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>

            <div class="col-md-4">
              <label for="state" class="form-label">State</label>
              <input type="text" class="form-control" name="state" id="state" placeholder="" required="">
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Zip</label>
              <input type="text" class="form-control" name="zip" id="zip" placeholder="" required="">
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
          </div>

          <hr class="my-4">

          <h4 class="mb-3">Payment</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" type="radio" name="paymentMethod" value="credit" class="form-check-input" checked="" required="">
              <label class="form-check-label" for="credit">Credit card</label>
            </div>
            <div class="form-check">
              <input id="debit" name="paymentMethod" type="radio" value="debit" class="form-check-input" required="">
              <label class="form-check-label" for="debit">Debit card</label>
            </div>
          </div>

          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Name on card</label>
              <input type="text" class="form-control" name="nameoncard" id="cc-name" placeholder="" required="">
              <small class="text-muted">Full name as displayed on card</small>
              <div class="invalid-feedback">
                Name on card is required
              </div>
            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Credit card number</label>
              <input type="text" class="form-control" name="cardnumber" id="cc-number" placeholder="" required="">
              <div class="invalid-feedback">
                Credit card number is required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Expiration</label>
              <input type="text" class="form-control" name="expirydate" id="cc-expiration" placeholder="" required="">
              <div class="invalid-feedback">
                Expiration date required
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" name="cvv" id="cc-cvv" placeholder="" required="">
              <div class="invalid-feedback">
                Security code required
              </div>
            </div>
          </div>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
        </form>
      </div>
    </form>
  </main>
</html>