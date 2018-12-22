<?php
function showCategory($category_id=null){
    global $pdo;

    if($category_id){
        $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = :cid");
        $stmt -> bindValue(':cid',$category_id,PDO::PARAM_INT);
        $stmt -> execute();
    }
    else{
        $stmt = $pdo->prepare("SELECT * FROM products");
        $stmt -> execute();
    }

	echo "<table class='table table-hover'>";
    while($row = $stmt -> FETCH(PDO::FETCH_ASSOC)){
		echo "<tr><td class='align-middle'>";
		$index=$row['index'];
		$id=$row['id'];
		$images=getProductPictures($index);
		if(!empty($images)){
			$image=$images[0];
		}
		else {
			$image= 'no-photo.jpg';
		}
		echo "<img class='img-fluid' src='assets/images/thumbs/$image'>";
		echo "</td><td class='align-middle'>";
		echo "<a href='product.php?pro_id=$id'>";
        echo $row['name'];
		echo "</a>";
		echo "</td><td class='align-middle'>";
        echo $row['price']."zł";
		echo "</td></tr>";
		}
	echo "</table>";
}
require_once "getproductpictures.php";