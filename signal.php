<?php
session_start();
$servername = "localhost";
$username = "id10419325_cyprien";
$password = "Brother97.4";
$dbname = "id10419325_siteactu";
$id=$_POST['id'];
echo $id;
try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    

    $stm = $conn->prepare("UPDATE blagues SET Etat='Signaler' WHERE Id='$id'");
    $stm->execute();

    header('location: index.php');
   
        
           
}  catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}

?>