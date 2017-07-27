<?php
session_start();

$mysql_server_name="localhost";
$mysql_username="root";
$mysql_password="yakkwang";
$mysql_database="filesys";

$pdo=new PDO("mysql:host=$mysql_server_name;dbname=$mysql_database",$mysql_username,$mysql_password);

$file=$pdo->prepare("SELECT filename,sharecode from file");

$file->execute();


$f=$file->fetchAll(PDO::FETCH_ASSOC);
//echo sizeof($f);
$_SESSION["fn"]=$f;
$_SESSION["count"]=sizeof($f);

echo "<script>parent.location.href='download.php';</script>";

 ?>
