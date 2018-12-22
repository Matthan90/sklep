<?php
function showMenu(){
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM categories");
    $stmt -> execute();

	echo "<a class='list-group-item list-group-item-action active' href='store.php'>Wszystko</a>";
    while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
        $name = $row['name'];
        $id = $row['id'];
        echo "<a class='list-group-item' href='store.php?cat_id=$id'>$name</a>";
    }
}