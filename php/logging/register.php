  <?php
  if (isset($_POST['email']))
  {
    $validation=true;
    $name = $_POST['name'];
    
    if ((strlen($name)<3) || (strlen($name)>20))
    {
      $validation=false;
      $_SESSION['e_name']="name musi posiadać od 3 do 20 znaków!";
    }
    
    if (ctype_alnum($name)==false)
    {
      $validation=false;
      $_SESSION['e_name']="name może składać się tylko z liter i cyfr (bez polskich znaków)";
    }
    
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
    {
      $validation=false;
      $_SESSION['e_email']="Podaj poprawny adres e-mail!";
    }
    
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    
    if ((strlen($password1)<8) || (strlen($password1)>20))
    {
      $validation=false;
      $_SESSION['e_password']="Hasło musi posiadać od 8 do 20 znaków!";
    }
    
    if ($password1!=$password2)
    {
      $validation=false;
      $_SESSION['e_password']="Podane hasła nie są identyczne!";
    } 

    $password_hash = password_hash($password1, PASSWORD_DEFAULT);   
    
    $secret = "6LcXEIIUAAAAAOgA0nvid09QdW6yw7Bw_nwV0Tnu";
    
    $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
    
    $answer = json_decode($check);
    
    if ($answer->success==false)
    {
      $validation=false;
      $_SESSION['e_bot']="Potwierdź, że nie jesteś botem!";
    }   
    
    $_SESSION['fr_name'] = $name;
    $_SESSION['fr_email'] = $email;
    $_SESSION['fr_password1'] = $password1;
    $_SESSION['fr_password2'] = $password2;
    
    require_once 'php/connection/connectpdo.php';

        $stmt = $pdo->prepare("SELECT id FROM users WHERE email=:email");
        $stmt->bindValue(':email',$email,PDO::PARAM_STR);
        $stmt->execute();
        
        if (!$stmt) throw new Exception($pdo->error);
        
        $num_mails = $stmt->rowCount();
        if($num_mails>0)
        {
          $validation=false;
          $_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
        }   

        $stmt = $pdo->prepare("SELECT id FROM users WHERE name= :name");
        $stmt->bindValue(':name',$name,PDO::PARAM_STR);
        $stmt->execute();
        
        $num_names = $stmt->rowCount();
        if($num_names>0)
        {
          $validation=false;
          $_SESSION['e_name']="Istnieje już użytkownik o takim loginie! Wybierz inny.";
        }
        
        if ($validation==true)
        {
          $stmt = $pdo->prepare("INSERT INTO users VALUES (NULL, :name, :password_hash, :email)");
          $stmt->bindValue(':name',$name,PDO::PARAM_STR);
          $stmt->bindValue(':password_hash',$password_hash,PDO::PARAM_STR);
          $stmt->bindValue(':email',$email,PDO::PARAM_STR);
          $stmt->execute();
          
          if ($stmt->execute()==true)
          {
            $_SESSION['successfulRegistration']=true;
            header('Location: success.php');
          }
        }
      }