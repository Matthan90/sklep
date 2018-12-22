<?php

class cart{

    public function _construct(){

    }

    public function add($id){
        global $pdo;
		
		$stmt=$pdo->prepare("SELECT * FROM cart WHERE product_id = :id AND user_id =:uid");
		$stmt->bindValue(':id',$id,PDO::PARAM_INT);
		$stmt->bindValue(':uid',$_SESSION['id'],PDO::PARAM_INT);
		$stmt->execute();
		
		if($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
			$qty = $row[0]['quantity'] + 1;
			$stmt=$pdo->prepare("UPDATE cart SET quantity = :qty WHERE user_id = :uid AND product_id = :pid");
			$stmt->bindValue(':qty',$qty,PDO::PARAM_INT);
			$stmt->bindValue(':uid',$_SESSION['id'],PDO::PARAM_INT);
			$stmt->bindValue(':pid',$id,PDO::PARAM_INT);
			$stmt->execute();
		}
		else{
			$stmt = $pdo->prepare("INSERT INTO cart (id, user_id, product_id, quantity) VALUES (null, :uid, :pid, 1)");
			$stmt->bindValue(':uid',$_SESSION['id'],PDO::PARAM_INT);
			$stmt->bindValue(':pid',$id,PDO::PARAM_INT);
			$stmt->execute();
		}
	}
	
	public function remove($id){
		global $pdo;
		
		
		$stmt=$pdo->prepare("SELECT * FROM cart WHERE product_id = :id AND user_id = :uid");
		$stmt->bindValue(':id',$id,PDO::PARAM_INT);
		$stmt->bindValue(':uid',$_SESSION['id'],PDO::PARAM_INT);
		$stmt->execute();
		
		$row=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$qty=$row[0]['quantity'];
		$qty--;
		
		if($qty == 0){
		$stmt=$pdo->prepare("DELETE FROM cart WHERE product_id = :id AND user_id = :uid");
		$stmt->bindValue(":id",$id,PDO::PARAM_INT);
		$stmt->bindValue(":uid",$_SESSION['id'],PDO::PARAM_INT);
		$stmt->execute();
		}
		else{
			$stmt = $pdo->prepare("UPDATE cart SET quantity = :qty WHERE product_id = :id AND user_id = :uid");
			$stmt->bindValue(':qty',$qty,PDO::PARAM_INT);
			$stmt->bindValue(':id',$id,PDO::PARAM_INT);
			$stmt->bindValue(':uid',$_SESSION['id'],PDO::PARAM_INT);
			$stmt->execute();
		}
	}

    public function getProducts(){
        global $pdo;

        $stmt = $pdo->prepare("SELECT c.id, p.price, c.quantity, p.index, p.name, p.id as pid FROM cart c LEFT OUTER JOIN products p ON (c.product_id=p.id) WHERE c.user_id = :uid");
        $stmt->bindValue(':uid',$_SESSION['id'],PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    
    public function clear(){
      global $pdo;
      
      $stmt=$pdo->prepare("DELETE from cart WHERE user_id = :uid");
      $stmt->bindValue(':uid',$_SESSION['id'],PDO::PARAM_STR);
      $stmt->execute();
    }
}


?>