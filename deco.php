<?php
    session_start();

    $_SESSION = array();
    session_destroy();

    setcookie('login','');
    setcookie('Mdp','');
    header('location: index.php');

?>
