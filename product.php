<?php

  require_once "php/connection/connectpdo.php";
  require_once "php/functions/showmenu.php";
  require_once "php/functions/showproduct.php";
  require_once "php/functions/showcategory.php";

  session_start();
  
  if (!isset($_SESSION['zalogowany']))
  {
    header('Location: ../../index.php');
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
  <div class="container-fluid">    
    <div class="row content">
      <div class="col-sm-12 text-center">
    <?php if(isset($_GET['pro_id'])){
    showProduct($_GET['pro_id']);}
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
