<?php
    //initialiser la session
    session_start();

    //controleur d'entrée (front controller)

    //aller chercher le fichier de config
    require_once("config.php");

    //appeler le routeur
    Routeur::route();
?>