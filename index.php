<?php
//ouvrir une session
session_start();
$servername = "localhost";
$username = "id10419325_cyprien";
$password = "Brother97.4";
$dbname = "id10419325_siteactu";
//connexion a la base de données
try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
//requete d'affichage des blagues en ligne
    $stmt = $conn->prepare("SELECT * FROM blagues WHERE Etat='Valide'");
    $stmt->execute();
//requete affichage 3 meilleures blagues
    $req = $conn->prepare("SELECT * FROM blagues WHERE Etat='Valide' ORDER BY Pointp DESC LIMIT 3");
    $req->execute();
   
//affichage de messages en cas d'erreurs 
}  catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}
//affichage des boutons sans connexion
if(empty($_SESSION['id'])){
    $co='inv';
    $dco='vis';
    $cli='disabled';
//affichage des boutons avec connexion    
}else{
    $co='vis';
    $dco='inv';
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Icons -->
  <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
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
        crossorigin="anonymous"></script>

        <!-- script animation scroll -->
        <script src="https://unpkg.com/scrollreveal"></script>
        
       
    <link rel="stylesheet" href="css/style.css">
    <title>Blague A Part</title>
</head>

<body>
    <header>
        <!--navbar-->
        <div class="head">
            <div class="navbar">
                <!--Bouton menu-->
                 <input class="bouton <?php echo $dco?>" data-toggle="modal" data-target="#conn" data-whatever="@mdo" type="button" value="Connexion"/>
                    <input class="bouton <?php echo $dco?>" data-toggle="modal" data-target="#insc" data-whatever="@mdo" type="button" value="Inscription"/>
                <input class="bouton <?php echo $co?>" type="button" value="Profil" onClick="javascript:document.location.href='profil.php'"/>
                    <form action="deco.php"><input class="bouton <?php echo $co?>" type="submit" value="Deconnexion"/></form>
                    <input class="bouton <?php echo $co?>" data-toggle="modal" data-target="#new" data-whatever="@mdo" type="button" value="Ecrire une blague"/>
                    <!-- Fin bouton menu-->
            </div>
            <!--fin navbar-->
        </div>
    </header>
    <!--Form des boutons de notation et du bouton signalé-->
    <form action="plus.php" method="post" id="plus"></form>
    <form action="moins.php" method="post" id="moins"></form>
    <form action="signal.php" method="post" id="signal"></form>
    <div class="block">
        <!--Text du titre-->
        <div class="text">
            <h1>Les Meilleurs Blagues du Jour</h1>
        </div>
        <!-- 1er block 3 meilleurs blagues-->
       
        <div class="element">
        <!-- Affichage des blagues & du profil utilisateur-->
        <?php while ($don=$req->fetch()) {
        $id=$don['Id_auteur'];
       $stm = $conn->prepare("SELECT * FROM utilisateur WHERE Id='$id'");
       $stm->execute();
       $resu=$stm->fetch()
        ?>
        <!--Fond des cartes des meilleurs blagues-->
            <div class="fond">
                <div class="carte">
                    <div class="front">
                        <!-- Affichage des meilleurs blague-->
                        <p><?php echo $don['Blague']?></p>
                    </div>
                    <div class="back"></div>
                </div>
                <!--Fin fond des cartes des meilleurs blagues-->
            </div>
            <!-- Fin affichage des meilleurs blague-->
            <?php }?>  
        </div>

        <!--Liste des blagues-->
        <div class="liste">
            <!--Bulle de post-->
            <?php while ($res=$stmt->fetch()) {
        $id=$res['Id_auteur'];
       $stm = $conn->prepare("SELECT * FROM utilisateur WHERE Id='$id'");
       $stm->execute();
       $resu=$stm->fetch()
   ?>
            <div class="post">
                    <div class="profil">
                        <div class="photo"></div>
                        <div class="info">
                        <div class="mobnom">    <p> <strong><?php echo $resu['Pseudo']?></strong></p> </div>
                            <p><?php echo $res['Date']?></p>
                        </div>
                    </div>
                <div class="headline blaguees">
                    <div class="description">
                        <p><?php echo $res['Blague']?></p>
                       
<div class="note ">
                        <div class="poucehaut ">
                         <button <?php echo $cli?> class="bout " form="plus" name="id" type="submit" value= "<?php echo $res['Id']?>" >
                             <img class="ima" src="img/icons8-pouce-en-l'air-24.png" alt=""></button>
                           <h3> <?php echo $res['Pointp']?></h3>
                      </div>
                      <div class="poucebas ">
                      <button <?php echo $cli?> class="bout " form="moins" type="submit" name="id" value= "<?php echo $res['Id']?>">
                       <img class="ima" src="img/icons8-pouces-vers-le-bas-24.png" alt=""></button>
                     <h3> <?php  echo $res['Pointn']?></h3>
                 </div>
                  <div class="warn <?php echo $co?>">
                            <button class="bout" form="signal" type="submit" name="id" value="<?php $res['Id']?>">
                             <img class="ima" src="img/icons8-avertissement-bouclier-25.png" alt=""></button>
                            </div>
                        
                    </div>

                        
                    </div>
                    <div class="triangle-topleft"></div>

                </div>

            </div>
            <?php }?>
            
        </div>

        <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h2>Ecrivez votre blague:</h2>

                    </div>
                    <div class="modal-body">
                      <form action="new.php" method="post" id="nouvo" >  <textarea name="txt" cols="49" rows="10"></textarea></form>


                    </div>
                    <div class="modal-footer">
                            <button form="nouvo" type="submit" class="bouton">Valider</button>
                            <button type="button" class="bouton" data-dismiss="modal">Fermer</button>

                    </div>
                  </div>
                </div>
              </div>



        <!--la modal de connexion-->
        <div class="modal fade" id="conn" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background: #020236;">
                      <h5 class="modal-title" style="color: white;">Connexion</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="session.php" method="post" id="session">
                        <div class="form-group">
                          <label for="email1" class="col-form-label">E-mail :</label>
                          <input type="email" class="form-control" name="mail" id="email1">
                        </div>
                        <div class="form-group">
                         <label for="passe" class="col-form-label">Mot De Passe :</label>
                          <input type="password" class="form-control" id="passe" name="passe">
                        </div>
             </form>
                    </div>
                    <div class="modal-footer">
                      <button form="session" type="submit" class="btn btn-outline-primary">Se Connecter</button>
                     
                      <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fermer</button>
            
                    </div>
                  </div>
                </div>
              </div>
              <!--Fin de la modal de connexion-->
            <!--la modal d'inscription-->
              <div class="modal fade" id="insc" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header"  style="background: #020236;">
                      <h5 class="modal-title" style="color: white;">S'inscrire</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="insert.php" method="post" id="insert">
            
                        <div class="form-group">
                          <label for="pseudo" class="col-form-label">Pseudo :</label>
                          <input name="pseudo" type="text" class="form-control" id="pseudo">
                        </div>
                        <div class="form-group">
                          <label for="email2" class="col-form-label">E-mail :</label>
                          <input name="email" type="email" class="form-control" id="email2" >
                        </div>
            
                        <div class="form-group">
                          <label for="cemail" class="col-form-label">Confirmer l'email :</label>
                          <input name="cemail" type="email" class="form-control" id="cemail">
                        </div>
            
                        <div class="form-group">
                          <label for="mdp" class="col-form-label">Mot De Passe :</label>
                          <input name="mdp" type="password" class="form-control" id="mdp">
                        </div>
            <div class="form-group">
                          <label for="cmdp" class="col-form-label">Retaper votre Mot De Passe :</label>
                          <input name="cmdp" type="password" class="form-control" id="cmdp">
                        </div>
            </form>
                    </div>
                    <div class="modal-footer">
            
                      <button type="submit" class="btn btn-outline-primary" id="ok" form="insert">s'inscrire</button>
                      <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"
                        id="fermer">Fermer</button></div>
                  </div>
                </div>
              </div>
              </div>
            <!--fin de la modal d'inscription-->
            
<!--Pied de page-->
<footer>
    <p>BARET SAUVAGE VELLIEN</p>
</footer>
<!--Animation au scrool des bulles de blagues-->
<script>
ScrollReveal().reveal('.headline', { delay: 400 });
</script>
</body>

</html>