<?php

var_dump($_GET);
var_dump($_POST);
// ***************************** SESSION ***********************************
// Lancement du mécanisme de session PHP
session_start();

// ****************************** ROUTER ***********************************
// Récupération de la route via la requête utilisateur (GET) ?route=<route>
// Si aucune route n'est définie, on lui donne pour valeur "default"
$route = (isset($_GET["route"]))? $_GET["route"] : "default";

// On liste l'ensemble des scénarios :
// Affichage du formulaire : route=default, controleur : showForm(), template : "formulaire.php"
// Traitement du formulaire : route=verif, controleur : verifier(), redirection : "route=default"
// Réinitialiser nombre mystère : route=replay, controleur : replay(), redirection : "route=default"
switch($route) {

    case "default" : $template = showForm(); // Fonction d'affichage
    break;
    case "verif" : verify(); // Fonction redirigée (vers route générant un affichage)
    break;
    case "replay" : replay(); // Fonction redirigée (vers route générant un affichage)
    break;
    // On ajoute une nouvelle route pour chaque fonctionnalités
    default : $template = showForm(); 
}

// ************************* FONCTIONS DE CONTROLE *************************
// On déclare ici toutes les fonctions appelées par le router, en fonction du choix de l'utilisateur

function showForm() {

    if(!isset($_SESSION["mystere"])) {
        $_SESSION["mystere"] = rand(0, 100);
        $_SESSION["coups"] = 0;
    }

    return "formulaire.php";
}

function verify() {

    
    $_SESSION["coups"]++;

    //echo "Je doit vérifier si " . $_POST["nb"] . " est le nombre mystère";
    if(!empty($_POST["nb"]) && intval($_POST["nb"])) {

        if($_POST["nb"] > $_SESSION["mystere"]) {
            $_SESSION["message"] = "Le nombre recherché est plus petit";
        } elseif($_POST["nb"] < $_SESSION["mystere"]) {
            $_SESSION["message"] = "Le nombre recherché est plus grand";
        } else {
            $_SESSION["message"] = "BRAVO ! Le nombre mystere est : " . $_SESSION["mystere"];
        }
    }

    header("Location:index.php?route=default");
    exit;
}

function replay() {
    $_SESSION["mystere"] = rand(0, 100);
    $_SESSION["coups"] = 0;

    header("Location:index.php?route=default");
    exit;
}

// ******************************* AFFICHAGE *******************************
// L'affichage des templates se fait grâce à la variable $template (qui doit avoir une valeur)
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php require $template; ?>
    
</body>
</html>