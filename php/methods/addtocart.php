<?php

header('Location: ../../showcart.php');

require_once "../connection/connectpdo.php";
require_once "../functions/showmenu.php";
require_once "../functions/showproduct.php";
require_once "../functions/showcategory.php";
require_once "../class/cart.php";
require_once "../../showcart.php";


$cart->add($_GET['id']);

exit();




?>