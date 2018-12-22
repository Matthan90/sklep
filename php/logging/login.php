<?php

  session_start();
  
  if ((!isset($_POST['name'])) || (!isset($_POST['password'])))
  {
    header('Location: ../../index.php');
    exit();
  }

  require_once "../connection/connectpdo.php";

    $name = $_POST['name'];
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE name = :name");
    $stmt->bindValue(':name',$name,PDO::PARAM_STR);
    $stmt->execute();
  
      $num_users = $stmt->rowCount();
      if($num_users>0)
      {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (password_verify($password, $row['password']))
          {
          $_SESSION['zalogowany'] = true;
          $_SESSION['id'] = $row['id'];
          $_SESSION['name'] = $row['name'];
          $_SESSION['password'] = $row['password'];
          $_SESSION['email'] = $row['email'];
          
          unset($_SESSION['error']);
          $stmt->closeCursor();
          header('Location: ../../store.php');
          } 
        else 
        {
        $_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
        header('Location: ../../index.php');
        }
      
      } else {
      
        $_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
        header('Location: ../../index.php');
      }
    
  
?>