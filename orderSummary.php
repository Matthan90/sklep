<?php

  require_once "php/connection/connectpdo.php";
  require_once "php/class/cart.php";
  $cart = new cart;
  
  session_start();
    
  if (!isset($_SESSION['zalogowany']))
    {
      header('Location: index.php');
      exit();
    }

?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <title>MattStore</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
  <div class="container-fluid bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="store.php">MattStore - sklep internetowy</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="store.php"><i class="fas fa-backward"></i> Wróć</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="showcart.php"><i class="fas fa-shopping-cart"></i> Koszyk</a>
        </li>
        <?php
         echo "<li class='nav-item'>
         <a class='nav-link' href='php/logging/logout.php'><i class='fas fa-sign-out-alt'></i> Wyloguj się</a>
         </li>";
          ?>
      </ul>
    </div>
    </nav>
  </div>
  <div class="container">
    <div class="container-fluid text-center">    
      <div class="row content">
        <div class="col-sm-12">
        <?php
          $stmt=$pdo->prepare("INSERT INTO orders (id,customer,address) VALUES (null,:customer,:address)");
          $stmt->bindValue(':customer',$_POST['customer'],PDO::PARAM_STR);
          $stmt->bindValue(':address',$_POST['address'],PDO::PARAM_STR);
          $stmt->execute();
          
          $orderId = $pdo->lastInsertId();
          
          $orderedProducts = $cart->getProducts();
          
          foreach($orderedProducts as $product){
          $pid = $product['pid'];
          $qty = $product['quantity'];
          
          $stmt=$pdo->prepare("INSERT INTO ordersproducts (id,order_id,product_id,quantity) VALUES (null,:orderId, :pid, :qty");
          $stmt->bindValue(':orderId',$orderId, PDO::PARAM_INT);
          $stmt->bindValue(':pid',$pid,PDO::PARAM_INT);
          $stmt->bindValue(':qty',$qty,PDO::PARAM_INT);
          }
          
          $cart->clear();
          
          echo "<p></p>";
          echo "<h1>Dziękujemy za złożenie zamówienia</h1>";
          echo "<img class='img-fluid' src='http://pluspng.com/img-png/success-png-success-icon-image-23194-400.png'>";
          
          ?>
        </div>
      </div>
    </div>
  </div>

  <footer class="text-center bg-light">
    <p>Copyright &copy; Kamil Śmiałowski</p>
  </footer>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>