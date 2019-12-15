<?php
session_start();
$text=$_POST['txt'];
$servername = "localhost";
$username = "id10419325_cyprien";
$password = "Brother97.4";
$dbname = "id10419325_siteactu";
$id=$_POST['id'];
echo $id;
$cac=chr(92);

$text = str_replace("'", $cac."'", $text);
$text = str_replace('"', $cac.'"', $text);

try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("UPDATE blagues SET Blague='$text' WHERE Id='$id'");
    $stmt->execute();
    

   

    header('location: profil.php');
   
        
           
}  catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}
?>