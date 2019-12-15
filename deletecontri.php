<?php
$servername = "localhost";
$username = "id10419325_cyprien";
$password = "Brother97.4";
$dbname = "id10419325_siteactu";
$id=$_POST['id'];
$conn = new mysqli($servername, $username, $password, $dbname);


            $sqli = "DELETE FROM utilisateur WHERE Id=$id";
            $res=$conn->query($sqli);
            header('Location: material-dashboard-master/material-dashboard-master/examples/contributeur.php'); 





?>