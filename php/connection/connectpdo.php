<?php
$pdo = new PDO('mysql:host=mysql.cba.pl;dbname=matthan90','matthan90','Matthanek123');

$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo -> exec("SET NAMES 'utf8'");