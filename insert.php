<?php
$nom = $_POST['pseudo'];
$email = $_POST['email'];
$cemail = $_POST['cemail'];
$mdp = $_POST['mdp'];
$cmdp = $_POST['cmdp'];
$servername = "localhost";

$dbname = 'id10419325_siteactu';
if ($mdp == $cmdp && $email == $cemail) {
try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", "id10419325_cyprien", "Brother97.4",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare(" SELECT Email FROM utilisateur ");
            $stmt->execute();
            while($resultat = $stmt->fetch()){
                
                if(empty($resultat['Email'])){
                    $req = "INSERT INTO utilisateur (Id , Pseudo , Email , Mdp , Urlimage, Roles) VALUES (null,'$nom','$email','$mdp', 'image/avatar.png','Contributeur')";
                    $conn->exec($req);
                    header('Location: index.php');
                }elseif($resultat['Email']==$email){
                        $x==$x++; 
                        echo $x;
                    
                }
            }


 echo $req;
    
       } catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();  }   
} else {
    echo "les mot de passe ne correspondent pas";
    echo "<a href=\"index.php\"><button type button> Réessayer</button></a>";
}

if($x==0){
    try{
        $req = "INSERT INTO utilisateur (Id , Pseudo , Email , Mdp , Urlimage, Roles) VALUES (null,'$nom','$email','$mdp', '../assets/img/faces/marc.jpg','Contributeur')";
           
    $conn->exec($req);
    header('Location: index.php');
        }  catch(PDOException $e){
            header('Location: erreur.html');
        } 
    }
?>             


        
