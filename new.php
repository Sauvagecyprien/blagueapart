<?php
session_start();
$text=$_POST['txt'];
$servername = "localhost";
$username = "id10419325_cyprien";
$password = "Brother97.4";
$dbname = "id10419325_siteactu";
$id=$_SESSION['id'];
$cac=chr(92);

$text = str_replace("'", $cac."'", $text);
$text = str_replace('"', $cac.'"', $text);

try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $req = " INSERT INTO blagues (Id, Id_auteur,  Blague, Date) VALUES (null,'$id','$text', CURDATE());";
           $conn->exec($req);
        header('location: profil.php');
           
}  catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}
?>