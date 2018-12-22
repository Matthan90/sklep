<?php

  session_start();

  require "php/logging/register.php";

?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <title>MattStore</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
<div class="container">
  <div class="d-flex justify-content-center h-100">
    <div class="card">
      <div class="card-header">
        <h3>Rejestracja</h3>
      </div>
      <div class="card-body">
        <form method="post">
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="nazwa użytkownika" name="name" value="<?php
              if (isset($_SESSION['fr_name']))
              {
                echo $_SESSION['fr_name'];
                unset($_SESSION['fr_name']);
              }
            ?>">
          </div>
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="email" name="email" value="<?php
              if (isset($_SESSION['fr_email']))
              {
                echo $_SESSION['fr_email'];
                unset($_SESSION['fr_email']);
              }
            ?>">
          </div>
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" class="form-control" placeholder="hasło" name="password1" value="<?php
              if (isset($_SESSION['fr_password1']))
              {
                echo $_SESSION['fr_password1'];
                unset($_SESSION['fr_password1']);
              }
            ?>">
            
            <?php
              if (isset($_SESSION['e_password']))
              {
                echo '<div class="error">'.$_SESSION['e_password'].'</div>';
                unset($_SESSION['e_password']);
              }
            ?>  
          </div>
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" class="form-control" placeholder="powtórz hasło" name="password2" value="<?php
              if (isset($_SESSION['fr_password2']))
              {
                echo $_SESSION['fr_password2'];
                unset($_SESSION['fr_password2']);
              }
            ?>">
          </div>
          <div class="input-group form-group">
            <div class="g-recaptcha" data-sitekey="6LcXEIIUAAAAADZYQWx0u40pOHhwnOf9R78g2dTP"></div>
              <?php
                if (isset($_SESSION['e_bot']))
                {
                  echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
                  unset($_SESSION['e_bot']);
                }
              ?>  
          </div>
          <div class="form-group">
            <input type="submit" value="Rejestruj" class="btn float-right login_btn">
          </div>
        </form>
        <?php
          if(isset($_SESSION['error'])) echo $_SESSION['error'];
        ?>
      </div>
      <div class="card-footer">
        <div class="d-flex justify-content-center links">
          Masz już konto?<a href="index.php">Zaloguj się</a>
        </div>
      </div>
    </div>
  </div>
</div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
</body>
</html>