<?php
session_start();
$servername = "localhost";
$username = "id10419325_cyprien";
$password = "Brother97.4";
$dbname = "id10419325_siteactu";
if(empty($_SESSION['id'])){
    header('location: 403.html');
}
$id = $_SESSION['id'];
try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM blagues WHERE Id_auteur='$id'");
    $stmt->execute();
    $req = $conn->prepare("SELECT * FROM utilisateur WHERE Id='$id'");
    $req->execute();
    $don=$req->fetch();
   
        
           
}  catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
            
        $(document).ready(function() {
    $('#nou').click(function() {       
        $.get('ajax.php', {
        id: $(this).val(),
        }, function(data) {
        $('#texte').html(data);
        }
        );
        

    });
    });</script>
    <link rel="stylesheet" href="css/style.css">
    <title>Profil Blague A Part</title>
</head>

<body>
    <header>
        <!--navbar-->
        <div class="head">
            <div class="navbar">
                <!--Connexion-->
                <input class="bouton" type="button" value="Accueil" onClick="javascript:document.location.href='index.php'" />
            </div>
        </div>
    </header>
    <div class="background">
        <div class="box">
            <div id="img" class="photo"></div>
            <div class="nom">
                <h1><?php echo $don['Pseudo']?></h1>
            </div>
            <h2>Vos blagues:</h2>
           <div class="listing">
           <?php while ($res=$stmt->fetch()) {
   ?>
               <div class="repeat">
                   <p  class="unique">
                   <?php echo $res['Blague']?>  
                   </p>
                   <div class="emote">
                       <button data-toggle="modal" id="nou" data-target="#new" data-whatever="@mdo" class="bout" value="<?php echo $res['Id']?>"> <img class="ima" src="img/icons8-modifier-24.png" alt=""></button>
                       <form action="sup.php" method="post" ><button class="bout" type="submit" name="id" value="<?php echo $res['Id']?> "><img class="ima" src="img/icons8-supprimer-24.png" alt=""></button>
                    </div>
               </div>


               <?php }?>  
              
               
           </div>
        </div>
        <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h2>Modifier votre blague:</h2>

                    </div>
                    <div class="modal-body" id="texte">
                      <form action="up.php" id="nouv" method="post"  >  <textarea name="txt" id="" cols="49" rows="10" ></textarea></form>


                    </div>
                    <div class="modal-footer">
                            <button  form="nouv" type="submit" class="bouton">Valider</button>
                            <button type="button" class="bouton" data-dismiss="modal">Fermer</button>

                    </div>
                  </div>
                </div>
              </div>
    </div>
    
    <footer>
            <p>BARET SAUVAGE VELLIEN</p>
        </footer>

</body>

</html>