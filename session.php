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
        echo 'Mauvais identifiant ou mot de passe';
    } 
    else 
    {
        if ($pass==$resultat['Mdp']) {
            session_start();
            $_SESSION['id'] = $resultat['Id'];
            $_SESSION['pseudo'] = $resultat['Pseudo'];
            $_SESSION['img'] = $resultat['Urlimage'];
            $_SESSION['rol'] = $resultat['Roles'];
            $rol = $resultat['Roles'];
            if ($rol == 'admin'){
           header ('location:  material-dashboard-master/material-dashboard-master/examples/dashboard.php');
}elseif ($rol == 'Contributeur'){
    header ('location: profil.php');
}

        } else {
            echo "Mauvais identifiant ou mot de passe";
            echo "<br>";
            echo '<a href="index.php"><button type="button">Réessayer</button></a>';
            //echo $pass;

        }
    }

}catch(PDOException $e)
{
echo $sql . "<br>" . $e->getMessage();
}
?>