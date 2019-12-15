<?php
$servername = "localhost";
$username = "id10419325_cyprien";
$password = "Brother97.4";
$dbname = "id10419325_siteactu";
$id=$_GET['id']; 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM blagues WHERE Id='$id'");
    $stmt->execute();
    $result=$stmt->fetch();
    echo '<form action="up.php" id="nouv" method="post"  ><textarea name="txt" id="" cols="49" rows="10" >'.$result['Blague'].'</textarea><input name="id" type="hidden" value="'.$id.'"></form>';



?>