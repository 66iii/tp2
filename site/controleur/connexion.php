<?php
if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/modele/authentification.inc.php";


$menuBurger = array();
$menuBurger[] = Array("url"=>"./?action=connexion","label"=>"Connexion");
$menuBurger[] = Array("url"=>"./?action=inscription","label"=>"Inscription");

if (!isset($_POST["mailU"]) || !isset($_POST["mdpU"])){
    $titre = "authentification";
    include "$racine/vue/entete.html.php";
    include "$racine/vue/vueAuthentification.php";
    include "$racine/vue/pied.html.php";
}
else {
    $mailU = $_POST["mailU"];
    $mdpU = $_POST["mdpU"];

    login($mailU, $mdpU);
    if (isLoggedOn(login($mailU, $mdpU))) {
        // Connexion réussie, afficher la confirmation de connexion
        echo "Confirmation de Connexion";
        $titre = "Mon compte";
        include "$racine/vue/entete.html.php";
        include "$racine/vue/vueConfirmationAuth.php"; // Créez cette vue pour afficher la confirmation
        include "$racine/vue/pied.html.php";
    } else {
        // Connexion échouée, afficher à nouveau le formulaire d'authentification avec un message d'erreur
        echo "Identifiants invalides. Veuillez réessayer.";
        $titre = "Authentification";
        include "$racine/vue/entete.html.php";
        include "$racine/vue/vueAuthentification.php";
        include "$racine/vue/pied.html.php";
    }
}
?>