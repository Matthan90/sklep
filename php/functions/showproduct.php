<?php
  require_once "getproductpictures.php";
  
function showProduct($id){
  global $pdo;
  
  $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
  $stmt -> bindValue(':id',$id,PDO::PARAM_INT);
  $stmt -> execute();


    while($row = $stmt -> FETCH(PDO::FETCH_ASSOC)){
        $index=$row['index'];
    foreach(getProductPictures($index) as $image){
      echo "<a href='images/$image'>";
      echo "<img class='img-fluid' src='assets/images/$image'>";
      echo "</a>";
      echo "<br>";
    }
    echo "<h1>".$row['name']."</h1>";
    echo "<br>";
        echo "<h3>".$row['price']."zł"."</h3>";
    echo "<br>";
    echo $row['description'];
        $id = $row['id'];
    echo "<br>";
    echo "<br>";
    echo "<a style='text-decoration: none;' href='php/methods/addToCart.php?id=$id'><input type='submit' value='Dodaj do koszyka' class='btn btn-warning btn-lg'></a>";
    }
}

