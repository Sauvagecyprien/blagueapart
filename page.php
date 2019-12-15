<?php
session_start();
$servername = "localhost";
$username = "id10419325_cyprien";
$password = "Brother97.4";
$dbname = "id10419325_siteactu";
try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM blagues WHERE Etat='Valide'");
    $stmt->execute();
    $req = $conn->prepare("SELECT * FROM blagues WHERE Etat='Valide' ORDER BY Pointp DESC LIMIT 3");
    $req->execute();
   
        
           
}  catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php if(empty($_SESSION['id'])){
   echo' <form action="log.php" method="post">';
       echo' <input name="mail" type="email">';
       echo' <input name="passe" type="password">';
        echo'<input type="submit" value="Log In">';
    echo'</form>';}?>
    <form action="plus.php" method="post" id="plus"></form>
    <form action="moins.php" method="post" id="moins"></form>
    <form action="signal.php" method="post" id="signal"></form>
     <?php while ($don=$req->fetch()) {
        $id=$don['Id_auteur'];
       $stm = $conn->prepare("SELECT * FROM utilisateur WHERE Id='$id'");
       $stm->execute();
       $resu=$stm->fetch()
   ?>
   <div>
       <p><?php echo $resu['Pseudo']?></p><br>
       <p><?php echo $don['Blague']?></p><br>
       <button form="plus" name="id" type="submit" value = "<?php echo $don['Id']?>" ><?php echo '+: '.$don['Pointp']?></button>
       <button form="moins" type="submit" name="id" value="<?php echo $don['Id']?>"><?php echo '-: '.$don['Pointn']?></button>
       <button form="signal" type="submit" name="id" value="<?php echo $don['Id']?>">Signaler</button>
       
  </div> 
   <?php }?> 

    <?php while ($res=$stmt->fetch()) {
        $id=$res['Id_auteur'];
       $stm = $conn->prepare("SELECT * FROM utilisateur WHERE Id='$id'");
       $stm->execute();
       $resu=$stm->fetch()
   ?>
   <div>
       <p><?php echo $resu['Pseudo']?></p><br>
       <p><?php echo $res['Blague']?></p><br>
       <button form="plus" name="id" type="submit" value= " <?php echo $res['Id']?> "><?php echo '+: '.$res['Pointp']?></button>
       <button form="moins" type="submit" name="id" value="<?php echo $res['Id']?>"><?php echo '-: '.$res['Pointn']?></button>
       <button form="signal" type="submit" name="id" value="<?php echo $don['Id']?>">Signaler</button>
  </div> 
   <?php }?>
   <?php if(!empty($_SESSION['id'])){
    echo' <form action="new.php" method="post">';
    echo'<textarea name="txt" id="" cols="30" rows="10"></textarea>';
     echo'<input type="submit" value="Envoyer">';
 echo'</form>';
    
   }?>
</body>
</html>