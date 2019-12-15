<?php
$mail = $_POST['mail'];
$pass = $_POST['passe'];
$dbname = 'id10419325_siteactu';
$servername = 'localhost';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", 'id10419325_cyprien', 'Brother97.4');
// set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
$stmt = $conn->prepare("SELECT * FROM utilisateur WHERE Email='$mail'");
    $stmt->execute();
    $resultat = $stmt->fetch();

       
    


    if (!$resultat) {
        echo 'Mauvais identifiant ou mot de passe1';
    } 
    else 
    {
        if ($pass==$resultat['Mdp']) {
            session_start();
            $_SESSION['id'] = $resultat['Id'];
            $_SESSION['pseudo'] = $resultat['Pseudo'];
            $_SESSION['img'] = $resultat['Urlimage'];
            $_SESSION['rol'] = $resultat['Roles'];
           header ('location: index.php');


        } else {
            echo "Mauvais identifiant ou mot de passe2";
            echo "<br>";
            echo '<a href="login.html"><button type="button">Réessayer</button></a>';
            //echo $pass;

        }
    }

}catch(PDOException $e)
{
echo $sql . "<br>" . $e->getMessage();
}
?>