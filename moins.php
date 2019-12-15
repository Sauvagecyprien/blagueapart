<?php
session_start();
$servername = "localhost";
$username = "id10419325_cyprien";
$password = "Brother97.4";
$dbname = "id10419325_siteactu";
$id=$_POST['id'];
try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM blagues WHERE Id=$id");
    $stmt->execute();
    $don=$stmt->fetch();
    $point = $don['Pointn']+1;

    $stm = $conn->prepare("UPDATE blagues SET Pointn=$point WHERE Id=$id");
    $stm->execute();
    
   header('location: index.php');
        
           
}  catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}
?>